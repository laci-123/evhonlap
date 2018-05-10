#!/usr/bin/python3

#Uploads files to the server. Default files: index.php, files in 'content' and 'script'

import ftplib
from getpass import getpass
from argparse import ArgumentParser
from pathlib import Path

HOST = "ftp.lutheran.hu"
USER = "budakeszi"
LOCAL_ROOT = "/home/laci/Documents/evhonlap/"
password = ""
up_file = None

def get_file(f):
    if f == "index.php" and Path(LOCAL_ROOT + "index.php").is_file():
        return Path(LOCAL_ROOT + "index.php")
    elif Path(LOCAL_ROOT + "content/" + f).is_file():
        return Path(LOCAL_ROOT + "content/" + f)
    elif Path(LOCAL_ROOT + "script/" + f).is_file():
        return Path(LOCAL_ROOT + "script/" + f)
    else:
        raise FileNotFoundError("The file does not exist in the default locations. Try using -a if you want to upload from any location.")
        
def get_any_file(f):
    if Path(LOCAL_ROOT + f).is_file():
        return Path(LOCAL_ROOT + f)
    elif Path(f).is_file():
        return Path(f)
    else:
        raise FileNotFoundError("File does not exist.")

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
parser = ArgumentParser(description="Uploads files to the server. Default files: index.php, files in 'content' and 'script'")
parser.add_argument("filename", 
                    metavar="filename", 
                    help="the file to be uploaded, full path only needed if -a is set")
parser.add_argument("-a", 
                    dest="any_file", 
                    action="store_true", 
                    default=False, 
                    help="allows to upload any file, not just the default ones")
parser.add_argument("destination", 
                    metavar="dest", 
                    default="/",
                    nargs="?",
                    help="the target directory on the server if -a is set (default is '/')")
args = parser.parse_args()

try:
    if args.any_file:
        up_file = get_any_file(args.filename)
    else:
        up_file = get_file(args.filename)
except FileNotFoundError as err:
    print(err.args[0])
    exit()

password = getpass()

try:
    session = ftplib.FTP(HOST, USER, password)
except ftplib.error_perm:
    print("password is incorrect (or access denied to the server for some other reason)")
    exit()
with up_file.open("rb") as f:
    if args.any_file:
        cd_create(args.destination)
    else:
        session.cwd(up_file.relative_to(LOCAL_ROOT).parent)
    session.storbinary("STOR " + up_file.name, f)

session.quit()
