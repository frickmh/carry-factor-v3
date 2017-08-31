#!/usr/bin/env python

import json
from pprint import pprint
import os
import sys


import scrapy
from scrapy.crawler import CrawlerProcess

from collections import OrderedDict

#IMPORTANT NOTES
#In order to import non-standard modules (i.e. scrapy), PHP must call:
#
#    'export PATH=~/anaconda3/bin:$PATH ; <My_Example_Python_Script.py>'
#
#Or else the module cannot be imported!!!


class CFSpider(scrapy.Spider):
    name = "CF_spider"

    #Will look like:
    #'{"names":["LiquidHandsoap","Press1ifSloth"],"region":"na","region1":"NA1"}'
    
    names = '{}';
    region = '';
    region1 = '';
    outputJSON = '{}';

    def __init__(self, dataJSONinPy=None, **kwargs):
        super(CFSpider, self).__init__(**kwargs)
        #self.start_urls = ['http://www.example.com/categories/%s' % category]
        #print(json.loads('["foo", {"bar":["baz", null, 1.0, 2]}]'))
        
        self.outputJSON = json.loads('{}');
        
        self.names = json.loads(dataJSONinPy)['names']
        self.region = json.loads(dataJSONinPy)['region']
        self.region1 = json.loads(dataJSONinPy)['region1']
        
        self.outputJSON['region'] = self.region
        self.outputJSON['region1'] = self.region1
        self.outputJSON['names'] = json.loads('{}')
        
        #print(self.names)
        
    
    def start_requests(self):
        for sname in self.names:
            #self.outputJSON['names'][sname] = json.loads('{ name : ' + sname + ' }')
            self.outputJSON['names'][sname] = json.loads('{}')
            self.outputJSON['names'][sname]['name'] = sname
            #urls.append("https://" + self.region1 + ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" + sname + "?api_key=" + apiKey)
            url = "https://" + self.region1 + ".api.riotgames.com/lol/summoner/v3/summoners/by-name/" + sname + "?api_key=" + apiKey
            request = scrapy.Request(url=url, callback=self.parseNames)
            request.meta['sname'] = sname
            yield request
        
        #https://NA1.api.riotgames.com/lol/summoner/v3/summoners/by-name/NovaDisk?api_key=api_key=55b49f8b-52e1-4cbc-b7cf-d30a054b7833

    def parseNames(self, response):
        #page = response.url.split("/")[-2]
        #filename = 'quotes-%s.html' % page
        #with open(filename, 'wb') as f:
        #    f.write(response.body)
        #self.log('Saved file %s' % filename)
        responseBody = json.loads(response.body)
        #print(responseBody)
        
        #print(response.meta['sname'])
        self.outputJSON['names'][response.meta['sname']]['id'] = responseBody['id']
        self.outputJSON['names'][response.meta['sname']]['accountId'] = responseBody['accountId']
        #self.outputJSON['newField'] = "Hello"
        #print(self.outputJSON[response.meta['sname']])
        
        #print("Output:")
        #print(self.outputJSON)
        #print("Input:")
        
        url = "https://" + region1 + ".api.riotgames.com/lol/league/v3/positions/by-summoner/" + str(self.outputJSON['names'][response.meta['sname']]['id']) + "?api_key=" + apiKey
        requestLeagues = scrapy.Request(url=url, callback=self.parseLeagues)
        requestLeagues.meta['sname'] = response.meta['sname']
        yield requestLeagues
        
        url = "https://" + region1 + ".api.riotgames.com/lol/match/v3/matchlists/by-account/" + str(self.outputJSON['names'][response.meta['sname']]['accountId']) + \
        "?queue=420&endIndex=20&beginIndex=0&api_key=" + apiKey
        requestMatchlist = scrapy.Request(url=url, callback=self.parseMatchlist)
        requestMatchlist.meta['sname'] = response.meta['sname']
        yield requestMatchlist
        
        
    def parseLeagues(self, response):
        leagues = json.loads(response.body)
        print("Getting Leagues:")
        for league in leagues:
            #print(league)
            #print(league['queueType'])
            if league['queueType'] == "RANKED_SOLO_5x5":
                #print("Solo Queue!")
                #print(league["tier"])
                #miniSeries
                self.outputJSON['names'][response.meta['sname']]['league'] = json.loads('{}')
                self.outputJSON['names'][response.meta['sname']]['league']['tier'] = league["tier"]
                self.outputJSON['names'][response.meta['sname']]['league']['rank'] = league["rank"]
                self.outputJSON['names'][response.meta['sname']]['league']['leaguePoints'] = league["leaguePoints"]
                if "miniSeries" in league:
                    self.outputJSON['names'][response.meta['sname']]['league']['miniSeries'] = league["miniSeries"]
                #print("Output after Leagues:")
                #print(self.outputJSON)
    
    def parseMatchlist(self, response):
        matchlist = json.loads(response.body)['matches']
        matchCount = len(matchlist)
        roleCount = json.loads('{}')
        self.outputJSON['names'][response.meta['sname']]['recent'] = json.loads('{}')
        self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'] = []
        roleCount['total'] = 0
        for match in matchlist:
            roleCount['total'] += 1
            self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'].append({ match['gameId'] : match['gameId']}) #<=== HERE
            if match['lane'] in roleCount:
                roleCount[match['lane']] += 1
            else:
                roleCount[match['lane']] = 1
        self.outputJSON['names'][response.meta['sname']]['recent']['roles'] = roleCount
        #print("Output after Roles:")
        #print(self.outputJSON)
        
        if len(self.outputJSON['names'][response.meta['sname']]['recent']['matchlist']) > 0:
            url = "https://" + region1 + ".api.riotgames.com/lol/match/v3/matches/" + str(matchlist[0]['gameId']) + "?api_key=" + apiKey
            requestNextMatch = scrapy.Request(url=url, callback=self.parseNextMatch)
            requestNextMatch.meta['sname'] = response.meta['sname']
            requestNextMatch.meta['index'] = 0
            yield requestNextMatch

        
        
        
        
        
    def parseNextMatch(self, response):
        #Do stuff with the match data here...
        index = response.meta['index']
        participantId = -1;
        
        matchData = json.loads(response.body)
        
        for participant in matchData['participantIdentities']:
            if participant['player']['summonerId'] == self.outputJSON['names'][response.meta['sname']]['id']:
                participantId = participant['participantId']
                
        pData = matchData['participants'][participantId - 1]
        
        stats = json.loads('{}')
        
        stats['championId'] = pData['championId']
        stats['win'] = pData['stats']['win']
        stats['kills'] = pData['stats']['kills']
        stats['deaths'] = pData['stats']['deaths']
        stats['assists'] = pData['stats']['assists']
        stats['cs'] = pData['stats']['totalMinionsKilled'] + pData['stats']['neutralMinionsKilled']
        
        
        self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'][index]['stats'] = stats

        #print("Matchlist Item:")
        #print(self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'][index])
        
        #print("Output after Match Parse:")
        #print(self.outputJSON)        
        
        #print("Got Index: " + str(index))
        #print("Matchlist Length: " + str(len(self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'])))
        #check if we should continue
        if index + 1 < len(self.outputJSON['names'][response.meta['sname']]['recent']['matchlist']):
            url = "https://" + region1 + ".api.riotgames.com/lol/match/v3/matches/" + str(self.outputJSON['names'][response.meta['sname']]['recent']['matchlist'][index + 1].keys()[0]) \
            + "?api_key=" + apiKey
            print("Sending URL:   " + url)
            requestNextMatch = scrapy.Request(url=url, callback=self.parseNextMatch)
            requestNextMatch.meta['sname'] = response.meta['sname']
            requestNextMatch.meta['index'] = index + 1   
            print("Calling Next Match!")
            yield requestNextMatch
        else:
            #Total and average all the match data
            print("Time to total/average the data!")
            matchlist = self.outputJSON['names'][response.meta['sname']]['recent']['matchlist']
            
            statsAvg = json.loads('{}')
            
            if (len(matchlist) > 0):
                for match in matchlist:
                    pprint(match)
                    
                    sChampId = str(match['stats']['championId'])
                    
                    if sChampId in statsAvg:
                        statsAvg[sChampId]['games'] += 1
                        statsAvg[sChampId]['kills'] += match['stats']['kills']
                        statsAvg[sChampId]['deaths'] += match['stats']['deaths']
                        statsAvg[sChampId]['assists'] += match['stats']['assists']
                        statsAvg[sChampId]['cs'] += match['stats']['cs']
                        if match['stats']['win']:
                            statsAvg[sChampId]['wins'] += 1
                    else:
                        statsAvg[sChampId] = json.loads('{}')
                        statsAvg[sChampId]['games'] = 1
                        statsAvg[sChampId]['kills'] = match['stats']['kills']
                        statsAvg[sChampId]['deaths'] = match['stats']['deaths']
                        statsAvg[sChampId]['assists'] = match['stats']['assists']
                        statsAvg[sChampId]['cs'] = match['stats']['cs']
                        if match['stats']['win']:
                            statsAvg[sChampId]['wins'] = 1
                        else:
                            statsAvg[sChampId]['wins'] = 0
                
                
                #Divide sum of each stat to get average stats.
                for champId in statsAvg:
                    print("champStats: ")
                    print(champId)
                    print("statsAvg: ")
                    print(statsAvg)
                    
                    statsAvg[champId]['kills'] = float(statsAvg[champId]['kills']) / float(statsAvg[champId]['games'])
                    statsAvg[champId]['deaths'] = float(statsAvg[champId]['deaths']) / float(statsAvg[champId]['games'])
                    statsAvg[champId]['assists'] = float(statsAvg[champId]['assists']) / float(statsAvg[champId]['games'])
                    statsAvg[champId]['cs'] = float(statsAvg[champId]['cs']) / float(statsAvg[champId]['games'])
                    statsAvg[champId]['winPct'] = float(statsAvg[champId]['wins']) / float(statsAvg[champId]['games'])
                            
            print("Stats After: ")
            print(statsAvg)
            
            #Sort stats by number of games played, in descending order.
            statsSorted = OrderedDict(sorted(statsAvg.iteritems(), key=lambda x: x[1]['games'], reverse=True))
            
            print("Stats Sorted: ")
            print(statsSorted)
            
            self.outputJSON['names'][response.meta['sname']]['recent']['stats'] = statsSorted
                        
            #pprint(self.outputJSON['names'][response.meta['sname']])
            
            
        
                
        
        
#Use these lines to start Scrapy spider!        
process = CrawlerProcess({
    'USER_AGENT': 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)'
})

#Temp string, will use input from PHP!
tempString = '{"names":["GundayMonday"],"region":"na","region1":"NA1"}'

#sys.argv[1] is the command line argument from PHP!
#dataJSONFromPHP = sys.argv[1]

#COMMENT THIS OUT WHEN IT'S TIME TO CONNECT
#dataJSONFromPHP = tempString

apiKey = "55b49f8b-52e1-4cbc-b7cf-d30a054b7833"
region = "na"
region1 = "na1"
names = ["NovaDisk","hashinshin","Super Metroid","GundayMonday","Marine Revenge"]


#process.crawl(CFSpider, dataJSONinPy=dataJSONFromPHP)
#process.start() # the script will block here until the crawling is finished        
        

frames = {}
