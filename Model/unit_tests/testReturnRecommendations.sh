# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":8,"id":1}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not get all users | $0"
    echo "${result}"
    exit 1
fi
echo "${result}"