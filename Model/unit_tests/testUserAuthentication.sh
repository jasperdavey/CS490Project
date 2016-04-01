# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":2,"email":"jasperd92","password":"randompassword"}'`
echo "${result}"
