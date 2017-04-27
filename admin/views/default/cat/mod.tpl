<center><h2>修改分类</h2></center>
<form action="<{$url}>/update" method="post">
		  <input type="hidden" name="id" value="<{$data.id}>">
	类别名称：<input type="text" name="name" value="<{$data.name}>"><br>
	<br>
	类别介绍：<textarea cols="40" rows="5" name="desn"><{$data.desn}></textarea><br>
	<br>
	<input type="submit" value="修改">
</form>
