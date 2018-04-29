#!/bin/sh

HOST='ftp.lutheran.hu'
USER='budakeszi'
PASSWD='sW73943kD'
ROOT_DIR='/home/laci/Documents/Html/Ev_honlap/'
VERSION=v14

#Ellenőrzi, melyik folderbe/-ből kell a filet feltölteni
#Olyan filet nem enged feltöletni, ami nem található meg a honlapon
if [ -e "$ROOT_DIR$VERSION/content/$1" ] 
then
	TARGET_DIR=content
elif [ -e "$ROOT_DIR$VERSION/script/$1" ]
then
	TARGET_DIR=script
elif [ -e "$ROOT_DIR$VERSION/$1" ]
then
	TARGET_DIR=.
else
	echo "Ilyen file nincs a honlapon"
	exit 1
fi

cp "$ROOT_DIR$VERSION/$TARGET_DIR/$1" .

ftp -n $HOST >ftp.log <<EOF
quote USER $USER
quote PASS $PASSWD
passive

cd $TARGET_DIR
put $1

quit
EOF

#Az ideiglenesen a jelenlegi folderbe másolt file törlése
rm $1

exit 0



