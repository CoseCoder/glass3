/**
 * 
 */
function showHint()
{
	document.getElementById("userHint").innerHTML="";
	document.getElementById("passwordHint").innerHTML="";
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else 
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	//获取url
	var url="loginhandle.php";
	//回调函数，执行动作
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{ 			
			if(xmlhttp.responseText=="0")
				alert("用户不存在");
			else if(xmlhttp.responseText=="1")
				alert("密码错误");
			else if(xmlhttp.responseText=="2")
				window.location.href="manage.php";
			else{
//				将获取的信息插入到对应标签中
				var i=eval("("+xmlhttp.responseText+")");
				document.getElementById(i[0]).innerHTML=i[1];
			}
		} 
	}
	//open
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("user="+document.getElementById("user").value+"&password="+document.getElementById("password").value);
	return false;
}