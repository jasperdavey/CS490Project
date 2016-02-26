<?php
/* author: Totaram Ramrattan
  CS490-104-Semester Project
  2/25/16
*/

require_once ('form_login.php');

// start html
echo '

<!DOCTYPE html>
<html>
<body style="background-color:white">
<head><title>CS490 Project</title></head>

<div id="header" style="width:100%;height:120px;background-color:red;font-size:36pt;">NJIT CS490-104 Project</div>
</br>
<div id="login-box">
    <form method="POST" action="">
        login id:<br>
        <input type="text" login="user-id" name="ucid"></br>
        password:<br>
        <input type="password" login="password" name="pass"></br>
        </br>
        <button>Sign In</button>
    </form>
</div>
</body>
</html>
';
// end html

// executes once corret fields are set
if(isset($_POST['ucid']) && isset($_POST['pass'])){
    echo login();
    return;
}

?>
