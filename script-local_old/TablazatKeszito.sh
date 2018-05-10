#!/bin/bash

#Átalakít szöveget HTML táblázattá 
##sor: új sor
##cella: ;
##Ha az első cellában a dátum van mm.dd formában, a § jel helyére beírja a nap nevét (hétfő..vasárnap)

cat tablazat.txt | awk -f TablazatKeszito.awk > tablazat.html
