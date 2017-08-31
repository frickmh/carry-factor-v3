#This script deletes all tables from mysql database 'carryfactor' with no entries updated within the last 30 days.
#This script is intended to be run as a regular part of server upkeep in CRONTAB.
import MySQLdb
import time
import json

import requests

api_key = 'RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3'



db = MySQLdb.connect(host='localhost', user='frickmh', passwd='rbbsbfh11', db='carryfactor')

cur = db.cursor()

validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"]

for region in validRegions:
  print(region)

  if region == "pbe1":
    continue

  sql = "CREATE DATABASE IF NOT EXISTS carryfactor_" + region;

  cur.execute(sql);

  cur.execute("USE carryfactor_" + region)

  print(cur.execute("SHOW TABLES;"))

  alltables = cur.fetchall()

  for table in alltables:
    print(table[0])
    
    #I need to delete the table if it has no entries in the last 30 days.
   
    #Delete ALL tables (for debugging purposes)
    cur.execute("DROP TABLE `" + str(table[0]) +"`")

  db.commit()

  rChall = requests.get("https://" + region + ".api.riotgames.com/lol/league/v3/challengerleagues/by-queue/RANKED_SOLO_5x5?api_key=" + api_key)

  mostRecentMatch = 0

  for i in range(3):

    #print(rChall.json()["entries"])

    print(region + " " + str(i))

    summonerId = rChall.json()["entries"][i]["playerOrTeamId"]

    print(summonerId)

    rSumm = requests.get("https://" + region + ".api.riotgames.com/lol/summoner/v3/summoners/" + summonerId + "?api_key=" + api_key)

    print(rSumm.json())

    rMatchlist = requests.get("https://" + region + ".api.riotgames.com/lol/match/v3/matchlists/by-account/" + str(rSumm.json()["accountId"]) + "?queue=420&endIndex=1&beginIndex=0&api_key=" + api_key)

    print(rMatchlist)

    gameId = rMatchlist.json()["matches"][0]["gameId"]

    mostRecentMatch = gameId if gameId > mostRecentMatch else mostRecentMatch

  
  f = open("../cfspider/cfspider/spiders/limits/start_" + region + ".txt", 'w')
  f.write(str(mostRecentMatch))
  f.close()

  f = open("../cfspider/cfspider/spiders/limits/end_" + region + ".txt", 'w')
  f.write(str(mostRecentMatch + 10))
  f.close()



