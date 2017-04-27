<table align="center" width="100%" border="1">
<p align="right"><a href="<{$app}>/bominfo/index">返回</a></p>
<caption><h2><{$bomname}>&nbsp;BOM的所有物料</h2><h3>总成本为：<{$sum}> USD</h3></caption>
	<tr>
		<th>&nbsp;</th>
		<th>物料编码</th>
		<th>替代物料</th>
		<th>物料描述</th>
		<th>物料型号</th>
		<th>供应商</th>
		<th>用量</th>
		<th>位号</th>
		<th>单价</th>
		<th>损耗率</th>
		<th>是否参与核算</th>
		<th>成本</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><input type="checkbox" name="id[]" value="<{$data[ls].partcode}>"></td>
		<td><{$data[ls].partcode}></td>
		<td><{$data[ls].substitute}></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].partname}></td>
		<td><{$data[ls].supplier_name}></td>
		<td><{$data[ls].num}></td>
		<td><{$data[ls].refs}></td>
		<td><{$data[ls].price}></td>
		<td><{$data[ls].lossrate}></td>
		<td align="center"><input type="checkbox" name="accounting[]" checked="<{$data[ls].accounting}>"></td>
		<td><{$data[ls].cost}></td>
		<td><a href="<{$url}>/mod/bomcode/<{$bomcode}>/partcode/<{$data[ls].partcode}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].partname}>吗？')" href="<{$url}>/del/bomcode/<{$bomcode}>/partcode/<{$data[ls].partcode}>">删除</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="9">这个类别中没有物料</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="3"><label for="del"><input id="del" onclick="sel(this.checked)" type="checkbox">全选</label>&nbsp;&nbsp;
					<input type="submit" value="全部删除">
			</td>

			<td colspan="2" align="center"><a href="<{$url}>/add/bomcode/<{$bomcode}>"><b>添加物料</b></a></td>
			<td colspan="1" align="center"><a href="<{$url}>/import"><b>导入</b></a></td>
			<td colspan="1" align="center"><a href="<{$url}>/export"><b>导出</b></a></td>
	
			<td colspan="6" align="right"><{$fpage}></td>
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
