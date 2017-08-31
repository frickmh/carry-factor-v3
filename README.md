#External Stuff Needed:
# Anaconda3
#   mysqlclient 1.3.10
#   Scrapy
# MySQL
# imagemagick

#Will need NVM (Node Version Manager) to install node.

# Crontab tasks: (Change paths as needed)
#5 4,16 * * * /usr/bin/python /home/frickmh55449/public_html/data/updateChampStats.py
#15 4,16 * * * /usr/bin/php /home/frickmh55449/public_html/data/buildRoles.php
#5 5 * * * /usr/bin/php /home/frickmh55449/public_html/datadragon/updateDataDragon.php

#Other Tasks to execute:
#./src_srv/upkeep/resetDatabase.py (Run ON SETUP.  This initializes the database, and sets up start points for the spiders.)
#./src_srv/upkeep/cleanDatabase.py (This might need to go in Cron.  Deletes Database match records older than 30 days.)
#./src_srv/cfspider/cfspider/spiders/processCrawl_getMatches5.py na1 (Run on Startup.  This calls the spider, which crawls the API to update matches.)
#./app.js (The server)
