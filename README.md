boiler-control-php
==================
The frontend to the boiler control program (https://github.com/james-jaynne/boiler-control).

This requires the Zend Framework (http://framework.zend.com/) installed to run.

For support please use this Raspberry Pi forum thread http://www.raspberrypi.org/phpBB3/viewtopic.php?f=37&t=22244

Install Instructions
==================
This is a two stage process as the program is in two parts - a web frontend and a java program that does the actual controlling. The control is in java as I felt it was more stable for a long running process that I want 100% uptime on like my heating!

You could do a more simple version of this without the java part running from cron jobs or something but my controller has a 16x2 lcd and buttons to manually boost the heating so needed something to control them.

Update your Pi and install apache, mysql and phpmyadmin

Enter a mysql root password and choose apache2 for phpmyadmin
<pre><code>sudo apt-get update
sudo apt-get install screen apache2 mysql-client mysql-server phpmyadmin
</code></pre>

Login to mysql - replace password with your password from above
<pre><code>mysql --user=root --pass=password
</code></pre>

Here we create a mysql user (pi) and password for the program. Replace 'password' with the password you would like for the normal pi user - ideally this should be different to the root password
<pre><code>CREATE USER 'pi'@'localhost' IDENTIFIED BY  'password';
GRANT USAGE ON * . * TO  'pi'@'localhost' IDENTIFIED BY  'password' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
CREATE DATABASE IF NOT EXISTS  `pi` ;
GRANT ALL PRIVILEGES ON  `pi` . * TO  'pi'@'localhost';
exit;
</code></pre>

Download the source from github and copy it to the right directories

<pre><code>wget https://github.com/james-jaynne/boiler-control-php/archive/master.zip
unzip master.zip

mysql --user=pi --pass=password pi &lt; boiler-control-php-master/sql/structure.sql
mysql --user=pi --pass=password pi &lt; boiler-control-php-master/sql/data.sql

sudo rm -R /var/www/*
sudo mv boiler-control-php-master/* /var/www
sudo a2enmod rewrite
</code></pre>

Here we need to modify the apache setup - ctrl-x exits

<pre><code>sudo nano /etc/apache2/sites-available/default
</code></pre>
Change DocumentRoot /var/www to DocumentRoot /var/www/public
<Directory /var/www/> to <Directory /var/www/public/>
Changes the first two instances of AllowOverride None to AllowOverride All

<pre><code>sudo /etc/init.d/apache2 restart
</code></pre>

Edit the config file to enter the mysql password
<pre><code>sudo nano /var/www/application/config/config.ini
</code></pre>
Change resources.db.params.password = "raspberry" to reflect your password

Download the zend framework 1 minimal from http://framework.zend.com/ and transfer it to your Pis home directory - you have to do this from your PC using a program like winscp.
Change the filenames below to reflect the version you have downloaded
<pre><code>tar -xzvf ZendFramework-1.12.0-minimal.tar.gz
sudo mv ZendFramework-1.12.0-minimal/library/* /var/www/library/
rm -R boiler-control-php-master/
rm master.zip
</code></pre>

You're done - you should be able to visit your Pis web page and load up the web frontend
