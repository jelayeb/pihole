#!/bin/bash
# Author: Jasem Elayeb
# Add Custom Pi-HOle Black Lists Categories.
# Date: 30.01.2017
# Function: Add / Remove / Search DNS in the Black List.
# "../cgi-bin/pihole.sh -h \"$DN\" -c \"$CA\" -a \"$AC\"

LOG="/var/www/html/admin/manage/pihole.log"
Category_Path="/var/www/html/admin/manage/categories"

pihole_add(){

	echo "127.0.0.1  ${DN}" >> ${Category_Path}/${category}
	if [ $? -ne 0 ]
        then
		ERROR=$( {echo "127.0.0.1  ${DN}" >> ${Category_Path}/${category} } 2>&1)
		/bin/echo "there was an error adding ${DN} to ${category} Category..."
		/bin/echo "ERROR: ${ERROR}"
		exit 1
        else
		/bin/echo "${DN} was added successfully to the Category ${category}"
		sudo /usr/local/bin/pihole -g 2>&1 > /dev/null
		if [ $? -ne 0 ]
		then 
		echo "Problem Updating PiHOle Gravity..., Run Command pihole -g on the system"
		else
		echo "Updating PiH0le Gravity..."
		fi
	fi
}


pihole_remove(){
	FILES=`fgrep -irw " ${DN}" ${Category_Path}/ |awk -F: '{print $1}'`
	for Path in ${FILES}
	do
		CATEGORY=`echo ${Path}|awk -F/ '{print $8}'`
		/usr/bin/sed -i '/ '${DN}'/d' ${Path}
	if [ $? -ne 0 ]
	then
		/bin/echo "Problem Removing ${DN} from Categories ${CATEGORY}"
	else
		/bin/echo "${DN} was removed successfuly from categorie ${CATEGORY}"
		sudo /usr/local/bin/pihole -g 2>&1 > /dev/null
		if [ $? -ne 0 ]
		then 
		echo "Problem Updating PiHOle Gravity..., Run Command pihole -g on the system"
		else
		echo "Updating PiH0le Gravity..."
		fi
	fi
	done
}


pihole_search(){

fgrep -irw "${DN}" ${Category_Path}/ |awk -F"/" '{print $8}'|sed -e 's/\<127.0.0.1\>//g'
	
}

while getopts h:c:a: option
do
        case "${option}"
        in
                h) DN=${OPTARG};;
                c) CA=${OPTARG};;
                a) AC=${OPTARG};;
        esac
done

# map category id to filenames.

		case $CA 
		in
			"1") category="SocialNetworks";;
			"2") category="Pornography";;
			"3") category="HateDiscrimination";;
			"4") category="Banking";;
			"5") category="Shopping";;
			"6") category="Hacking";;
			"7") category="Gambling";;
			"8") category="Drugs";;
			"9") category="Sexuality";;
			"10") category="P2PFileSharing";;
			"11") category="Dating";;
			"12") category="Adware";;
			"13") category="Download";;
			"14") category="Demo";;
			"15") category="Violence";;
			"16") category="Warez";;
			"17") category="Models";;
			"18") category="Forums";;
			"19") category="Chat";;
			"20") category="Spyware";;

		esac
		
# check if no dns was entered and exit.
		
		if [ -z "$DN" ]
		then
			/bin/echo "no DNS was entered..."
			exit 1
		else

# select function regarding to action.

            case $AC in
			"1")     pihole_add;;
			"2")  pihole_remove;;
			"3")  pihole_search;;
		esac
			

       fi

