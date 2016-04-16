#!/bin/bash
file=1
nap=.0005

while [ true ]
  do
    NOW=`stat -c %z ${1}`
    if [ "$NOW" != "$THEN" ];then
      printf "`cat ${1}`"
    fi
    THEN="$NOW"
    sleep $nap
  done
