url="https://web.njit.edu/~jmd57/model.php"

result=`curl --request POST $url --data "user_id=jmd57" --data "password=randompassword"`

if ! `echo $result | grep -q "200"`; then
	echo "Error at status 200"
	echo "Reply: $result"
	exit 1
fi	

result=`curl --request POST $url --data "user_id=jmd57" --data "password=notcorrect"`

if ! `echo $result | grep -q "304"`; then
	echo "Error at status 304"
	echo "Reply: $result"
	exit 1
fi

result=`curl --request POST $url --data "user_id=notcorrect" --data "pasword=same"`

if ! `echo $result | grep -q "404"`; then
	echo "Error at status 404"
	echo "Reply: $result"
	exit 1
fi

exit 0 

