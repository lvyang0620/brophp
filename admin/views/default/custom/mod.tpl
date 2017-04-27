<center><h2>修改客户信息</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/update" method="post">
		<input type="hidden" name="id" value="<{$data.id}>">
	客户名称：<input type="text" name="name" value="<{$data.name}>"><br>
	<br>
	客户简称：<input type="text" name="shortname" value="<{$data.shortname}>">(请输入1-4位字母或数字)<br>
	<br>
	联络人名：<input type="text" name="contacts" value="<{$data.contacts}>"><br>
	<br>
	电&nbsp;&nbsp;话：<input type="text" name="phonenum" value="<{$data.phonenum}>"><br>
	<br>
	地&nbsp;&nbsp;址：<textarea cols="40" rows="5" name="address"><{$data.address}></textarea><br>
	<br>
	<input type="submit" value="修改客户信息">
</form>
