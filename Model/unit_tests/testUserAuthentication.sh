# Author: Jasper Davey
# This test authenticates a user
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":2,"email":"jmd57@njit.edu","password":"randompassword"}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not authenticate user | $0"
    exit 1
fi
