# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":3,"name":"ACM","bio":"Event for CS students","dateAndTime":"12:00:00PM 4-30-2016","location":"GITC 2000","tags":{"#CS":2,"#ComputerScience":5,"#NJIT":7}}'`
echo "${result}"

result=`curl --request POST $url --data 'json={"command":3,"name":"ACM","bio":"Event for CS students","dateAndTime":"12:00:00PM 4-30-2016","location":"GITC 2000","tags":{"#Electrical":2,"#Engineering":5,"#NJIT":7}}'`
echo "${result}"
