<center><h2>添加物料</h2></center>
<p align="right"><a href="<{$url}>/index">返回</a></p>
<form action="<{$url}>/insert" method="post" enctype="multipart/form-data">
	<input type="hidden" name="max_file_size" value="5000000" />
	物料类别：
		  <select name="category_id">
			<option value="">---请选择---</option>
			<{section loop="$cat" name="ls"}>
				<option value="<{$cat[ls].id}>"><{$cat[ls].name}></option>
			<{/section}>
		  </select><br><br>
	物料编码：<input type="text" name="partcode"><br><br>
	物料描述：<input type="text" name="description"><br><br>
	物料型号：<input type="text" name="partname"><br><br>
	物料单价：<input type="text" name="price"><br><br>
	规格书&nbsp;：<input type="file" name="datasheet"><br><br>
	供应商&nbsp;：
		  <select name="supplier_id">
			<option value="">---请选择---</option>
			<{section loop="$sup" name="su"}>
				<option value="<{$sup[su].id}>"><{$sup[su].name}></option>
			<{/section}>
		  </select><br><br>

	<input type="submit" name="sub" value="添加物料">
</form>
