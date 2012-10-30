boiler-control-php
==================
The frontend to the boiler control program (https://github.com/james-jaynne/boiler-control).

This requires the Zend Framework (http://framework.zend.com/) installed to run.

Install Instructions
==================
This is a two stage process as the program is in two parts - a web frontend and a java program that does the actual controlling. The control is in java as I felt it was more stable for a long running process that I want 100% uptime on like my heating!

You could do a more simple version of this without the java part running from cron jobs or something but my controller has a 16x2 lcd and buttons to manually boost the heating so needed something to control them.

Anyway download the web part from https://github.com/james-jaynne/boiler-control-php and extract it all to /var/www
Also download the zend framework 1 minimal from http://framework.zend.com/ and extract the library folder to the library folder in /var/www 
You might also want to install Phpmyadmin as it makes managing the sql database easier. Use phpmyadmin or the command line sql tools to create a new database and import the two sql files from /var/www/sql (structure.sql first then data.sql). Now edit /var/www/application/config/config.ini and edit the following lines to reflect the username, database name and password you created.
[code]resources.db.params.dbname = "pi"
resources.db.params.username = "pi"
resources.db.params.password = "raspberry"[/code]

Finally edit the apache file and change the instances on lines 4 and 12 of /var/www to /var/www/public then restart apache - commands below
[code]sudo nano /etc/apache2/sites-enabled/000-default
sudo /etc/init.d/apache2 reload[/code]

You should now be able to visit the IP address of your Pi from a web browser and get the interface up and add groups and schedules.
