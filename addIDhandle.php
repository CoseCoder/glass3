<?php
header("Content-Type:text/html;charset=UTF-8");
session_start();
if (! isset($_SESSION['user']))
    header("location:login.php");
$user = $_POST['user'];
$pwd = $_POST['password'];
if(!preg_match("/^[0-9A-Za-z]{3,16}$/",$user)){
    echo "<script>alert('用户名格式错误');window.location.href='manage.php'</script>";
    exit();
}
   if(!preg_match("/^[0-9A-Za-z]{6,16}$/", $pwd)){
       echo "<script>alert('密码格式错误');window.location.href='manage.php'</script>";
       exit();
   }
   if($pwd!=$_POST['confirmpwd']){
       echo "<script>alert('确认密码与密码不一致');window.location.href='manage.php'</script>";
       exit();
   }
require_once ('connect.php');
$sql = "select username from admin where username='$user'";
$result=mysql_query($sql);
if (mysql_num_rows($result)) {
    echo "<script>alert('用户名已存在');window.location.href='manage.php'</script>";
    exit();
}
$sql = "insert admin values('$user','$pwd')";
if (mysql_query($sql))
    echo "<script>alert('添加成功');window.location.href='manage.php'</script>";
else
    echo "<script>alert('添加失败');window.location.href='manage.php'</script>";