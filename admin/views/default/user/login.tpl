<table align="center" border="1" width="300">
<form action="<{$url}>/islogin" method="post">
	<caption><h1>用户登录</h1></caption>	
	<tr>
		<th>用户名：</th> <td><input type="text" name="username"></td>
	</tr>
	<tr>
		<th>密&nbsp;&nbsp;&nbsp;&nbsp;码：</th> <td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" name="sub" value="登录">
			<a href="<{$url}>/reg">注册</a>
		</td>
	</tr>
</form>
</table>
