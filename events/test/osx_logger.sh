#!/bin/bash
file=1
wait=.005

while [ true ]
  do
    NOW=`stat -f %t%Sm ${1}`
    if [ "$NOW" != "$THEN" ];then
      sleep .5
      printf "`cat ${1}`"
    fi
    THEN="$NOW"
    sleep wait;
  done
