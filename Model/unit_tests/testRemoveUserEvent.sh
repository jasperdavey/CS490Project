# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":20,"id":1,"event":1}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not remove user event | $0"
    echo "${result}"
    exit 1
fi
