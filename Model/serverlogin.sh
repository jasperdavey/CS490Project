url="https://web.njit.edu/~jmd57/model.php"

result=`curl --request POST $url --data "user_id=jmd57" --data "password=randompassword"`

if ( echo $result | grep "202" ); then
	echo "Error at status 202"
	exit 1
fi	


