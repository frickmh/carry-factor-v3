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

import signal

#This spider crawls Matches in the Riot API.
#Region must be provided when calling from command line.
class GetMatches6Spider(scrapy.Spider):
    name = "getMatches6"
 
    api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'


    region = ''

    noMatchCount = 0   

    match = 2536802224
        
    lastSuccess = match

    soloQcount = 0

    gameId_buffer = []
    responseCode_buffer = []
    gameCreation_buffer = []
    isPlatinum_buffer = []

    summonerId0_buffer = []
    champId0_buffer = []
    kills0_buffer = []
    deaths0_buffer = []
    assists0_buffer = []
    win0_buffer = []

    summonerId1_buffer = []
    champId1_buffer = []
    kills1_buffer = []
    deaths1_buffer = []
    assists1_buffer = []
    win1_buffer = []

    summonerId2_buffer = []
    champId2_buffer = []
    kills2_buffer = []
    deaths2_buffer = []
    assists2_buffer = []
    win2_buffer = []

    summonerId3_buffer = []
    champId3_buffer = []
    kills3_buffer = []
    deaths3_buffer = []
    assists3_buffer = []
    win3_buffer = []

    summonerId4_buffer = []
    champId4_buffer = []
    kills4_buffer = []
    deaths4_buffer = []
    assists4_buffer = []
    win4_buffer = []

    summonerId5_buffer = []
    champId5_buffer = []
    kills5_buffer = []
    deaths5_buffer = []
    assists5_buffer = []
    win5_buffer = []

    summonerId6_buffer = []
    champId6_buffer = []
    kills6_buffer = []
    deaths6_buffer = []
    assists6_buffer = []
    win6_buffer = []

    summonerId7_buffer = []
    champId7_buffer = []
    kills7_buffer = []
    deaths7_buffer = []
    assists7_buffer = []
    win7_buffer = []

    summonerId8_buffer = []
    champId8_buffer = []
    kills8_buffer = []
    deaths8_buffer = []
    assists8_buffer = []
    win8_buffer = []

    summonerId9_buffer = []
    champId9_buffer = []
    kills9_buffer = []
    deaths9_buffer = []
    assists9_buffer = []
    win9_buffer = []

    def clearBuffers(self):
      self.gameId_buffer = []
      self.responseCode_buffer = []
      self.gameCreation_buffer = []
      self.isPlatinum_buffer = []

      self.summonerId0_buffer = []
      self.champId0_buffer = []
      self.kills0_buffer = []
      self.deaths0_buffer = []
      self.assists0_buffer = []
      self.win0_buffer = []

      self.summonerId1_buffer = []
      self.champId1_buffer = []
      self.kills1_buffer = []
      self.deaths1_buffer = []
      self.assists1_buffer = []
      self.win1_buffer = []

      self.summonerId2_buffer = []
      self.champId2_buffer = []
      self.kills2_buffer = []
      self.deaths2_buffer = []
      self.assists2_buffer = []
      self.win2_buffer = []

      self.summonerId3_buffer = []
      self.champId3_buffer = []
      self.kills3_buffer = []
      self.deaths3_buffer = []
      self.assists3_buffer = []
      self.win3_buffer = []

      self.summonerId4_buffer = []
      self.champId4_buffer = []
      self.kills4_buffer = []
      self.deaths4_buffer = []
      self.assists4_buffer = []
      self.win4_buffer = []

      self.summonerId5_buffer = []
      self.champId5_buffer = []
      self.kills5_buffer = []
      self.deaths5_buffer = []
      self.assists5_buffer = []
      self.win5_buffer = []

      self.summonerId6_buffer = []
      self.champId6_buffer = []
      self.kills6_buffer = []
      self.deaths6_buffer = []
      self.assists6_buffer = []
      self.win6_buffer = []

      self.summonerId7_buffer = []
      self.champId7_buffer = []
      self.kills7_buffer = []
      self.deaths7_buffer = []
      self.assists7_buffer = []
      self.win7_buffer = []

      self.summonerId8_buffer = []
      self.champId8_buffer = []
      self.kills8_buffer = []
      self.deaths8_buffer = []
      self.assists8_buffer = []
      self.win8_buffer = []

      self.summonerId9_buffer = []
      self.champId9_buffer = []
      self.kills9_buffer = []
      self.deaths9_buffer = []
      self.assists9_buffer = []
      self.win9_buffer = []



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

        class GracefulKiller:
          kill_now = False
          def __init__(self):
            signal.signal(signal.SIGINT, self.exit_gracefully)
            signal.signal(signal.SIGTERM, self.exit_gracefully)

          def exit_gracefully(self,signum, frame):
            print('You pressed Ctrl+C! getMatches5_spider Killing gracefully...')
            self.kill_now = True

        killer = GracefulKiller()

 
        for i in range(startMatchFile, endMatchFile):

          if killer.kill_now:
            break

          url = "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(i) + "?api_key=" + self.api_key
          
          #print(url
          
          if len(self.gameId_buffer) >= 100:
            #print(self.gameId_buffer)



            sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation, " +\
              "summonerId0, champId0, kills0, deaths0, assists0, win0, " +\
              "summonerId1, champId1, kills1, deaths1, assists1, win1, " +\
              "summonerId2, champId2, kills2, deaths2, assists2, win2, " +\
              "summonerId3, champId3, kills3, deaths3, assists3, win3, " +\
              "summonerId4, champId4, kills4, deaths4, assists4, win4, " +\
              "summonerId5, champId5, kills5, deaths5, assists5, win5, " +\
              "summonerId6, champId6, kills6, deaths6, assists6, win6, " +\
              "summonerId7, champId7, kills7, deaths7, assists7, win7, " +\
              "summonerId8, champId8, kills8, deaths8, assists8, win8, " +\
              "summonerId9, champId9, kills9, deaths9, assists9, win9, " +\
              "isPlatinum) "
            sqlValues = "VALUES "

            for j in range(0, len(self.gameId_buffer)):
               sqlValues = ''.join((sqlValues, "(", self.gameId_buffer[j], ", ", self.responseCode_buffer[j], ", ", self.gameCreation_buffer[j], ", ",\
                 self.summonerId0_buffer[j], ", ", self.champId0_buffer[j], ", ", self.kills0_buffer[j], ", ", self.deaths0_buffer[j], ", ", self.assists0_buffer[j], ", ", self.win0_buffer[j], ", ",\
                 self.summonerId1_buffer[j], ", ", self.champId1_buffer[j], ", ", self.kills1_buffer[j], ", ", self.deaths1_buffer[j], ", ", self.assists1_buffer[j], ", ", self.win1_buffer[j], ", ",\
                 self.summonerId2_buffer[j], ", ", self.champId2_buffer[j], ", ", self.kills2_buffer[j], ", ", self.deaths2_buffer[j], ", ", self.assists2_buffer[j], ", ", self.win2_buffer[j], ", ",\
                 self.summonerId3_buffer[j], ", ", self.champId3_buffer[j], ", ", self.kills3_buffer[j], ", ", self.deaths3_buffer[j], ", ", self.assists3_buffer[j], ", ", self.win3_buffer[j], ", ",\
                 self.summonerId4_buffer[j], ", ", self.champId4_buffer[j], ", ", self.kills4_buffer[j], ", ", self.deaths4_buffer[j], ", ", self.assists4_buffer[j], ", ", self.win4_buffer[j], ", ",\
                 self.summonerId5_buffer[j], ", ", self.champId5_buffer[j], ", ", self.kills5_buffer[j], ", ", self.deaths5_buffer[j], ", ", self.assists5_buffer[j], ", ", self.win5_buffer[j], ", ",\
                 self.summonerId6_buffer[j], ", ", self.champId6_buffer[j], ", ", self.kills6_buffer[j], ", ", self.deaths6_buffer[j], ", ", self.assists6_buffer[j], ", ", self.win6_buffer[j], ", ",\
                 self.summonerId7_buffer[j], ", ", self.champId7_buffer[j], ", ", self.kills7_buffer[j], ", ", self.deaths7_buffer[j], ", ", self.assists7_buffer[j], ", ", self.win7_buffer[j], ", ",\
                 self.summonerId8_buffer[j], ", ", self.champId8_buffer[j], ", ", self.kills8_buffer[j], ", ", self.deaths8_buffer[j], ", ", self.assists8_buffer[j], ", ", self.win8_buffer[j], ", ",\
                 self.summonerId9_buffer[j], ", ", self.champId9_buffer[j], ", ", self.kills9_buffer[j], ", ", self.deaths9_buffer[j], ", ", self.assists9_buffer[j], ", ", self.win9_buffer[j], ", ",\
                 self.isPlatinum_buffer[j], ")"));
               if j < len(self.gameId_buffer) - 1:
                 sqlValues += ", "
           

            sqlOnDuplicate = " ON DUPLICATE KEY UPDATE responseCode = VALUES(responseCode), gameCreation = VALUES(gameCreation), " +\
              "summonerId0 = VALUES(summonerId0), champId0 = VALUES(champId0), kills0 = VALUES(kills0), deaths0 = VALUES(deaths0), assists0 = VALUES(assists0), win0 = VALUES(win0), " +\
              "summonerId1 = VALUES(summonerId1), champId1 = VALUES(champId1), kills1 = VALUES(kills1), deaths1 = VALUES(deaths1), assists1 = VALUES(assists1), win1 = VALUES(win1), " +\
              "summonerId2 = VALUES(summonerId2), champId2 = VALUES(champId2), kills2 = VALUES(kills2), deaths2 = VALUES(deaths2), assists2 = VALUES(assists2), win2 = VALUES(win2), " +\
              "summonerId3 = VALUES(summonerId3), champId3 = VALUES(champId3), kills3 = VALUES(kills3), deaths3 = VALUES(deaths3), assists3 = VALUES(assists3), win3 = VALUES(win3), " +\
              "summonerId4 = VALUES(summonerId4), champId4 = VALUES(champId4), kills4 = VALUES(kills4), deaths4 = VALUES(deaths4), assists4 = VALUES(assists4), win4 = VALUES(win4), " +\
              "summonerId5 = VALUES(summonerId5), champId5 = VALUES(champId5), kills5 = VALUES(kills5), deaths5 = VALUES(deaths5), assists5 = VALUES(assists5), win5 = VALUES(win5), " +\
              "summonerId6 = VALUES(summonerId6), champId6 = VALUES(champId6), kills6 = VALUES(kills6), deaths6 = VALUES(deaths6), assists6 = VALUES(assists6), win6 = VALUES(win6), " +\
              "summonerId7 = VALUES(summonerId7), champId7 = VALUES(champId7), kills7 = VALUES(kills7), deaths7 = VALUES(deaths7), assists7 = VALUES(assists7), win7 = VALUES(win7), " +\
              "summonerId8 = VALUES(summonerId8), champId8 = VALUES(champId8), kills8 = VALUES(kills8), deaths8 = VALUES(deaths8), assists8 = VALUES(assists8), win8 = VALUES(win8), " +\
              "summonerId9 = VALUES(summonerId9), champId9 = VALUES(champId9), kills9 = VALUES(kills9), deaths9 = VALUES(deaths9), assists9 = VALUES(assists9), win9 = VALUES(win9), " +\
              "isPlatinum = VALUES(isPlatinum);"

            sql = sqlInsertInto + sqlValues + sqlOnDuplicate

            print("Inserting " + str(len(self.gameId_buffer)) + " soloQ matches into `matches` starting at " + self.gameId_buffer[0])
            #print(sql)

            self.cur.execute(sql)
            self.db.commit()

            f = open("./limits/start_" + self.region + ".txt", "r")
            startLimit = f.read()
            f.close()

            if (int(self.gameId_buffer[len(self.gameId_buffer) - 1]) > int(startLimit)):
              f = open("./limits/start_" + self.region + ".txt", 'w')
              f.write(self.gameId_buffer[len(self.gameId_buffer) - 1])
              f.close()

            self.clearBuffers()
            

          #time.sleep(5)
          yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception, meta={'match':i})
          #yield scrapy.Request(url=url, callback=self.parse, meta={'match':i})
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
          print("Parsing match " + str(response.meta["match"]) + ". Queue: " + str(queueId) + ".  Solo Q count: " + str(self.soloQcount))

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


#            sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation " 
#            sqlValues = "VALUES (" + str(gameId) + ", " + str(response.status) + ", " + str(gameCreation)
#            sqlOnDuplicate = "ON DUPLICATE KEY UPDATE responseCode = " + str(response.status) + ", gameCreation = " + str(gameCreation)

            self.gameId_buffer.append(str(gameId))
            self.responseCode_buffer.append(str(response.status))
            self.gameCreation_buffer.append(str(gameCreation))


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
                  pidInt = participantId - 1


#                  print("Win:" + str(win))


#                  sqlInsertInto += ", summonerId" + pid + ", champId" + pid + ", kills" + pid + ", deaths" + pid + ", assists" + pid + ", win" + pid
#                  sqlValues += ", " + str(summonerId) + ", " + str(championId) + ", " + str(kills) + ", " + str(deaths)  + ", " + str(assists) + ", " + ("b'1'" if win == True else "b'0'")
#                  sqlOnDuplicate += ", summonerId" + pid + " = " + str(summonerId) + ", champId" + pid + " = " + str(championId) + ", kills" + pid + " = " + str(kills) + ", deaths" + pid + " = " + str(deaths) + ", assists" + pid + " = " + str(assists) + ", win" + pid + " = " + ("b'1'" if win == True else "b'0'")

                  if pidInt == 0:
                    self.summonerId0_buffer.append(str(summonerId))
                    self.champId0_buffer.append(str(championId))
                    self.kills0_buffer.append(str(kills))
                    self.deaths0_buffer.append(str(deaths))
                    self.assists0_buffer.append(str(assists))
                    self.win0_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 1:
                    self.summonerId1_buffer.append(str(summonerId))
                    self.champId1_buffer.append(str(championId))
                    self.kills1_buffer.append(str(kills))
                    self.deaths1_buffer.append(str(deaths))
                    self.assists1_buffer.append(str(assists))
                    self.win1_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 2:
                    self.summonerId2_buffer.append(str(summonerId))
                    self.champId2_buffer.append(str(championId))
                    self.kills2_buffer.append(str(kills))
                    self.deaths2_buffer.append(str(deaths))
                    self.assists2_buffer.append(str(assists))
                    self.win2_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 3:
                    self.summonerId3_buffer.append(str(summonerId))
                    self.champId3_buffer.append(str(championId))
                    self.kills3_buffer.append(str(kills))
                    self.deaths3_buffer.append(str(deaths))
                    self.assists3_buffer.append(str(assists))
                    self.win3_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 4:
                    self.summonerId4_buffer.append(str(summonerId))
                    self.champId4_buffer.append(str(championId))
                    self.kills4_buffer.append(str(kills))
                    self.deaths4_buffer.append(str(deaths))
                    self.assists4_buffer.append(str(assists))
                    self.win4_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 5:
                    self.summonerId5_buffer.append(str(summonerId))
                    self.champId5_buffer.append(str(championId))
                    self.kills5_buffer.append(str(kills))
                    self.deaths5_buffer.append(str(deaths))
                    self.assists5_buffer.append(str(assists))
                    self.win5_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 6:
                    self.summonerId6_buffer.append(str(summonerId))
                    self.champId6_buffer.append(str(championId))
                    self.kills6_buffer.append(str(kills))
                    self.deaths6_buffer.append(str(deaths))
                    self.assists6_buffer.append(str(assists))
                    self.win6_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 7:
                    self.summonerId7_buffer.append(str(summonerId))
                    self.champId7_buffer.append(str(championId))
                    self.kills7_buffer.append(str(kills))
                    self.deaths7_buffer.append(str(deaths))
                    self.assists7_buffer.append(str(assists))
                    self.win7_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 8:
                    self.summonerId8_buffer.append(str(summonerId))
                    self.champId8_buffer.append(str(championId))
                    self.kills8_buffer.append(str(kills))
                    self.deaths8_buffer.append(str(deaths))
                    self.assists8_buffer.append(str(assists))
                    self.win8_buffer.append("b'1'" if win == True else "b'0'")

                  if pidInt == 9:
                    self.summonerId9_buffer.append(str(summonerId))
                    self.champId9_buffer.append(str(championId))
                    self.kills9_buffer.append(str(kills))
                    self.deaths9_buffer.append(str(deaths))
                    self.assists9_buffer.append(str(assists))
                    self.win9_buffer.append("b'1'" if win == True else "b'0'")


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
#                sqlInsertInto += ", isPlatinum"
#                sqlValues += ", 1"
#                sqlOnDuplicate += ", isPlatinum = 1"
                self.isPlatinum_buffer.append("b'1'")
            else: 
#                sqlInsertInto += ", isPlatinum"
#                sqlValues += ", 0"
#                sqlOnDuplicate += ", isPlatinum = 0"
                self.isPlatinum_buffer.append("b'0'")
           
                #More Plat Stuff (Possibly replace Champion.gg in the future)

#            sqlInsertInto += ") "
#            sqlValues += ") "
#            sqlOnDuplicate += ";"
#
#            sql = sqlInsertInto + sqlValues + sqlOnDuplicate
#
##            print(sql)
#
#            self.cur.execute(sql)
#            self.db.commit()

            #SoloQ Match closing operations here.
#            print(str(gameId) + " " + elo + ", " + str(response.status) + ",")

        #Control loop functions here.
        #Iterate match and record successful match.

#        f = open("./limits/start_" + self.region + ".txt", "r")
#        startLimit = f.read()
#        f.close()
#
#        if (response.meta["match"] > int(startLimit)):
#          f = open("./limits/start_" + self.region + ".txt", 'w')
#          f.write(str(response.meta["match"]))
#          f.close()


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


