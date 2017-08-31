Here are some things I need to do to set up my server!
There are a few things I wrote down that confused me!

Add bash commands to PATH variable, upon startup, by modifying the bash profile, as needed!  (See below)

Bash startup info:
       When bash is invoked as an interactive login shell, or as a  non-inter‐
       active  shell with the --login option, it first reads and executes com‐
       mands from the file /etc/profile, if that file exists.   After  reading
       that file, it looks for ~/.bash_profile, ~/.bash_login, and ~/.profile,
       in that order, and reads and executes commands from the first one  that
       exists  and  is  readable.  The --noprofile option may be used when the
       shell is started to inhibit this behavior.
	   
Looks like I'm going to have to re-initialize my server.

I shouldn't manually delete stuff or else everything gets messed up.
(I tried to delete Python3.5 with 'rm -r' and it messed up apt-get)

I need to find everything I want to keep:

#loltest1
var/www/public_html/scrapers/scrapers/spiders
@phptest
#sheetsTest

Then I need to back them up (HAVEN'T DONE YET) (DID IT!)

Then I need to at least try to plan what I need to do to set it back up:

Users
Apache Server (Probably some stuff I forgot how to do here)
	apache2.conf 
	sudo a2ensite 000-default.conf
	sudo service apache2 restart
	
	a2enmod headers (Some folders didn't show up in the index without this mod!)
	
I probably need this but I'm not sure
	sudo apt install php libapache2-mod-php
	sudo apt install php-cli
	
Upload Website Data
Set up Crontab

	5 4,16 * * * /usr/bin/python2 /var/www/public_html/data/updateChampStats.py
	15 4,16 * * * /usr/bin/php /var/www/public_html/data/buildRoles.php
	5 5 * * * /usr/bin/php /var/www/public_html/datadragon/updateDataDragon.php
	
Install Anaconda
	Get Anaconda from here! https://www.continuum.io/downloads
	bash Anaconda3-x.x.x-Linux-x86_64.sh 

Set up Scrapy, with Autothrottle
	conda install scrapy
Install MySQL
	https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-16-04
	sudo apt-get update
	sudo apt-get install mysql-server
	sudo mysql_secure_installation
Install MySQL Connector
    conda install -c anaconda mysql-connector-python 

