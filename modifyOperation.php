﻿<?php

function alertMes($mes)
{
    if ($mes != 1)
        echo "<script type='text/javascript'>alert('{$mes}');window.location.href='manage.php';</script>";
}

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
    $title = $_POST['title'];
    $type = $_POST['type'];
    $content = $_POST['content'];
    
    // 把传递过来的信息入库,在入库之前对所有信息进行校验
    if (empty($id)) {
        echo "<script>alert('编号不能为空');window.location.href='modify.php';</script>";
        exit();
    }
    if (empty($type)) {
        echo "<script>alert('类型不能为空');window.location.href='modify.php';</script>";
        exit();
    }
    if ($type != "insideimg" && $type != "packing") {
        if ($type != "insidecontent") {
            if (empty($title)) {
                echo "<script>alert('标题不能为空');window.location.href='modify.php';</script>";
                exit();
            }
        }
        if (empty($content)) {
            echo "<script>alert('内容不能为空');window.location.href='modify.php';</script>";
            exit();
        }
    }
    
    $fileInfo = $_FILES['choosefile'];
    if ($type == "insidecontent") {
        $title = null;
        $path = null;
    } else 
        if ($type == "insideimg" || $type == "packing") {
            $title = null;
            $content = null;
        }
    if ($fileInfo['error'] != 4) {
        $mes = uploadfile($fileInfo);
        alertMes($mes); // 自定义的提示操作
        $path = "./img/" . $fileInfo["name"];
    }
    $updatesql = "update introduction set id='$id',url='$path',title='$title',content='$content',type='$type' where id=$id";
    if (mysql_query($updatesql)) {
        echo "<script>alert('修改成功');window.location.href='manage.php';</script>";
        setcookie('id', '', time() - 1);
    } else {
        echo "<script>alert('修改失败');window.location.href='modify.php';</script>";
    }
}
?>