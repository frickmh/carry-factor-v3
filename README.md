# Carry Factor - League of Legends Match Analysis Tool
Carry-factor.com was a web utility designed to analyze player matchups for the online game League of Legends by Riot Games.  
A player could look up the game they were active in to see detailed statistics which would give them an advantage over other players.
  
The web client would send a request to Carry-factor.com, which in turn would collect match data from the Riot Games public web API.  
The raw JSON response from the Riot Games API was processed by Carry-factor.com, and a response was sent back to the client.  The data from this response would populate the content displayed in the web page.  

The web client would continue to send requests to Carry-factor.com as the user interacted with dynamic elements on the web page.  
  
Video Demo:
https://www.youtube.com/watch?v=4lftaUaMcOc
  
## What Did I Learn?  
- The importance of separating the data layer from controls
- One-way data flow between components
- Handling asynchronous communication
- How to create JSON structures to pass data between application components




# External Software Needed:
Anaconda3  
mysqlclient 1.3.10  
Scrapy  
MySQL  
imagemagick  
Will need NVM (Node Version Manager) to install node.

# Global npm modules:
#supervisor
#pm2

# Crontab tasks: (Change paths as needed)
#5 4,16 * * * /usr/bin/python /home/frickmh55449/public_html/data/updateChampStats.py
#15 4,16 * * * /usr/bin/php /home/frickmh55449/public_html/data/buildRoles.php
#5 5 * * * /usr/bin/php /home/frickmh55449/public_html/datadragon/updateDataDragon.php
#6 5 * * * /usr/bin/python /home/frickmh/carry-factor-v3/src_srv/upkeep/cleanDatabase.py
#@reboot /bin/bash /home/frickmh/carry-factor-v3/src_srv/cfspider/cfspider/spiders/start_cfspider.sh

#Other Tasks to execute:
#./src_srv/upkeep/resetDatabase.py (Run ON SETUP.  This initializes the database, and sets up start points for the spiders.)
#./src_srv/upkeep/cleanDatabase.py (This might need to go in Cron.  Deletes Database match records older than 30 days.)
#./src_srv/cfspider/cfspider/spiders/processCrawl_getMatches5.py na1 (Run on Startup.  This calls the spider, which crawls the API to update matches.)
#./app.js (The server)
