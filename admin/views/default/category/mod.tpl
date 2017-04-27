<center><h2>修改分类</h2></center>
<form action="<{$url}>/update" method="post">
		  <input type="hidden" name="id" value="<{$data.id}>">
	类别名称：<input type="text" name="name" value="<{$data.name}>"><br>
	<br>
	类别介绍：<textarea cols="40" rows="5" name="description"><{$data.description}></textarea><br>
	<br>
	父类ID：<input type="text" name="pid" value="<{$data.pid}>"><br>
	<br>
	损耗率：<input type="text" name="lossrate" value="<{$data.lossrate}>"><br>
	<br>
	损耗级别：<input type="text" name="lossclass" value="<{$data.lossclass}>"><br>
	<br>
	<input type="submit" value="修改">
</form>
