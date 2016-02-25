#!/bin/bash
set -x
read -p "Enter username: " username
read -s -p "Enter password: " password

url="https://web.njit.edu/~jmd57/addusers.php"
result=`curl --request POST $url --data "user_id=$username" --data "password=$password"`
echo $result
