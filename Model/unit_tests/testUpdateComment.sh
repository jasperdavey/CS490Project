# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":39,"id":1,"comment":"Sike nah, it's lit"}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not delete user | $0"
    exit 1
fi

echo "${result}"
