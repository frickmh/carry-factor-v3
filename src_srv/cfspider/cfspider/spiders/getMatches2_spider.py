#
#Match numbers starting at: 2536802224
#Matches go to at least: 2541354219

#Test URL: https://na1.api.riotgames.com/lol/match/v3/matches/2536802224?api_key=RGAPI-adfe4a14-d491-4f12-a50f-833c09b1c138

#Production Key:  55b49f8b-52e1-4cbc-b7cf-d30a054b7833

#Rate Limit: 3k/10s, 180k/600s

#Test 2 URL: https://na1.api.riotgames.com/lol/match/v3/matches/2536802224?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833


import scrapy
import json
import time
import MySQLdb

from scrapy import signals
from scrapy import exceptions

#This spider crawls Matches in the Riot API.
class QuotesSpider(scrapy.Spider):
    name = "getMatches2"
    
    noMatchCount = 0   
    match = 2536802224
        
    lastSuccess = match
    retries = 0

    def __init__(self):
        self.noMatchCount = 0

    #Create database and cursor
    db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="frickmh",         # your username
                     passwd="rbbsbfh11",  # your password
                     db="TUTORIALS")        # name of the data base    
    
    cur = db.cursor()

    print("INSTANTIATED!")

    def start_requests(self):
        
        print("STARTED!")        

        
        url = "https://na1.api.riotgames.com/lol/match/v3/matches/" + str(self.match) + "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"

        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception)


    def parse(self, response):
        print("PARSING!")
        #page = response.url.split("/")[-2]

        self.match += 1        
        self.noMatchCount = 0
        self.lastSuccess = self.match

        body = json.loads(response.body)
        queueId = body["queueId"] #Has to be 420

        if int(queueId) == 420:

            platCount = 0

            for j in range(0, 9):
                tier = body["participants"][j]["highestAchievedSeasonTier"]
                if tier == "PLATINUM" or tier == "DIAMOND" or tier == "MASTER" or tier == "CHALLENGER":
                    platCount += 1
                
                
           
            elo = ""

            if platCount > 5:
                elo = "Plat"

            gameId = body["gameId"]

            print(str(gameId) + " " + elo + ", " + str(response.status) + "," + str(self.noMatchCount))
            #filename = 'match-%s.json' % gameId
            #with open(filename, 'wb') as f:
            #    f.write(response.body)
            #    f.flush()
            #    f.close()
            #    self.log('Saved file %s' % filename)

        url = "https://na1.api.riotgames.com/lol/match/v3/matches/" + str(self.match) + "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"
             
        print("Getting next! (200)")
        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception)



    def process_exception(self, response):
        print("Mark caught an Exception: ")
        self.noMatchCount += 1

        if self.noMatchCount > 2:
            print("Too many consecutive failures...")
            if self.retries < 3:
                self.retries += 1
                self.match = self.lastSuccess
                print("Sleeping, then retrying...")
                time.sleep(5)
            else:
                self.retries = 0
                self.noMatchCount = 0
                self.lastSuccess = self.match
                print("Spider continuing...")


        self.match += 1
        
        url = "https://na1.api.riotgames.com/lol/match/v3/matches/" + str(self.match) + "?api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833"
        print("Getting Next! (Not 200)")
        yield scrapy.Request(url=url, callback=self.parse, errback=self.process_exception, dont_filter=True)




