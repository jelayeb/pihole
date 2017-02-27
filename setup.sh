#!/bin/bash
# Ver=0.9
# Move to pihole-cat with new interface
# clean up old installation and create backup before proceed. 

NOW="$(date +"%d%m%Y-%H:%M")"

yum install -y lighttpd-fastcgi.x86_64 dos2unix  > /dev/null

which pihole &> /dev/null
[ $? -ne 0 ] && echo -e " \e[31mError:\e[0m  PiHole is not Installed on the system,  install Pihole first then proceed with install.sh again.." && exit 1

echo -e " \e[32mOK:\e[0m PiHole is installed, Proceed with Setup....  "

if [ -d "/var/www/html/admin" ]
then
    echo -e " \e[32mOK:\e[0m PiHole Admin Structure exist, proceed with installation.." 

	if [ -d "/var/www/html/pihole-cat" ]
	then
		echo -e " \e[33mWarning:\e[0m PiHole-Cat Structure exist, proceed with Backup..."
		tar czf /var/www/html/pihole-cat.${NOW}.tar.gz --remove-files -P /var/www/html/pihole-cat /var/www/cgi-bin/pihole.sh /var/www/cgi-bin/pihole_update.sh
		chown root.root /var/www/html/pihole-cat.*
		chmod -o /var/www/html/pihole-cat.*
		echo "    copy new files to pihole-cat"
		cp -R pihole-cat /var/www/html/
		chown -R lighttpd:lighttpd /var/www/html/pihole-cat
		chmod -R 755 /var/www/html/pihole-cat
		echo "    copy new cgi-bin files"
		cp  pihole-cat/manage/*.sh /var/www/cgi-bin/
		chmod 755 /var/www/cgi-bin/pihole*.sh
		chown lighttpd /var/www/cgi-bin/pihole*.sh
		
	else
		echo "    copy new files to pihole-cat"
		cp -R pihole-cat /var/www/html/
		chown -R lighttpd:lighttpd /var/www/html/pihole-cat
		chmod -R 755 /var/www/html/pihole-cat
		echo "    copy new cgi-bin files"
		cp  pihole-cat/manage/*.sh /var/www/cgi-bin/
		chmod 755 /var/www/cgi-bin/pihole*.sh
		chown lighttpd /var/www/cgi-bin/pihole*.sh

	fi


	echo "    copy custom.list to adlists.list"
	cat ./pihole-cat/manage/categories/custom.list > /etc/pihole/adlists.list
	chown lighttpd /etc/pihole/adlists.list
	/usr/bin/dos2unix -q /etc/pihole/adlists.list
	echo "    remove old list.domains files"
	/usr/bin/rm -f /etc/pihole/list.*127.0.0.1*.domains
	chmod 755 /var/www/html/pihole-cat/manage/categories
		
	CGI_CONF=/etc/lighttpd/conf.d/cgi.conf

	if [ -f ${CGI_CONF} ]
	then
		grep ".sh\" => \"/usr/bin/sh\"" /etc/lighttpd/conf.d/cgi.conf > /dev/null
		if [ $? -ne 0 ]
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
			echo "    SH already enabled on cgi.conf"
		fi
	
	else
	
	echo -e " \e[31mError:\e[0m ${CGI_CONF} is not exist, check lighttpd setup, and try again.."
	exit 1
	
	fi
	grep "list.*127.0.0.1*.domains" /etc/sudoers.d/pihole > /dev/null
	if [ $? -ne 0 ]
	then
		echo "    Configure Sudo Rights"
		echo "lighttpd ALL=NOPASSWD: /usr/bin/rm -f /etc/pihole/list.*127.0.0.1*.domains" >> /etc/sudoers.d/pihole
		echo "lighttpd ALL=NOPASSWD: /usr/bin/dos2unix -q /etc/pihole/adlists.list" >> /etc/sudoers.d/pihole
	else
		echo "    Sudo Rights are Configured"
	fi
	
else
    echo -e " \e[31mError:\e[0m PiHole Admin structure is not exist, please check pihole installation and setup again..."
    exit 1
fi
