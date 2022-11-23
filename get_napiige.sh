#!/usr/bin/sh

set -e

URL='https://www.evangelikus.hu/hitunk/lelki-taplalek?napiigenap='
BOTH_OF_THEM='s/.*<h5>Napi igék<\/h5>\(.*\)<h5>Olvasmányok<\/h5>.*/\1/'
FIRST_OF_TWO='s/\s*<p>\(.*\)<\/p>\s*<p>.*/\1/'
SEPARATE='s/^\(.*\)(\(.*\))\s*$/\1\n\2/'

start_date="$1"
number_of_days="$2"

for i in `seq 0 $number_of_days`
do
    datum=`date -d "$start_date $i days" +%Y-%m-%d`
    echo "$datum:"
    curl -s "$URL$datum" | tr '\n' ' ' | sed -e "$BOTH_OF_THEM" | sed -e "$FIRST_OF_TWO" | sed -e "$SEPARATE"
    printf "\n\n\n"
done
