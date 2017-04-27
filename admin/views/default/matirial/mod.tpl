<center><h2>修改物料</h2></center>
<form action="<{$url}>/update" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
	产品类别：
		  <select name="category_id">
			<option value="">---请选择---</option>
			<{section loop="$cat" name="ls"}>
				<{if $data.category_id eq $cat[ls].id }>
					<option selected value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
				<{else}>
					<option value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
				<{/if}>
			<{/section}>
		  </select><br><br>
		  <input type="hidden" name="partcode" value="<{$data.partcode}>">
	物料描述：<input type="text" name="description" value="<{$data.description}>"><br><br>
	物料型号：<input type="text" name="partname" value="<{$data.partname}>"><br><br>
	物料单价：<input type="text" name="price" value="<{$data.price}>"><br><br>
	规格书：<input type="file" name="datasheet"><br><br>
		  <input type="hidden" name="dfile" value="<{$data.datasheet}>">
	供应商：
		  <select name="supplier_id">
			<option value="">---请选择---</option>
			<{section loop="$sup" name="ls"}>
				<{if $data.supplier_id eq $sup[ls].id }>
					<option selected value="<{$sup[ls].id}>"><{$sup[ls].name}></option>
				<{else}>
					<option value="<{$sup[ls].id}>"><{$sup[ls].name}></option>
				<{/if}>
			<{/section}>
		  </select><br><br>
	
	<input type="submit" name="sub" value="修改物料">
</form>
