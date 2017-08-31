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

from scrapy import signals
from scrapy import exceptions

#This spider crawls Matches in the Riot API.
#Region must be provided when calling from command line.
class GetMatches3Spider(scrapy.Spider):
    name = "getMatches3"
 
    api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'


    region = ''




#    noMatchCount = 0   
    noMatchCountList = [0,0,0,0,0]

    match = 2536802224
    match = 2536802220
    matchList = [match, match+1, match+2, match+3, match+4]
        
#    lastSuccess = match
    lastSuccessList = [match, match+1, match+2, match+3, match+4]
    lastRankedSuccessList = [match, match+1, match+2, match+3, match+4]

#    retries = 0
    retriesList = [0,0,0,0,0]

    soloQcount = 0

    def __init__(self, region=''):
        print(region)
        self.region = region

        if (region == 'na1'):
          self.match = 2575901155 #original: #2536802220
          #self.match = 2572142050  #2536800000  #2571719865
        if (region == 'euw1'):
          self.match = 3289015705

        self.matchList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]
        self.lastSuccessList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]
        self.lastRankedSuccessList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]

        validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"]

        if (self.region == '' or not self.region in validRegions):
          print("Warning:  Invalid region specified!")
          print("Please supply a valid region from command line.")
          print("e.g. 'scrapy crawl xxxxx -a region=na1'")
          time.sleep(5)

#        self.noMatchCount = 0
        self.noMatchCountList = [0,0,0,0,0]
 
        self.cur.execute("USE carryfactor_" + self.region + ";")

        f = open("lastMatch_" + self.region + ".txt", "r")
        fileContents = f.read()
        f.close()

        try:
          lastMatchFile = int(fileContents)
          lmfMod = lastMatchFile % 5
          lastMatchFileRounded = lastMatchFile if lmfMod == 0 else lastMatchFile + (5 - lmfMod)
 
          self.match = lastMatchFileRounded
          self.matchList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]
          self.lastSuccessList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]
          self.lastRankedSuccessList = [self.match, self.match+1, self.match+2, self.match+3, self.match+4]

          print(lastMatchFileRounded)
          time.sleep(5)

        except:
          print("Last match not found!")
          time.sleep(5)


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
        
        print("STARTED!")        

        
#        url = "https://na1.api.riotgames.com/lol/match/v3/matches/" + str(self.match) + "?api_key=" + self.api_key
        
        urls = ["https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.match) + "?api_key=" + self.api_key,
        "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.match+1) + "?api_key=" + self.api_key,
        "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.match+2) + "?api_key=" + self.api_key,
        "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.match+3) + "?api_key=" + self.api_key,
        "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.match+4) + "?api_key=" + self.api_key]


#        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception)

        yield scrapy.Request(url=urls[0], callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':0})
        yield scrapy.Request(url=urls[1], callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':1})
        yield scrapy.Request(url=urls[2], callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':2})
        yield scrapy.Request(url=urls[3], callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':3})
        yield scrapy.Request(url=urls[4], callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':4})

    #The spider will execute 'parse' every time it has a 200 request
    def parse(self, response):
        print("PARSING!")
 
        #Spider start time
        startTime = time.time();
        body = json.loads(response.body)
        queueId = body["queueId"] #Has to be 420

        gameId = body["gameId"]

        gameCreation = body["gameCreation"]

        print(time.time())
        gameStartMinsAgo = (time.time() - gameCreation / 1000) / 60

        print(gameStartMinsAgo)

        if (gameStartMinsAgo < 120):
          print("Game start less than 120 mins ago!  Sleeping for 120 mins!")
          print("Sleep started at " + time.ctime())
 
          for i in range(1200 * 6):
            try:
              time.sleep(1)
            except KeyboardInterrupt:
              print("Caught Keyboard Interrupt!")
              try:
                sys.exit(0)
              except SystemExit:
                os._exit(0)

        

        slot = response.meta['slot']

        print("Queue: " + str(queueId) + ", " + str(self.soloQcount) + ", " + str(gameId))

        print("Solo Q count: " + str(self.soloQcount))


        #420 is Solo Q.  Only analyze games from this queue.
        if int(queueId) == 420:

            self.lastRankedSuccessList[slot] = gameId - slot

            self.soloQcount += 1

            #Database ops here

            gameCreation = body["gameCreation"]


            for participantIdentity in body["participantIdentities"]:
              print(participantIdentity)
              participantId = participantIdentity['participantId']
              summonerId = participantIdentity['player']['summonerId']
              summonerName = participantIdentity['player']['summonerName']


              for participant in body['participants']:
                if participant['participantId'] == participantId:
                  print("Matched!")
                  print(summonerName)
                  stats = participant['stats']
                  championId = participant['championId']
                  win = stats['win']
                  kills = stats['kills']
                  deaths = stats['deaths']
                  assists = stats['assists']
                  cs = stats['totalMinionsKilled'] + stats['neutralMinionsKilled']
                  secondsAt2010 = 40 * 365 * 24 * 60 * 60
                  print(championId)
                  secondsSince2010 = time.time() - secondsAt2010

                  daysSince2010 = round(secondsSince2010 / (60 * 60 * 24))
                  print(daysSince2010)


                  daysSince2010GamePlayedAt = round(((gameCreation / 1000) - secondsAt2010) / (60 * 60 * 24))

                  print(daysSince2010GamePlayedAt)
                  #Now it's time to do database stuff!



                  sql = "INSERT INTO `" + str(championId) + "` (summonerId, wins, games, kills, deaths, assists, lastPlayed) VALUES (" + \
                         str(summonerId) + ", " + \
                         str(int(win)) + ", " + \
                         str(1) + ", " + \
                         str(kills) + ", " + \
                         str(deaths) + ", " + \
                         str(assists) + ", " + \
                         str(daysSince2010GamePlayedAt) + ") " + \
                         "ON DUPLICATE KEY UPDATE " + \
                         "wins = wins + " + str(int(win)) + ", " +\
                         "games = games + 1, " + \
                         "kills = kills + " + str(kills) + ", " + \
                         "deaths = deaths + " + str(deaths) + ", " + \
                         "assists = assists + " + str(assists) + ", " + \
                         "lastPlayed = " + str(daysSince2010GamePlayedAt) + ";"

                  print(sql)

                  try:
                    self.cur.execute(sql)
                  except:
                    #Record size: 17 bytes
                    sqlInsert = "CREATE TABLE IF NOT EXISTS `" + str(championId) + "` (" + \
                      "summonerId INT UNSIGNED UNIQUE," + \
                      "wins SMALLINT UNSIGNED," + \
                      "games SMALLINT UNSIGNED," + \
                      "kills MEDIUMINT UNSIGNED," + \
                      "deaths MEDIUMINT UNSIGNED," + \
                      "assists MEDIUMINT UNSIGNED," + \
                      "lastPlayed SMALLINT UNSIGNED );"

                    print(sqlInsert)
                    self.cur.execute(sqlInsert)
                    self.cur.execute(sql)

                   

                  #Drop the tables, if necessary, for testing.
                  #self.cur.execute("DROP TABLE `" + str(summonerId) + "`;")
            

            self.db.commit()

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
                #More Plat Stuff (Possibly replace Champion.gg in the future)

            #SoloQ Match closing operations here.
            print(str(gameId) + " " + elo + ", " + str(response.status) + "," + str(self.noMatchCountList[slot]))

        #Control loop functions here.
        #Iterate match and record successful match.
#        self.match += 1        
#        self.noMatchCount = 0
#        self.lastSuccess = self.match

        f = open("lastMatch_" + self.region + ".txt", 'w')
        f.write(str(self.matchList[slot]))
        f.close()

        self.noMatchCountList[slot] = 0
        self.lastSuccessList[slot] = self.matchList[slot]
        self.matchList[slot] +=5

        url = "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.matchList[slot]) + "?api_key=" + self.api_key
             
#print("Stopping spider temorarily, for testing... Live spider will continue here...")

        
        
        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':slot})



    def process_exception(self, failure):
        print("Mark caught an Exception: ")

        print("Response:")
        print(failure)
        print("")
        print("failure.value")
        print(failure.value)
        print("")
        print("failure.request")
        print(failure.request)
        print("")

        search1 = "matches/"

        afterMatches=str(failure.request).find(search1)

        print(afterMatches)

        questionMark=str(failure.request).find('?')

        print(questionMark)

        matchString=str(failure.request)[afterMatches + len(search1):questionMark]

        print(matchString)

        slot = int(matchString)%5

        self.noMatchCountList[slot] += 1

        print("Consecutive failures: " + str(self.noMatchCountList[slot]))
        print("Retries: " + str(self.retriesList[slot]))
#        print("Last Success: " + str(self.lastSuccessList[slot]))
        print("Last Ranked Success: " + str(self.lastRankedSuccessList[slot]))

        maxAllowedConsecutiveFailures = 100
        maxRetries = 2 #3
        if self.noMatchCountList[slot] > maxAllowedConsecutiveFailures:
            print("Too many consecutive failures...")
            if self.retriesList[slot] < maxRetries:
                self.retriesList[slot] += 1
                self.noMatchCountList[slot] = 0
                self.matchList[slot] = self.lastRankedSuccessList[slot]
                print("Sleeping, then retrying...")
                print("Sleep started at " + time.ctime())
                for i in range(300):
                  try:
                    time.sleep(10)
                  except KeyboardInterrupt:
                    print("Caught Keyboard Interrupt!")
                    try:
                      sys.exit(0)
                    except SystemExit:
                      os._exit(0)
            else:
                self.retriesList[slot] = 0
                self.noMatchCountList[slot] = 0
                self.lastRankedSuccessList[slot] = self.matchList[slot]
                print("Spider continuing...")


        self.matchList[slot] += 5
        
        url = "https://" + self.region + ".api.riotgames.com/lol/match/v3/matches/" + str(self.matchList[slot]) + "?api_key=" + self.api_key
        print("Getting Next! (Not 200)")
        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception, dont_filter=True, meta={'slot':slot})




