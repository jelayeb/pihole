#!/bin/bash

yum install -y dos2unix

cp ./manage/pihole_* /var/www/html/admin/manage/
chown lighttpd /var/www/html/admin/manage/pihole_*
cp -r ./manage/data /var/www/html/admin/manage/
chown -R lighttpd /var/www/html/admin/manage/data
chown lighttpd /etc/pihole/adlists.list

cp ./manage/pihole_update.sh /var/www/cgi-bin/
chown lighttpd /var/www/cgi-bin/pihole_update.sh
chmod +x /var/www/cgi-bin/pihole_update.sh

mv /var/www/html/admin/scripts/pi-hole/php/header.php /var/www/html/admin/scripts/pi-hole/php/header.php.org
cp ./manage/header.php /var/www/html/admin/scripts/pi-hole/php/


echo "lighttpd ALL=NOPASSWD: /usr/bin/rm -f /etc/pihole/list.*127.0.0.1*.domains" >> /etc/sudoers.d/pihole
echo "lighttpd ALL=NOPASSWD: /usr/bin/dos2unix -q /etc/pihole/adlists.list" >> /etc/sudoers.d/pihole
