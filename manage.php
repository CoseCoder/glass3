<?php
session_start();
if (! isset($_SESSION['user']))
    header("location:login.php");
require_once 'connect.php';
$sql = "select * from introduction order by id";
$query = mysql_query($sql);
if ($query && mysql_num_rows($query)) {
    while ($row = mysql_fetch_assoc($query)) {
        $data[] = $row;
        $sign = 1;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	margin: 0px;
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
			<td width="837" valign="top" bgcolor="#FFFFFF"><table width="743"
					border="0" cellpadding="8" cellspacing="1" bgcolor="#000000">
					<tr>
						<td colspan="3" align="center" bgcolor="#FFFFFF">管理列表</td>
					</tr>
					<tr>
						<td width="37" bgcolor="#FFFFFF">编号</td>
						<td width="82" bgcolor="#FFFFFF">操作</td>
					</tr>
	<?php
if (isset($sign)) {
    foreach ($data as $value) {
        ?>
      <tr>
						<td bgcolor="#FFFFFF">&nbsp;<?php echo $value['id']?></td>
						<td bgcolor="#FFFFFF"><a
							href="del.handle.php?id=<?php echo $value['id']?>">删除</a> <a
							href="modify.php?id=<?php echo $value['id']?>">修改</a></td>
					</tr>
        <?php
    }
}
?>
    </table></td>
		</tr>
	</table>
	<form method="post" action="addIDhandle.php">
		<table>
			<tr>
				<td>用户名</td>
				<td><input type="text" name="user" id="user"
					placeholder="3-16位大小写字母或数字"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="text" name="password" id="password"
					placeholder="6-16位大小写字母或数字" value=""></td>
			</tr>
			<tr>
				<td>确认密码</td>
				<td><input type="text" name="confirmpwd" id="confirmpwd" value=""></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加账号"></td>
			</tr>
		</table>
	</form>
</body>
</html>
