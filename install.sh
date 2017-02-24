#!/bin/bash


which pihole &> /dev/null
[ $? -ne 0 ] && echo -e " \e[31mError:\e[0m  PiHole is not Installed on the system,  install Pihole first then proceed with install.sh again.." && exit 1

echo -e " \e[32mOK:\e[0m PiHole is installed, Proceed with Setup....  "

if [ -d "/var/www/html/admin" ]
then
    echo -e " \e[32mOK:\e[0m PiHole Admin Structure exist, proceed with installation.." 

cp -R manage /var/www/html/admin
chown -R lighttpd:lighttpd /var/www/html/admin/manage
chmod 755 /var/www/html/admin/manage
chmod 755 /var/www/html/admin/manage/categories
chmod 644 /var/www/html/admin/manage/categories/*

cp ./manage/pihole.sh /var/www/cgi-bin/
chmod 755 /var/www/cgi-bin/pihole.sh
chown lighttpd /var/www/cgi-bin/pihole.sh

cat ./manage/categories/custom.list >> /etc/pihole/adlists.list

chmod 755 /var/www/html/admin/manage/categories
pihole -g

CGI_CONF=/etc/lighttpd/conf.d/cgi.conf

if [ -f ${CGI_CONF} ]
then
CGI_UPDATE=`cat <<EOCGI
alias.url += ( "/cgi-bin" => server_root + "/cgi-bin" )
$HTTP["url"] =~ "^/cgi-bin" {
   cgi.assign = ( ".sh" => "/usr/bin/sh" )
}
EOCGI
`
echo -e ${CGI_UPDATE} >> ${CGI_CONF}

else

echo -e " \e[31mError:\e[0m ${CGI_CONF} is not exist, check lighttpd setup, and try again.."
exit 1

fi

else
    echo -e " \e[31mError:\e[0m PiHole Admin structure is not exist, please check pihole version and setup again..."
    exit 1
fi
