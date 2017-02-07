#!/bin/sh
# Author: JElayeb
# Function: Select Only Required Categories to Block.


ACTIVE_LIST=`cat /etc/pihole/adlists.list |awk -F"/" '{print $7}'`
CUSTOM_LIST="/var/www/html/admin/manage/categories/custom.list"




list_active(){

cat /etc/pihole/adlists.list |awk -F"/" '{print $7}'

}


list_change(){

# `echo "${CATEGORIES}"|tr [:space:] \\n`

rm -f  ${CUSTOM_LIST}

for CT in `echo "${CATEGORIES}"`
do 
echo "http://127.0.0.1/admin/manage/categories/$CT" >> ${CUSTOM_LIST}
done
rm -f /etc/pihole/list.*.domains

sudo /usr/local/bin/pihole -g 2>&1 > /dev/null

cat ${CUSTOM_LIST} > /etc/pihole/adlists.list

sudo /usr/local/bin/pihole -g 2>&1 > /dev/null

}


while getopts a:l: option
do
        case "${option}"
        in
                a) 	ACTION=${OPTARG};;
                l)   	CATEGORIES=${OPTARG};;
	
        esac
done

shift $(( OPTIND - 1 ))

     	case $ACTION in
		"list")    list_active;;
		"change")  list_change;;
	esac
