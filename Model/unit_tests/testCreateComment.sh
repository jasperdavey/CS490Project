# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":4,"owner":1,"event":1,"comment":"This event sucks!"}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not delete user | $0"
    exit 1
fi

echo "${result}"
