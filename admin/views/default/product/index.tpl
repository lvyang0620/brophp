<table align="center" width="100%" border="1">
<caption><h2><{$cname}>&nbsp;&nbsp;的所有商品</h2></caption>
	<tr>
		<th>&nbsp;</th>
		<th>产品ID</th>
		<th>产品名称</th>
		<th>产品数量</th>
		<th>产品价格</th>
		<th>上架时间</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del/cid/<{$cid}>" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><input type="checkbox" name="id[]" value="<{$data[ls].id}>"></td>
		<td><{$data[ls].id}></td>
		<td><{$data[ls].name}></td>
		<td><{$data[ls].num}></td>
		<td><{$data[ls].price}></td>
		<td><{$data[ls].ptime|date_format:"%Y-%m-%d"}></td>
		<td><a href="<{$url}>/mod/id/<{$data[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].name}>吗？')" href="<{$url}>/del/id/<{$data[ls].id}>/cid/<{$data[ls].cid}>">删除</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="7">这个类别中没有产品</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="2"><label for="del"><input id="del" onclick="sel(this.checked)" type="checkbox">全选</label>&nbsp;&nbsp;
					<input type="submit" value="删除">
			</td>

			<td colspan="5" align="right"><{$fpage}></td>
		</tr>

	</form>
	<script>
		var dels=document.getElementsByName("id[]");
		function sel(value){
			for(var i=0;i<dels.length;i++){
				dels[i].checked=value;
			}
		}
	</script>

</table>
