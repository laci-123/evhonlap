#!/usr/bin/python3

import ftplib
from getpass import getpass
from argparse import ArgumentParser
from pathlib import Path
from PIL import Image

HOST = "ftp.lutheran.hu"
USER = "budakeszi"
LOCAL_ROOT = "/home/laci/Documents/evhonlap/img/galeria/"
REMOTE_ROOT = "/img/galeria/"
password = ""


def create_thumbnail(img_file):
    basewidth = 200
    img = Image.open(img_file.resolve())
    wpercent = (basewidth / float(img.size[0]))
    hsize = int((float(img.size[1]) * float(wpercent)))
    img = img.resize((basewidth, hsize), Image.ANTIALIAS)
    img.save(img_file.with_suffix(".png"), "png")

#cd into directory, create it if does not exsist
def cd_create(directory):
    if directory != "":
        try:
            session.cwd(directory)
        except ftplib.error_perm:
            cd_create("/".join(directory.split("/")[:-1]))
            session.mkd(directory)
            session.cwd(directory)

#****MAIN****#
parser = ArgumentParser(description="Uploads pictures to the server")
parser.add_argument("origin", 
                    metavar="origin", 
                    help="the directory from which the pictures will be uploaded, relative to ~/Documents/evhonlap/img/galeria/")
parser.add_argument("destination", 
                    metavar="destination", 
                    default="#",
                    nargs="?",
                    help="the directory on the server where the pictures will be uploaded, relative to /img/galeria/, by default same as 'origin'")
parser.add_argument("name", 
                    metavar="name", 
                    help="the name of the collection")
parser.add_argument("number", 
                    metavar="N", 
                    type=int, 
                    default=-1, 
                    nargs="?",
                    help="the number of the collection, for updating an older one; by default the next number")                    
args = parser.parse_args()

dest = args.destination
if dest == "#":
    dest = args.origin
                    
password = getpass()

try:
    session = ftplib.FTP(HOST, USER, password)
except ftplib.error_perm:
    print("password is incorrect (or access denied to the server for some other reason)")
    exit()

session.cwd(REMOTE_ROOT)

n_files = args.number
if n_files == -1:
    n_files = len(session.nlst()) - 1

with open(LOCAL_ROOT + args.origin + "/data.ini", 'wb') as ini_file:
    ini_file.write((str(n_files) + "\n" + args.name).encode('ascii', 'xmlcharrefreplace'))

print("uploading original images...")
cd_create(REMOTE_ROOT + dest)
for up_file in Path(LOCAL_ROOT + args.origin).glob("*.JPG"):
    with up_file.open("rb") as f:
        session.storbinary("STOR " + up_file.name, f)
    create_thumbnail(up_file)
    print("Done: " + up_file.name)

print("uploading metadata...")
with Path(LOCAL_ROOT + args.origin + "/data.ini").open("rb") as f:
    session.storbinary("STOR data.ini", f)

print("uploading converted images...")
cd_create(REMOTE_ROOT + dest + "/Thubnails")
for up_file in Path(LOCAL_ROOT + args.origin).glob("*.png"):
    with up_file.open("rb") as f:
        session.storbinary("STOR " + up_file.name, f)
    print("Done: " + up_file.name)
    up_file.unlink()
        
session.quit()
