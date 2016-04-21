# Author: Jasper Davey
# This test creates two users
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":1,"email":"jmd57@njit.edu","password":"randompassword","username":"jaspy123","firstname":"Jasper","lastname":"Davey","bio":"I like CS","events":{},"tags":{}}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create user | $0"
    echo "${result}"
    exit 1
fi

result=`curl --request POST $url --data 'json={"command":1,"email":"test@njit.edu","password":"test","username":"Bobby","firstname":"Bob","lastname":"Saget","bio":"I hate CS","events":{},"tags":{}}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create user | $0"
    exit 1
fi
