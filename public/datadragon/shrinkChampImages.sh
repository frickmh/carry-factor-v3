#!/bin/bash
FILES=./$1/img/champion/*
for f in $FILES
do
  echo "Processing $f file..."
  #Zac.png
  # take action on each file. $f store current file name
  #cat $f
  echo $f
  champ=$(basename $f)
  echo $champ
  convert  -resize 25% $f ../images/champs/$champ

done





