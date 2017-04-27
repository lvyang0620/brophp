<center><h2>修改项目信息</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/update" method="post">
		  <input type="hidden" name="id" value="<{$data.id}>">
	项目名称：<input type="text" name="name" value="<{$data.name}>"><br>
	<br>
	类别介绍：<textarea cols="40" rows="5" name="description"><{$data.description}></textarea><br>
	<br>
	父项目ID：<input type="text" name="pid" value="<{$data.pid}>"><br>
	<br>
	<input type="submit" value="修改">
</form>
