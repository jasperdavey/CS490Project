# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":6,"owner":1,"tag":"#CS"}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create tag | $0"
    echo "${result}"
    exit 1
fi

result=`curl --request POST $url --data 'json={"command":6,"owner":1,"tag":"#Software"}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create tag | $0"
    exit 1
fi
