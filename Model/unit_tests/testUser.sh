# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":1,"email":"jmd57@njit.edu","password":"randompassword","username":"jaspy123","firstname":"Jasper","lastname":"Davey","bio":"I like CS","events":["ACM","IEEE","NJIT Robotics Club","AlcHE"],"tags":{"#CS":2,"#ComputerScience":5,"#NJIT":7}}'`
echo "${result}"

result=`curl --request POST $url --data 'json={"command":1,"email":"test@njit.edu","password":"test","username":"Bobby","firstname":"Bob","lastname":"Saget","bio":"I hate CS","events":["WeHateCS","AA"],"tags":{"#Biology":2,"#NJIT":3,"Bio":1}}'`

echo "${result}"
