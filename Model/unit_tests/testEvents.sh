# Author: Jasper Davey
url="https://web.njit.edu/~jmd57/backend.php"

result=`curl --request POST $url --data 'json={"command":3,"name":"ACM","bio":"Event for CS students","startDateTime":"2016-04-30 12:00:00","endDateTime":"2016-04-30 13:00:00","location":"GITC 2000","tags":{"#CS":2,"#ComputerScience":5,"#NJIT":7},"owner":1}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create event | $0"
    echo "${result}"
    exit 1
fi

result=`curl --request POST $url --data 'json={"command":3,"name":"IEEE","bio":"Event for EE students","startDateTime":"2016-05-02 15:00:00","endDateTime":"2016-05-02 16:30:00","location":"GITC 3000","tags":{"#Electrical":2,"#Engineering":5,"#NJIT":7},"owner":2}'`
if ! `echo "${result}" | grep -q "200"`; then
    echo "ERROR: could not create event | $0"
    echo "${result}"
    exit 1
fi
