<center><h2>添加项目</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/insert" method="post">
	项目名称：<input type="text" name="name"><br>
	<br>
	项目介绍：<textarea cols="40" rows="5" name="description"></textarea><br>
	<br>
	父项目ID：<input type="text" name="pid"><br>
	<br>
	<input type="submit" value="添加项目">
</form>
