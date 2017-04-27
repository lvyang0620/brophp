<center><h2>添加商品</h2></center>
<form action="<{$url}>/insert" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	产品类别：
		  <select name="cid">
			<option value="">---请选择---</option>
			<{section loop="$cat" name="ls"}>
				<option value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
			<{/section}>
		  </select><br><br>
	产品名称：<input type="text" name="name"><br><br>
	产品数量：<input type="text" name="num"><br><br>
	产品价格：<input type="text" name="price"><br><br>
	产品图片：<input type="file" name="picture"><br><br>
	产品介绍：<textarea rows="6" cols="40" name="desn"></textarea><br><br>

	<input type="submit" name="sub" value="添加商品">
</form>
