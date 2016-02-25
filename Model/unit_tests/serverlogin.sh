url="https://web.njit.edu/~jmd57/model.php"

result=`curl --request POST $url --data "user_id=jmd57" --data "password=randompassword"`

if [ `echo $result | grep "200"` ]; then
	echo "Error at status 304"
	exit 1
fi	

if [ `echo $result | grep "404"` ]; then
	echo "Error at status 404"
	exit 1
fi

result=`curl --request POST $url --data "user_id=jmd57" --data "password=notcorrect"`

if [ `echo $result | grep "200"` ]; then
	echo "Error at status 200"
	exit 1
fi

if [ `echo $result | grep "404"` ]; then
	echo "Error at status 404"
	exit 1
fi

result=`curl --request POST $url --data "user_id=notcorrect" --data "pasword=same"`

if [ `echo $result | grep "200"` ]; then
	echo "Error at status 200"
	exit 1
fi

if [ `echo $result | grep "304"` ]; then
	echo "Error at status 304"
	exit
fi

exit 0 

