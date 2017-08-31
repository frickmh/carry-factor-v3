#This script deletes all tables from mysql database 'carryfactor' with no entries updated within the last 30 days.
#This script is intended to be run as a regular part of server upkeep in CRONTAB.
import MySQLdb
import time
import json





db = MySQLdb.connect(host='localhost', user='frickmh', passwd='rbbsbfh11', db='carryfactor')

cur = db.cursor()

#with open('../../public/data/champsList.json') as json_data:
#  d = json.load(json_data)
#  for champ in d['data']:
#    print(champ)        
#    #Record size: 17 bytes
#    sql = "CREATE TABLE IF NOT EXISTS `" + str(champ) + "` (" + \
#                 "summonerId INT UNSIGNED UNIQUE," + \
#                 "wins SMALLINT UNSIGNED," + \
#                 "games SMALLINT UNSIGNED," + \
#                 "kills MEDIUMINT UNSIGNED," + \
#                 "deaths MEDIUMINT UNSIGNED," + \
#                 "assists MEDIUMINT UNSIGNED," + \
#                 "lastPlayed SMALLINT UNSIGNED );"


#print(sql)
#    cur.execute(sql)


validRegions = ["br1", "eun1", "euw1", "jp1", "kr", "la1", "la2", "na1", "oc1", "tr1", "ru", "pbe1"]

for region in validRegions:
  print(region)

  sql = "CREATE DATABASE IF NOT EXISTS carryfactor_" + region;

  cur.execute(sql);

  cur.execute("USE carryfactor_" + region)

  print(cur.execute("SHOW TABLES;"))

  alltables = cur.fetchall()


  nowMinus30Days = time.time() - 60 * 60 * 24 * 30

  for table in alltables:
    print(table[0])
    
    #I need to delete the table if it has no entries in the last 30 days.
    sql = "DELETE FROM `" + str(table[0]) + "` WHERE gameCreation < " + str(nowMinus30Days) + ";"

    print (sql)
    cur.execute(sql)

    oldTables = cur.fetchall()

    print(oldTables)
    
    #Delete ALL tables (for debugging purposes)
    #cur.execute("DROP TABLE `" + str(table[0]) +"`")
  db.commit()
