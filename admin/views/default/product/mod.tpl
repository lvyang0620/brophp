<center><h2>修改商品</h2></center>
<form action="<{$url}>/update" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	产品类别：
		  <select name="cid">
			<option value="">---请选择---</option>
			<{section loop="$cat" name="ls"}>
				<{if $data.cid eq $cat[ls].id }>
					<option selected value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
				<{else}>
					<option value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
				<{/if}>
			<{/section}>
		  </select><br><br>
		  <input type="hidden" name="id" value="<{$data.id}>">
	产品名称：<input type="text" name="name" value="<{$data.name}>"><br><br>
	产品数量：<input type="text" name="num" value="<{$data.num}>"><br><br>
	产品价格：<input type="text" name="price" value="<{$data.price}>"><br><br>
	产品图片：<input type="file" name="picture"><br><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <img width="150" src="<{$public}>/uploads/<{$data.pic}>"><br><br><br>
		  <input type="hidden" name="dpic" value="<{$data.pic}>">
	产品介绍：<textarea rows="6" cols="40" name="desn"><{$data.desn}></textarea><br><br>

	<input type="submit" name="sub" value="修改商品">
</form>
