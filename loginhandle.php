<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['user']=="") {
        echo json_encode(array("userHint","用户名不可为空"));
        exit();
    } else 
        if (!preg_match("/^[0-9A-Za-z]{3,16}$/", $_POST['user'])) {
            echo json_encode(array(
                "userHint",
                "用户名格式错误！"
            ));
            exit();
        } else 
            if ($_POST['password'] == "") {
                echo json_encode(array(
                    "passwordHint",
                    "密码不可为空！"
                ));
                exit();
            } else 
                if (!preg_match("/^[0-9A-Za-z]{6,16}$/", $_POST['password'])) {
                    echo json_encode(array(
                        "passwordHint",
                        "密码格式错误！"
                    ));
                    exit();
                }
}

require_once ('connect.php');
header("Content-Type: text/html;charset=utf-8");
$user = $_POST['user'];
$sql = "select * from admin where username='$user'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
if (! mysql_num_rows($result)) {
    echo "0";
    exit();
} else 
    if ($_POST['password'] != $row[1]) {
        echo "1";
        exit();
    } else {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        echo "2";
        exit();
    }