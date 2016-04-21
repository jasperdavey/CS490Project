# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":7,"targetID":26,"initiatorID":5}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create friend request | $0"
    exit 1
fi

echo "${result}"
