<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<title>添加</title>
<style type="text/css">
body {
	margin: 0;
}
</style>
</head>
<body>
	<table width="100%" height="520" border="0" cellpadding="8"
		cellspacing="1" bgcolor="#000000">
		<tr>
			<td height="89" colspan="2" bgcolor="#FFFF99"><strong>后台管理系统</strong></td>
		</tr>
		<tr>
			<td width="156" height="287" align="left" valign="top"
				bgcolor="#FFFF99"><p>
					<a href="add.php">添加</a>
				</p>
				<p>
					<a href="manage.php">管理</a>
				</p></td>
			<td width="837" valign="top" bgcolor="#FFFFFF">
				<form enctype="multipart/form-data"
					action="addOperation.php?act=uploadfile" method="post">
					<table width="779" border="0" cellpadding="8" cellspacing="1">
						<tr>
							<td colspan="2" align="center">添加</td>
						</tr>
						<tr>
							<td width="150" align="left">编号</td>
							<td width="1125" align="left"><input type="text" name="id"
								id="id"
								value="<?php if(isset($_COOKIE['id']))echo $_COOKIE['id'];else echo null;?>"></td>
						</tr>
						<tr>
							<td width="150">标题</td>
							<td width="1125"><label for="title"></label> <input type="text"
								name="title" id="title"
								value="<?php if(isset($_COOKIE['title']))echo $_COOKIE['title'];else echo null;?>" /></td>
						</tr>
						<tr>
							<td width="150">类型</td>
							<td><label for="type">inside_our_factory</label> <input
								type="radio" name="type" id="type" value=1
								<?php if(isset($_COOKIE['type'])&&$_COOKIE['type']==1) echo 'checked="checked"'?> />
								<label for="type">float_glass</label> <input type="radio"
								name="type" id="type" value=2
								<?php if(isset($_COOKIE['type'])&&$_COOKIE['type']==2) echo 'checked="checked"'?> />
								<label for="type">laminded_glass</label> <input type="radio"
								name="type" id="type" value=3
								<?php if(isset($_COOKIE['type'])&&$_COOKIE['type']==3) echo 'checked="checked"'?> />
								<label for="type">figure_glass</label> <input type="radio"
								name="type" id="type" value=4
								<?php if(isset($_COOKIE['type'])&&$_COOKIE['type']==4) echo 'checked="checked"'?> />
							</td>
						</tr>
						<tr>
							<td width="150" align="left">内容</td>
							<td><textarea name="content" id="myEditor" cols="180" rows="40"><?php if(isset($_COOKIE['content']))echo $_COOKIE['content'];?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="right"><input type="submit" name="buttom"
								id="buttom" value="提交" /></td>
						</tr>
					</table>
					<input type="file" name="choosefile">
				</form>
			</td>
		</tr>
	</table>

</body>
</html>
<?php
session_start();
if (! isset($_SESSION['user']))
    header("location:login.php");
setcookie('id', '', time() - 1);
setcookie("title", '', time() - 1);
setcookie('type', '', time() - 1);
setcookie('content', '', time() - 1);
?>
