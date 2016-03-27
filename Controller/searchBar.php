<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: searchBar.php	        *
By:       Angelica Llerena		  *
Date:     March 15, 2016.		    *
*********************************/

$search = _POST['search']; // general searching

//OPTIONAL - May be implemented for final presentation.
//Searching by... (e.g: Location, Date, Time, tags).

//Jasper will search for events where the "search" appears

$data = "search=$search";

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

?>
