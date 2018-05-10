#!/bin/sh

FILE='/home/laci/Documents/evhonlap/index.php'

now="$(date +'%Y.%m.%d')"
sed  -i "s/.*Utoljára frissítve.*/Utoljára frissítve: $now/" "$FILE"
./FileFeltolto.sh index.php
