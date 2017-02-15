#!/bin/bash


cp ./manage/pihole_* /var/www/html/admin/manage/
chown lighttpd /var/www/html/admin/manage/pihole_*
cp -r ./manage/data /var/www/html/admin/manage/
chown -R lighttpd /var/www/html/admin/manage/data
chown lighttpd /etc/pihole/adlists.list



echo "lighttpd ALL=NOPASSWD: /usr/bin/rm -f /etc/pihole/list.*127.0.0.1*.domains" >> /etc/sudoers.d/pihole
echo "lighttpd ALL=NOPASSWD: /usr/bin/dos2unix -q /etc/pihole/adlists.list" >> /etc/sudoers.d/pihole