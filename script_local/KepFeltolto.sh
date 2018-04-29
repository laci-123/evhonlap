#!/bin/sh

#Requires packages: ImageMagick, ncftp

HOST='ftp.lutheran.hu'
USER='budakeszi'
passwd=''
ROOT_DIR='/home/laci/Documents/evhonlap/'

#Get password
echo 'Password: '
read password 
if [ "$password" = '' ]
then 
    exit 1
fi

cd "$ROOT_DIR/img/galeria/$1"
mkdir -p Thubnails

echo "Fixing orientation of images..."
jhead -autorot *.*
jhead -norot *.*

echo "Uploading original images..."
ncftpput -u $USER -p $PASSWD -m $HOST "/img/galeria/$1" ./*

echo "Converting images..."
for PHOTO in *.*
do
	BASE=${PHOTO%.*}
	convert "$PHOTO" -resize x200 "Thubnails/$BASE.png"
done

echo "Uploading converted images..."
ncftpput -u "$USER" -p "$PASSWD" -m $HOST "/img/galeria/$1/Thubnails" ./Thubnails/*

rm -rf Thubnails
