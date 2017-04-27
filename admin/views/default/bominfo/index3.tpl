<table align="center" width="100%" border="1">
<caption><h2><{$cname}>&nbsp;项目BOM列表</h2></caption>
	<tr>
		<th>&nbsp;</th>
		<th>BOM编号</th>
		<th>BOM名称</th>
		<th>BOM描述</th>
		<th>项目名称</th>
		<th>PCB类型</th>
		<th>PCB版本</th>
		<th>客户名称</th>
		<th>客户项目</th>
		<th>创建时间</th>
		<th>最后修改时间</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del/cid/<{$cid}>" method="post" onsubmit="return confirm('确定要删除这些BOM吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><input type="checkbox" name="id[]" value="<{$data[ls].bomcode}>"></td>
		<td><a href="<{$app}>/detailpart/index/bomcode/<{$data[ls].bomcode}>"><{$data[ls].bomcode}></a></td>
		<td><a href="<{$app}>/detailpart/index/bomcode/<{$data[ls].bomcode}>"><{$data[ls].bomname}></a></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].projectname}></td>
		<td><{$data[ls].pcbtype}></td>
		<td><{$data[ls].pcbversion}></td>
		<td><{$data[ls].customname}></td>
		<td><{$data[ls].customproject}></td>
		<td><{$data[ls].ctime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><{$data[ls].lastmodtime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><a href="<{$url}>/mod/bomcode/<{$data[ls].bomcode}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].bomcode}>吗？')" href="<{$url}>/del/bomcode/<{$data[ls].bomcode}>/projectname/<{$data[ls].projectname}>">删除</a>/<a href="<{$app}>/detailpart/index/bomcode/<{$data[ls].bomcode}>">明细</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="10">没有BOM</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="2"><label for="del"><input id="del" onclick="sel(this.checked)" type="checkbox">全选</label>&nbsp;&nbsp;
					<input type="submit" value="全部删除">
			</td>
			<td align="center" ><a href="<{$url}>/add">添加新BOM</a></td>
			<td colspan="4" align="right"><{$fpage}></td>
			<td align="right">选择项目</td>
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
