<center><h2> 管理项目信息</h2></center>
<table width="100%" align="center" border="1">
	<tr>
		<th align="center">项目 ID</th>
		<th align="center">项目名称</th>
		<th align="center">项目描述</th>
		<th align="center">父项目ID</th>
		<th align="center">操作</th>
	</tr>

	<{section loop=$proj name="ls"}>	
		<tr>
			<td><{$proj[ls].id}></td>
			<td><{$proj[ls].name}></td>
			<td><{$proj[ls].description}></td>
			<td><{$proj[ls].pid}></td>
			<td><a href="<{$url}>/mod/id/<{$proj[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除《<{$proj[ls].name}>》项目吗？')" href="<{$url}>/del/id/<{$proj[ls].id}>">删除</a></td>
		</tr>
	<{sectionelse}>
		<tr>
			<td colspan="7">没有任何项目</td>	
		</tr>
	<{/section}>
		<tr>
			<td></td>
			<td align="center"><a href="<{$url}>/add">添加项目</a></td>
                	<td colspan="3" align="right"><{$fpage}></td>
		</tr>
</table>
