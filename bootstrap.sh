#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y apache2-mpm-prefork php5 php5-curl php5-dev php5-gd php5-idn php5-imagick php5-imap php5-mysql
sudo a2enmod suexec rewrite ssl actions include vhost_alias

sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password vagrant'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password vagrant'
sudo apt-get update
sudo apt-get -y install mysql-server-5.5 php5-mysql apache2 php5

sudo locale-gen de_CH.UTF-8
sudo update-locale LANG=de_CH.UTF-8
echo "Europe/Zurich" | sudo tee /etc/timezone

sudo cp /vagrant/dev1/config/php/php.ini /etc/php5/apache2/php.ini

sudo a2dissite default
sudo cp /vagrant/dev1/config/apache/web /etc/apache2/sites-available/web
sudo a2ensite web

sudo cp /vagrant/dev1/config/apache/phpMyAdmin /etc/apache2/sites-available/phpMyAdmin
sudo a2ensite phpMyAdmin

sudo service apache2 reload
sudo rm -rf /var/www
sudo ln -fs /vagrant/dev1 /var/www

echo 'phpmyadmin phpmyadmin/dbconfig-install boolean false' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/app-password-confirm password vagrant' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password vagrant' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/password-confirm password vagrant' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/setup-password password vagrant' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/database-type select mysql' | sudo debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/app-pass password vagrant' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/mysql/app-pass password vagrant' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/mysql/app-pass password' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/password-confirm password vagrant' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/app-password-confirm password vagrant' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/app-password-confirm password vagrant' | sudo debconf-set-selections
echo 'dbconfig-common dbconfig-common/password-confirm password vagrant' | sudo debconf-set-selections

sudo apt-get -y install php5-xdebug
apt-get install unzip
wget http://downloads.sourceforge.net/project/phpmyadmin/phpMyAdmin/4.0.6/phpMyAdmin-4.0.6-all-languages.zip
unzip phpMyAdmin-4.0.6-all-languages.zip
mv phpMyAdmin-4.0.6-all-languages/ /vagrant/dev1/phpMyAdmin/
#cp /vagrant/config/phpMyAdmin/config.inc.php /var/www/phpMyAdmin/config.inc.php
chown www-data /vagrant/dev1/phpMyAdmin -R
chmod 775 /vagrant/dev1/phpMyAdmin -R

sudo /etc/init.d/apache2 restart
