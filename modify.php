<?php
session_start();
if (! isset($_SESSION['user']))
    header("location:login.php");
require_once 'connect.php';
$id = $_GET['id'];
$query = mysql_query("select * from introduction where id=$id");
$data = mysql_fetch_assoc($query);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="default.css" rel="stylesheet" type="text/css" />
<title>修改</title>
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
				bgcolor="#FFFF99">
				<p>
					<a href="add.php">添加</a>
				</p>
				<p>
					<a href="manage.php">管理</a>
				</p>
			
			<td width="837" valign="top" bgcolor="FFFFFF">
				<form enctype="multipart/form-data"
					action="modifyOperation.php?act=uploadfile" method="post">
					<input type="hidden" name="id" value="<?php echo $data['id']?>" />
					<table width="779" border="0" cellpadding="8" cellspacing="1">
						<tr>
							<td colspan="2" align="center">修改</td>
						</tr>
						<tr>
							<td width="119">编号</td>
							<td width="625"><label for="id"></label> <input type="text"
								name="id" id="id" value="<?php echo $data['id'];?>" /></td>
						</tr>
						<tr>
							<td width="119">标题</td>
							<td width="1125"><label for="title"></label> <input type="text"
								name="title" id="title" value="<?php echo $data['title'];?>" /></td>
						</tr>
						<tr>
							<td width="150">类型</td>
							<td><label for="type">inside_our_factory</label> <input
								type="radio" name="type" id="type" value=1
								<?php if($data['type']==1) echo 'checked="checked"'?> /> <label
								for="type">float_glass</label> <input type="radio" name="type"
								id="type" value=2
								<?php if($data['type']==2) echo 'checked="checked"'?> /> <label
								for="type">laminded_glass</label> <input type="radio"
								name="type" id="type" value=3
								<?php if($data['type']==3) echo 'checked="checked"'?> /> <label
								for="type">figure_glass</label> <input type="radio" name="type"
								id="type" value=4
								<?php if($data['type']==4) echo 'checked="checked"'?> /></td>
						</tr>
						<tr>
							<td width="130" align="left">内容</td>
							<td><textarea name="content" id="myEditor" cols="180" rows="40"><?php echo $data['content'];?></textarea>
							</td>
						</tr>
						<td colspan="2" align="right"><input type="submit" name="buttom"
							id="buttom" value="提交" /></td>
					</table>
					<table>
						<tr>
							<td>当前文件:<?php echo substr($data['url'],6)?></td>
						</tr>


						<tr>
							<td><input type="file" name="choosefile"></td>
						</tr>

					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>

