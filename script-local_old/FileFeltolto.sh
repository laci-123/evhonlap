#!/bin/sh

HOST='ftp.lutheran.hu'
USER='budakeszi'
password=''
ROOT_DIR='/home/laci/Documents/evhonlap/'

#Jelszó bekérése: 
echo 'Password: '
read password 
if [ "$password" = '' ]
then 
    exit 1
fi
    

#Ellenőrzi, melyik folderbe/-ből kell a filet feltölteni
#Olyan filet nem enged feltöletni, ami nem található meg a honlapon
if [ -e "$ROOT_DIR/content/$1" ] 
then
	TARGET_DIR=content
elif [ -e "$ROOT_DIR/script/$1" ]
then
	TARGET_DIR=script
elif [ -e "$ROOT_DIR/$1" ]
then
	TARGET_DIR=.
else
	echo "Ilyen file nincs a honlapon"
	exit 1
fi

cp "$ROOT_DIR$VERSION/$TARGET_DIR/$1" .

ftp -n $HOST >ftp.log <<EOF
quote USER $USER
quote PASS $password
passive

cd $TARGET_DIR
put $1

quit
EOF

#Az ideiglenesen a jelenlegi folderbe másolt file törlése
rm $1

exit 0



