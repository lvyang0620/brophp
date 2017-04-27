<center><h2> 管理分类</h2></center>
<table >
	<tr>
		<th align="left">类别ID</th>
		<th align="left">类别名称</th>
		<th align="left">操作</th>
	</tr>

	<{section loop=$cats name="ls"}>	
		<tr>
			<td><{$cats[ls].id}></td>
			<td><a href="<{$app}>/product/index/cid/<{$cats[ls].id}>"><{$cats[ls].name}></a></td>
			<td><a href="<{$url}>/mod/id/<{$cats[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除《<{$cats[ls].name}>》类别吗？')" href="<{$url}>/del/id/<{$cats[ls].id}>">删除</a></td>
		</tr>
	<{sectionelse}>
		<td colspan="3">没有分类</td>	
	<{/section}>

</table>
