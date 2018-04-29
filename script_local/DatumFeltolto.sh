#!/bin/sh

FILE='/home/laci/Documents/Html/Ev_honlap/v14/index.php'

now="$(date +'%Y.%m.%d')"
sed  -i "s/.*Utoljára frissítve.*/Utoljára frissítve: $now/" "$FILE"
./FileFeltolto.sh index.php
