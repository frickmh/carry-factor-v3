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

import urllib.request
from urllib.request import urlopen

#This spider crawls Matches in the Riot API.
#Region must be provided when calling from command line.
 
api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'


region = sys.argv[1]

match = sys.argv[2]

#match = 2536802224
        
print(region)

validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"]

if (region == '' or not region in validRegions):
  print("Warning:  Invalid region specified!")
  print("Please supply a valid region from command line.")
  print("e.g. 'scrapy crawl xxxxx -a region=na1'")
  time.sleep(5)

#Create database and cursor
db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                 user="frickmh",         # your username
                 passwd="rbbsbfh11",  # your password
                 db="carryfactor")        # name of the data base    

cur = db.cursor()


cur.execute("USE carryfactor_" + region + ";")

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

cur.execute(sql)



print(region)
  
print("INSTANTIATED at " + time.ctime() + "!")


 
url = "https://" + region + ".api.riotgames.com/lol/match/v3/matches/" + str(match) + "?api_key=" + api_key

print(url)

#time.sleep(5)

req = urllib.request.Request(url);

response = ""

try:
  response = urllib.request.urlopen(req).read()
except urllib.error.HTTPError as e:
  print(e.code)
  print(e.read())
  sys.exit()


#The spider will execute 'parse' every time it has a 200 request
print("PARSING!")

#Spider start time
startTime = time.time();

body = json.loads(response)
queueId = body["queueId"] #Has to be 420

gameId = body["gameId"]

print("Queue: " + str(queueId) + ", " + str(gameId))

print("GameId: " + str(gameId))

#time.sleep(5)

#420 is Solo Q.  Only analyze games from this queue.
if int(queueId) == 420:

    print("Solo Queue!")

    #Database ops here

    startTime = time.time()

    gameCreation = int(body["gameCreation"] / 1000)


    sqlInsertInto = "INSERT INTO `matches` (gameId, responseCode, gameCreation " 
    sqlValues = "VALUES (" + str(gameId) + ", " + str(200) + ", " + str(gameCreation)
    sqlOnDuplicate = "ON DUPLICATE KEY UPDATE responseCode = " + str(200) + ", gameCreation = " + str(gameCreation)

    for participantIdentity in body["participantIdentities"]:
      #print(participantIdentity)
      participantId = participantIdentity['participantId']
      summonerId = participantIdentity['player']['summonerId']
      summonerName = participantIdentity['player']['summonerName']

      print((time.time() - startTime) * 1000)
      for participant in body['participants']:
        if participant['participantId'] == participantId:
          #print("Matched!")
          #print(summonerName)
          stats = participant['stats']
          championId = participant['championId']
          win = stats['win']
          kills = stats['kills']
          deaths = stats['deaths']
          assists = stats['assists']
          cs = stats['totalMinionsKilled'] + stats['neutralMinionsKilled']
          #print(championId)

          pid = str(participantId - 1)


          #print("Win:" + str(win))


          #sqlInsertInto += ", summonerId" + pid + ", champId" + pid + ", kills" + pid + ", deaths" + pid + ", assists" + pid + ", win" + pid
          sqlInsertInto += ''.join((", summonerId", pid, ", champId", pid, ", kills", pid, ", deaths", pid, ", assists", pid, ", win", pid))
          #sqlValues += ", " + str(summonerId) + ", " + str(championId) + ", " + str(kills) + ", " + str(deaths)  + ", " + str(assists) + ", " + ("b'1'" if win == True else "b'0'")
          sqlValues += ''.join((", ", str(summonerId), ", ", str(championId), ", ", str(kills), ", ", str(deaths), ", ", str(assists), ", ", ("b'1'" if win == True else "b'0'")))
          #sqlOnDuplicate += ", summonerId" + pid + " = " + str(summonerId) + ", champId" + pid + " = " + str(championId) + ", kills" + pid + " = " + str(kills) + ", deaths" + pid + " = " + str(deaths) + ", assists" + pid + " = " + str(assists) + ", win" + pid + " = " + ("b'1'" if win == True else "b'0'")
          sqlOnDuplicate += ''.join((", summonerId", pid, " = ", str(summonerId), ", champId", pid, " = ", str(championId), ", kills", pid, " = ", str(kills), ", deaths", pid, " = ", str(deaths), ", assists", pid, " = ", str(assists), ", win", pid, " = ", ("b'1'" if win == True else "b'0'")))

          #Now it's time to do database stuff!


    print((time.time() - startTime) * 1000)
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

    #sql = sqlInsertInto + sqlValues + sqlOnDuplicate
    sql = ''.join((sqlInsertInto, sqlValues, sqlOnDuplicate))

    print("Time:")

    print((time.time() - startTime) * 1000)

    print(sql)

    cur.execute(sql)
    db.commit()

    #SoloQ Match closing operations here.
    print(str(gameId) + " " + elo + ", " + str(200) + ",")


