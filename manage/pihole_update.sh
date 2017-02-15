#!/bin/bash
# Author: Jasem Elayeb
# Add Custom Pi-HOle Black Lists Categories.
# Date: 15.02.2017
# Function: update category Black List on pihole with modified version.
# "../cgi-bin/pihole_update.sh"

custom_list="/var/www/html/admin/manage/categories/custom.list"
adlists_list="/etc/pihole/adlists.list"

pihole_update(){
		#sudo /usr/bin/cat ${custom_list} > ${adlists_list}
		/usr/bin/cat /var/www/html/admin/manage/categories/custom.list > /etc/pihole/adlists.list 
		sudo /usr/bin/dos2unix -q ${adlists_list}
		sudo /usr/bin/rm -f /etc/pihole/list.*127.0.0.1*.domains
		sudo /usr/local/bin/pihole -g 2>&1 > /dev/null
		if [ $? -ne 0 ]
		then 
		echo "Problem Updating PiHOle Gravity..., Run Command pihole -g on the system"
		else
		echo "Updating PiH0le Gravity..."
		fi
}

pihole_update
