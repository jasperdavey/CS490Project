<!DOCTYPE html>
<html>
<body style="background-color:white">
<head><title>CS490 Project</title></head>

<div id="header" style="width:100%;height:120px;background-color:red;font-size:36pt;">NJIT</div>

<div id="login-box">
    <form id="loginForm" action="https://web.njit.edu/~aml35/login/login.php">
        login id:<br>
        <input type="text" login="userId"><br>
        password:<br>
        <input type="password" login="password"><br>
        <input type="button" onclick="sendInfo()" value="Submit">
    </form>

<script>
    function sendInfo(){
        document.getElementById("loginForm").submit();
    }
</script>

</div>
</body>
</html>
