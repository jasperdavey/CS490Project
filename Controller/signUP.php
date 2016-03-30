<?php 
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: SignUp.php			*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

//Getting user's info...

$cmd = $info['cmd'];
$fname = $info['f_name'];
$lname = $info['l_name'];
//$midname = $info['m_name'];
$Gname = $info['g_name'];
$user_id = $info['user_id'];
$pass = $info['pass'];

$email = $info['email'];
$major = $info['major'];
$minor = $info['minor'];
$year = $info['level'];
$Gdate = $info['grad_date'];

//Putting all info together to send to Jasper

$data = "firstname=$fname&
		 lastname=$lname&
		 user_id=$user_id&
		 password=$pass&
		 email=$email&
		 major=$major&
		 minor=$minor&
		 year=$year&
		 Gdate=$Gdate";
echo $data;
/*
//$J_url = "https://web.njit.edu/~jmd57/.......";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$results = curl_exec($ch);
curl_close($ch);

echo "$results";

*/

?>
