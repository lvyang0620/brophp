<center><h2>添加客户信息</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/insert" method="post">
	客户名称：<input type="text" name="name"><br>
	<br>
	客户简称：<input type="text" name="shortname">(请输入1-4位字母或数字)<br>
	<br>
	联络人名：<input type="text" name="contacts"><br>
	<br>
	电&nbsp;&nbsp;话：<input type="text" name="phonenum"><br>
	<br>
	地&nbsp;&nbsp;址：<textarea cols="40" rows="5" name="address"></textarea><br>
	<br>
	<input type="submit" name="sub" value="添加客户">
</form>
