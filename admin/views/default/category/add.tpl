<center><h2>添加类别</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/insert" method="post">
	类&nbsp;&nbsp;别&nbsp;&nbsp;ID：<input type="text" name="id"><br>
	<br>
	类别名称：<input type="text" name="name"><br>
	<br>
	类别介绍：<textarea cols="40" rows="5" name="description"></textarea><br>
	<br>
	父&nbsp;&nbsp;类&nbsp;&nbsp;ID：<input type="text" name="pid"><br>
	<br>
	损&nbsp;&nbsp;耗&nbsp;&nbsp;率：<input type="text" name="lossrate"><br>
	<br>
	损耗级别：<input type="text" name="lossclass"><br><br>
	<input type="submit" value="添加类别">
</form>
