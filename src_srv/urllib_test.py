#from urllib.request import urlopen
#from urllib.error import HTTPError
#from urllib.request import urlopen
#import urllib.error
import urllib2
from threading import Thread

import signal
import time

#BASE_URL = 'http://farmsubsidy.org/DE/browse?page='
#"https://na1.api.riotgames.com/lol/match/v3/matches/2587058003?api_key=RGAPI-09cc601b-d1b5-4315-b054-70651b99bf45"
BASE_URL = "https://na1.api.riotgames.com/lol/match/v3/matches/"

#?api_key=RGAPI-09cc601b-d1b5-4315-b054-70651b99bf45"

start = 2581857125
end = start + 1000

NUM_RANGE = range(start, end)
THREADS = 15

THREADS_DONE = 0

startTime = time.time()

def main():
    for nums in split_seq(NUM_RANGE, THREADS):
        t = Spider(BASE_URL, nums, threadComplete)
        t.start()

        i = 0

    #Keep the main thread alive so it can catch kill signals.
    while not killer.kill_now:
      time.sleep(1)

def threadComplete():
  global THREADS_DONE, THREADS, startTime
  THREADS_DONE += 1
  print("Got Thread Complete Callback! Threads done: " + str(THREADS_DONE))
  if (THREADS_DONE == THREADS):
    killer.kill_now = True
    print("All threads completed.  Duration: " + str(time.time() - startTime) + " sec")

class GracefulKiller:
  kill_now = False
  def __init__(self):
    signal.signal(signal.SIGINT, self.exit_gracefully)
    signal.signal(signal.SIGTERM, self.exit_gracefully)

  def exit_gracefully(self,signum, frame):
    print('You pressed Ctrl+C! getMatches6_spider Killing gracefully...')
    self.kill_now = True

killer = GracefulKiller()


def split_seq(seq, num_pieces):
    start = 0
    for i in range(num_pieces):
        stop = start + len(seq[i::num_pieces])
        yield seq[start:stop]
        start = stop

class Spider(Thread):
    def __init__(self, base_url, nums, threadComplete):
        Thread.__init__(self)
        self.base_url = base_url
        self.nums = nums
        self.threadComplete = threadComplete
 
    def run(self):
      for num in self.nums:
            if killer.kill_now:
              break

            url = '%s%s' % (self.base_url, num)
            try: 
              data = urllib2.urlopen(url + "?api_key=RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3").read()
              #data = urlopen(url + "?api_key=RGAPI-5b0d8123-1e60-9d93-5d4e-a937592128e3").read()
              #print(data)
              print("Crawled " + url)
            #except urllib.error.HTTPError as e:
            except urllib2.HTTPError as e:
              error_message = e.read()
              print(error_message)
              if e.code == 429:
                time.sleep(10)
      print("Thread done!")
      self.threadComplete()



if __name__ == '__main__':
    main()
