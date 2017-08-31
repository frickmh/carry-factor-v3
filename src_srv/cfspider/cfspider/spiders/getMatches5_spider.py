#
#Match numbers starting at: 2536802224
#Matches go to at least: 2541354219

#Test URL: https://na1.api.riotgames.com/lol/match/v3/matches/2536802224?api_key=RGAPI-adfe4a14-d491-4f12-a50f-833c09b1c138

#Production Key:  55b49f8b-52e1-4cbc-b7cf-d30a054b7833
#New Production Key: RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3

#Rate Limit: 3k/10s, 180k/600s

#Test 2 URL: https://na1.api.riotgames.com/lol/match/v3/matches/2536802224?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833


import scrapy
import json
import time
import MySQLdb
import sys
import os

import logging

#This spider crawls Matches in the Riot API.
#Region must be provided when calling from command line.
class GetMatches5Spider(scrapy.Spider):
    name = "getMatches5"
 
    api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'


    region = ''

    noMatchCount = 0   

    match = 2536802224
        
    lastSuccess = match

    soloQcount = 0


    def __init__(self, region=''):
        logging.getLogger('scrapy.core.engine').setLevel(logging.INFO)
        logging.getLogger('scrapy.extensions.telnet').setLevel(logging.INFO)
        print(region)
        self.region = region

        if (region == 'na1'):
          self.match = 2575901150 #original: #2536802220
          #self.match = 2572142050  #2536800000  #2571719865
        if (region == 'euw1'):
          self.match = 3289015705

        validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"]

        if (self.region == '' or not self.region in validRegions):
          print("Warning:  Invalid region specified!")
          print("Please supply a valid region from command line.")
          print("e.g. 'scrapy crawl xxxxx -a region=na1'")
          time.sleep(5)

        self.noMatchCount = 0
 
        self.cur.execute("USE carryfactor_" + self.region + ";")

        sql = "CREATE TABLE IF NOT EXISTS `matches` (" + \
          "gameId BIGINT UNSIGNED UNIQUE, responseCode SMALLINT UNSIGNED, gameCreation INT UNSIGNED, isPlatinum BIT(1), " + \
          "summonerId0 INT UNSIGNED, champId0 SMALLINT UNSIGNED, kills0 TINYINT UNSIGNED, deaths0 TINYINT UNSIGNED, assists0 TINYINT UNSIGNED, win0 BIT(1)," + \
          "summonerId1 INT UNSIGNED, champId1 SMALLINT UNSIGNED, kills1 TINYINT UNSIGNED, deaths1 TINYINT UNSIGNED, assists1 TINYINT UNSIGNED, win1 BIT(1)," + \
          "summonerId2 INT UNSIGNED, champId2 SMALLINT UNSIGNED, kills2 TINYINT UNSIGNED, deaths2 TINYINT UNSIGNED, assists2 TINYINT UNSIGNED, win2 BIT(1)," + \
          "summonerId3 INT UNSIGNED, champId3 SMALLINT UNSIGNED, kills3 TINYINT UNSIGNED, deaths3 TINYINT UNSIGNED, assists3 TINYINT UNSIGNED, win3 BIT(1)," + \
          "summonerId4 INT UNSIGNED, champId4 SMALLINT UNSIGNED, kills4 TINYINT UNSIGNED, deaths4 TINYINT UNSIGNED, assists4 TINYINT UNSIGNED, win4 BIT(1)," + \
          "summonerId5 INT UNSIGNED, champId5 SMALLINT UNSIGNED, kills5 TINYINT UNSIGNED, deaths5 TINYINT UNSIGNED, assists5 TINYINT UNSIGNED, win5 BIT(1)," + \
          "summonerId6 INT UNSIGNED, champId6 SMALLINT UNSIGNED, kills6 TINYINT UNSIGNED, deaths6 TINYINT UNSIGNED, assists6 TINYINT UNSIGNED, win6 BIT(1)," + \
          "summonerId7 INT UNSIGNED, champId7 SMALLINT UNSIGNED, kills7 TINYINT UNSIGNED, deaths7 TINYINT UNSIGNED, assists7 TINYINT UNSIGNED, win7 BIT(1)," + \
          "summonerId8 INT UNSIGNED, champId8 SMALLINT UNSIGNED, kills8 TINYINT UNSIGNED, deaths8 TINYINT UNSIGNED, assists8 TINYINT UNSIGNED, win8 BIT(1)," + \
          "summonerId9 INT UNSIGNED, champId9 SMALLINT UNSIGNED, kills9 TINYINT UNSIGNED, deaths9 TINYINT UNSIGNED, assists9 TINYINT UNSIGNED, win9 BIT(1)" + \
          ");"


        print(sql)

        self.cur.execute(sql)


    print(region)
  
    #Create database and cursor
    db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="frickmh",         # your username
                     passwd="rbbsbfh11",  # your password
                     db="carryfactor")        # name of the data base    
    
    cur = db.cursor()

    print("INSTANTIATED at " + time.ctime() + "!")

    #This is the first request sent by the spider.
    def start_requests(self):
 
        startMatchFile = self.match

        endMatchFile = startMatchFile + 10

        try:
          f = open("./limits/start_" + self.region + ".txt", "r")
          fileContents = f.read()
          f.close()

          #Comment this out to modify start match for debugging purposes.
          startMatchFile = int(fileContents)
 
          self.match = startMatchFile + 1

          f = open("./limits/end_" + self.region + ".txt", "r")
          fileContents = f.read()
          f.close()

          endMatchFile = int(fileContents)
 
          time.sleep(5)

        except:
          print("Last match not found!")
          time.sleep(5)

       
        print("STARTED!")        

 
        for i in range(startMatchFile, endMatchFile):
          url = "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(i) + "?api_key=" + self.api_key
          
          #print(url)

          #time.sleep(5)
          yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception, meta={'match':i})
          #yield scrapy.Request(url=url, callback=self.parse, meta={'match':i})

    #The spider will execute 'parse' every time it has a 200 request
    def parse(self, response):
        #print("PARSING!")
        #print(response.meta["match"])
 


        #Spider start time
        startTime = time.time();
        body = json.loads(response.body)
        queueId = body["queueId"] #Has to be 420

        gameId = body["gameId"]

        if (response.meta["match"] % 10 == 0):
          print("Parsing match " + str(response.meta["match"]) + ". Queue: " + str(queueId) + str(self.soloQcount))

        #print("Queue: " + str(queueId) + ", " + str(self.soloQcount) + ", " + str(gameId))

        #print("Solo Q count: " + str(self.soloQcount))

        #print("GameId: " + str(gameId))

        #time.sleep(5)

        #420 is Solo Q.  Only analyze games from this queue.
        if int(queueId) == 420:

            self.soloQcount += 1

            #print("Solo Queue!")

            #Database ops here

            gameCreation = int(body["gameCreation"] / 1000)


            sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation " 
            sqlValues = "VALUES (" + str(gameId) + ", " + str(response.status) + ", " + str(gameCreation)
            sqlOnDuplicate = "ON DUPLICATE KEY UPDATE responseCode = " + str(response.status) + ", gameCreation = " + str(gameCreation)

            for participantIdentity in body["participantIdentities"]:
              #print(participantIdentity)
              participantId = participantIdentity['participantId']
              summonerId = participantIdentity['player']['summonerId']
              summonerName = participantIdentity['player']['summonerName']

              for participant in body['participants']:
                if participant['participantId'] == participantId:
#                  print("Matched!")
#                  print(summonerName)
                  stats = participant['stats']
                  championId = participant['championId']
                  win = stats['win']
                  kills = stats['kills']
                  deaths = stats['deaths']
                  assists = stats['assists']
                  cs = stats['totalMinionsKilled'] + stats['neutralMinionsKilled']
#                  print(championId)

                  pid = str(participantId - 1)


#                  print("Win:" + str(win))


                  sqlInsertInto += ", summonerId" + pid + ", champId" + pid + ", kills" + pid + ", deaths" + pid + ", assists" + pid + ", win" + pid
                  sqlValues += ", " + str(summonerId) + ", " + str(championId) + ", " + str(kills) + ", " + str(deaths)  + ", " + str(assists) + ", " + ("b'1'" if win == True else "b'0'")
                  sqlOnDuplicate += ", summonerId" + pid + " = " + str(summonerId) + ", champId" + pid + " = " + str(championId) + ", kills" + pid + " = " + str(kills) + ", deaths" + pid + " = " + str(deaths) + ", assists" + pid + " = " + str(assists) + ", win" + pid + " = " + ("b'1'" if win == True else "b'0'")

                  #Now it's time to do database stuff!

#                 sql = "INSERT INTO `" + str(championId) + "` (summonerId, wins, games, kills, deaths, assists, lastPlayed) VALUES (" + \
#                        str(summonerId) + ", " + \
#                        str(int(win)) + ", " + \
#                        str(1) + ", " + \
#                        str(kills) + ", " + \
#                        str(deaths) + ", " + \
#                        str(assists) + ", " + \
#                        str(daysSince2010GamePlayedAt) + ") " + \
#                        "ON DUPLICATE KEY UPDATE " + \
#                        "wins = wins + " + str(int(win)) + ", " +\
#                        "games = games + 1, " + \
#                        "kills = kills + " + str(kills) + ", " + \
#                        "deaths = deaths + " + str(deaths) + ", " + \
#                        "assists = assists + " + str(assists) + ", " + \
#                        "lastPlayed = " + str(daysSince2010GamePlayedAt) + ";"
                                 

                  #Drop the tables, if necessary, for testing.
                  #self.cur.execute("DROP TABLE `" + str(summonerId) + "`;")
              


            #Check if the average rank is Platinum.
            platCount = 0
            for j in range(0, 9):
                tier = body["participants"][j]["highestAchievedSeasonTier"]
                if tier == "PLATINUM" or tier == "DIAMOND" or tier == "MASTER" or tier == "CHALLENGER":
                    platCount += 1

            elo = ""

            if platCount > 5:
                #Do stuff here if the average rank is Platinum.
                elo = "Plat"
                sqlInsertInto += ", isPlatinum"
                sqlValues += ", 1"
                sqlOnDuplicate += ", isPlatinum = 1"
            else: 
                sqlInsertInto += ", isPlatinum"
                sqlValues += ", 0"
                sqlOnDuplicate += ", isPlatinum = 0"
           
                #More Plat Stuff (Possibly replace Champion.gg in the future)

            sqlInsertInto += ") "
            sqlValues += ") "
            sqlOnDuplicate += ";"

            sql = sqlInsertInto + sqlValues + sqlOnDuplicate

#            print(sql)

            self.cur.execute(sql)
            self.db.commit()

            #SoloQ Match closing operations here.
#            print(str(gameId) + " " + elo + ", " + str(response.status) + ",")

        #Control loop functions here.
        #Iterate match and record successful match.

        f = open("./limits/start_" + self.region + ".txt", "r")
        startLimit = f.read()
        f.close()

        if (response.meta["match"] > int(startLimit)):
          f = open("./limits/start_" + self.region + ".txt", 'w')
          f.write(str(response.meta["match"]))
          f.close()


    def process_exception(self, failure):
#        print("Mark caught an Exception: ")

#        print(failure.value)

         pass
#        print("Response:")
#        print(failure)
#        print("")
#        print("failure.value")
#        print(failure.value)
#        print("")
#        print("failure.request")
#        print(failure.request)
#        print("")
#
        #Need to record bad request in the database here.
        #Fields will be: Game Id, Response Code, and the rest will be empty.



#        f = open("./limits/start_" + self.region + ".txt", 'w')
#        f.write(str(self.match))
#        f.close()


