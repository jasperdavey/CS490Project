#!/bin/bash

#URL="https://web.njit.edu/~jmd57/backend.php
URL="https://web.njit.edu/~aml35/login/commandLine.php"

PARAMS=$1

response=`curl --request POST $URL --data $PARAMS`

echo $response
