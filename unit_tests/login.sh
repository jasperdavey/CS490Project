url="https://web.njit.edu/~tr88/CS490Project/View/index.php"

result=`curl --request POST $url --data "ucid=jmd57" --data "pass=randompassword"`

if ! `echo $result | grep -q "successfully"`; then
	echo "Error authenticating user at database"
	exit 1
fi

result=`curl --request POST $url --data "ucid=jmd57" --data "pass=random"`

if `echo $result | grep -q "succesfully"`; then
	echo "Error authenticating user at either NJIT or database when password incorrect"
	exit 1
fi

exit 0
