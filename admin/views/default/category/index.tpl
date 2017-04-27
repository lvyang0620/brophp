<center><h2> 管理类别</h2></center>
<table width="100%" align="center" border="1">
	<tr>
		<th align="left">类别ID</th>
		<th align="left">类别名称</th>
		<th align="left">类别描述</th>
		<th align="left">父类别</th>
		<th align="left">损耗率</th>
		<th align="left">损耗级别</th>
		<th align="left">操作</th>
	</tr>

	<{section loop=$cats name="ls"}>	
		<tr>
			<td><{$cats[ls].id}></td>
			<td><a href="<{$app}>/matirial/index/cid/<{$cats[ls].id}>"><{$cats[ls].name}></a></td>
			<td><{$cats[ls].description}></td>
			<td><{$cats[ls].pid}></td>
			<td><{$cats[ls].lossrate}></td>
			<td><{$cats[ls].lossclass}></td>
			<td><a href="<{$url}>/mod/id/<{$cats[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除《<{$cats[ls].name}>》类别吗？')" href="<{$url}>/del/id/<{$cats[ls].id}>">删除</a></td>
		</tr>
	<{sectionelse}>
		<td colspan="7">没有任何类别</td>	
	<{/section}>
		<td></td>
		<td align="center"><a href="<{$url}>/add">添加类别</a></td>
                <td colspan="5" align="right"><{$fpage}></td>
</table>
