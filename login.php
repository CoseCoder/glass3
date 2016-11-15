<?php 
session_start();
unset($_SESSION['user']);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="login.js"></script>
</head>
<body>
<form method="post" action="loginhandle.php" onsubmit="return showHint()">
<table cellpadding="5">
<tr>
<td>用户名</td>
<td><input type="text" name="user" id="user" placeholder="3-16位大小写字母或数字"><div id="userHint"></div></td>
</tr>
<tr>
<td>密码</td>
<td><input type="text" name="password" id="password" placeholder="6-16位大小写字母或数字" value=""><div id="passwordHint"></div></td>
</tr>
<tr>
<td><input type="submit" value="登录"></td>
</tr>
</table>
</form>
</body>
</html>
