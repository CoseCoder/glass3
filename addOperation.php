<?php


function uploadFile($fileInfo)
{
    if ($fileInfo['error'] == UPLOAD_ERR_OK) {
        if (preg_match('/\.jpg|\.png|\.bmp|\.jpeg$/is', $fileInfo["name"])) {
            move_uploaded_file($fileInfo["tmp_name"], "./img/" . $fileInfo["name"]);
            $mes = 1;
        } else {
            $mes = "不支持的文件格式，请使用jpg,jpeg,png,bmp格式的图片";
        }
    } else {
        $mes = "上传失败，文件不是通过HTTP POST方式上传";
    }
    return $mes;
}

session_start();
if (! isset($_SESSION['user']))
    header("location:login.php");

header("Content-type: text/html; charset=utf-8");

$act = $_REQUEST['act']; // 获取操作种类
if ($act == "uploadfile") {
    
    require_once 'connect.php';
    $id = $_POST['id'];
    $title=$_POST['title'];
    $type=$_POST['type'];
    $content = $_POST['content'];
    
    // 把传递过来的信息入库,在入库之前对所有信息进行校验
    if (empty($id)) {
        echo "<script>alert('编号不能为空');window.location.href='add.php';</script>";
        exit();
    }
    if (empty($title)) {
        setcookie('id', $id);
        echo "<script>alert('标题不能为空');window.location.href='add.php';</script>";
        exit();
    }
    if (empty($type)) {
        setcookie('id', $id);
        setcookie('title', $title);
        echo "<script>alert('类型不能为空');window.location.href='add.php';</script>";
        exit();
    }
    if (empty($content)) {
        setcookie('id', $id);
        setcookie('title', $title);
        setcookie('type', $type);
        echo "<script>alert('内容不能为空');window.location.href='add.php';</script>";
        exit();
    }
    
    $fileInfo = $_FILES['choosefile'];
    $mes = uploadfile($fileInfo);
    
    function alertMes($mes,$id,$title,$type,$content)
    {
        if ($mes != 1){
            setcookie('id', $id);
            setcookie('title', $title);
            setcookie('type', $type);
            setcookie('content', $content);
            echo "<script type='text/javascript'>alert('{$mes}');window.location.href='add.php';</script>";
            exit();
        }
    }
    
    alertMes($mes,$id,$title,$type,$content); // 自定义的提示操作
    $path = "./img/" . $fileInfo["name"];
    
    $insertsql = "insert introduction values('$id','$path','$title','$content','$type')";
    if (mysql_query($insertsql)) {
        echo "<script>alert('添加成功');window.location.href='manage.php';</script>";
    } else {
        setcookie('id', $id);
        setcookie('title', $title);
        setcookie('type', $type);
        setcookie('content', $content);
        echo "<script>alert('添加失败(编号已存在或其他原因)');window.location.href='add.php';</script>";
    }
}
?>