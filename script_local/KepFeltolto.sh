#!/bin/sh

#Requires packages: ImageMagick, ncftp

HOST='ftp.lutheran.hu'
USER='budakeszi'
PASSWD='sW73943kD'
ROOT_DIR='/home/laci/Documents/Html/Ev_honlap/'
VERSION=v14

cd "$ROOT_DIR/$VERSION/img/galeria/$1"
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
