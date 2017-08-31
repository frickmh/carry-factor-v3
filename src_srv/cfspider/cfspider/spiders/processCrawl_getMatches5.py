import scrapy
from scrapy.crawler import CrawlerProcess
from scrapy.utils.project import get_project_settings
import sys

import signal

import time

import logging

import scrapy.crawler as crawler
from multiprocessing import Process, Queue
from twisted.internet import reactor

#USAGE
print("USAGE: python processCrawl_getMatches5.py 'region'")

if (len(sys.argv) == 1):
  print("Please specify a valid region (example: 'na1').")
  exit() 

#process = CrawlerProcess({
#  'USER_AGENT': 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)'
#})

print("Arguments:")
print(sys.argv[1])

region = sys.argv[1]

logging.getLogger('scrapy').setLevel(logging.WARNING)

#process.crawl('getMatches5', region=region)
#process.start() # the script will block here until the crawling is finished

# the wrapper to make it run more times
def run_spider():
  def f(q):
    try:
      process = CrawlerProcess(get_project_settings())
      deferred = process.crawl('getMatches5', region=region)
      deferred.addBoth(lambda _: reactor.stop())
      #process.start()
      #runner = crawler.CrawlerRunner()
      #deferred = runner.crawl('quotes')
      #deferred.addBoth(lambda _: reactor.stop())
      reactor.run()
      q.put(None)
    except Exception as e:
      q.put(e)

  q = Queue()
  p = Process(target=f, args=(q,))
  p.start()
  result = q.get()
  p.join()

  if result is not None:
    raise result

i = 0

running = True

while running == True:
#def signal_handler(signal, frame):
  def signal_handler(signal, frame):
    print('You pressed Ctrl+C!')
    global running
    print(running)
    running = False
    print("RunningTest: " + str(running))

  signal.signal(signal.SIGINT, signal_handler)


  print("Running: " + str(running))

  print('')
  print('run ' + str(i) + ':')
  print('run ' + str(i) + ':')
  print('run ' + str(i) + ':')
  print('run ' + str(i) + ':')
  print('run ' + str(i) + ':')
  print('run ' + str(i) + ':')
  print('')
  time.sleep(3)
  run_spider()

  i = i + 1

