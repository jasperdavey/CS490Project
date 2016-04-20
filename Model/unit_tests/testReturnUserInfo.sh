# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":9,"id":1}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not get user info | $0"
    exit 1
fi
echo "${result}"
