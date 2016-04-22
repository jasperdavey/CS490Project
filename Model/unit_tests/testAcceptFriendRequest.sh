# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":15,"targetID":5,"initiatorID":9}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not accept friend request | $0"
    exit 1
fi

echo "${result}"
