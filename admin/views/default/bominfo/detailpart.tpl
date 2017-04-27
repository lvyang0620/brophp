<table align="center" width="100%" border="1">
<caption><h2><{$cname}>&nbsp;类所有物料</h2></caption>
	<tr>
		<th>&nbsp;</th>
		<th>物料编码</th>
		<th>物料名称</th>
		<th>物料描述</th>
		<th>单价</th>
		<th>损耗率</th>
		<th>规格书</th>
		<th>类别名称</th>
		<th>供应商</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del/cid/<{$cid}>" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><input type="checkbox" name="id[]" value="<{$data[ls].partcode}>"></td>
		<td><{$data[ls].partcode}></td>
		<td><{$data[ls].partname}></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].price}></td>
		<td><{$data[ls].lossrate}></td>
		<td><{$data[ls].datasheet}></td>
		<td><{$data[ls].category_name}></td>
		<td><{$data[ls].supplier_name}></td>
		<td><a href="<{$url}>/mod/partcode/<{$data[ls].partcode}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].partname}>吗？')" href="<{$url}>/del/partcode/<{$data[ls].partcode}>/cid/<{$data[ls].category_id}>">删除</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="9">这个类别中没有物料</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="2"><label for="del"><input id="del" onclick="sel(this.checked)" type="checkbox">全选</label>&nbsp;&nbsp;
					<input type="submit" value="删除">
			</td>

			<td colspan="4" align="right"><{$fpage}></td>
			<td align="right">选择类别</td>
			<td colspan="3">
				<select name="category_id" onchange="window.location.href=this.options[selectedIndex].value" >
                        				<option value="<{$url}>/index/cid/0">全部</option>
                        		<{section loop="$cat" name="ls"}>
                                		<{if $cid eq $cat[ls].id }>
                                        		<option selected value="<{$url}>/index/cid/<{$cat[ls].id}>"><{$cat[ls].name}></option>
                                		<{else}>
                                        		<option value="<{$url}>/index/cid/<{$cat[ls].id}>"><{$cat[ls].name}></option>
                                		<{/if}>
                        		<{/section}>
                  		</select>

			</td>
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
