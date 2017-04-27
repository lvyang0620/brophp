<center><h2> 管理供应商</h2></center>
<table width="100%" align="center" border="1">
	<tr>
		<th align="left">供应商ID</th>
		<th align="left">供应商名称</th>
		<th align="left">联系人</th>
		<th align="left">电话号码</th>
		<th align="left">地址</th>
		<th align="left">代理商</th>
		<th align="left">操作</th>
	</tr>

	<{section loop=$sup name="ls"}>	
		<tr>
			<td><{$sup[ls].id}></td>
			<td><{$sup[ls].name}></td>
			<td><{$sup[ls].contacts}></td>
			<td><{$sup[ls].phonenum}></td>
			<td><{$sup[ls].address}></td>
			<td><{$sup[ls].agent}></td>
			<td><a href="<{$url}>/mod/id/<{$sup[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除《<{$sup[ls].name}>》供应商吗？')" href="<{$url}>/del/id/<{$sup[ls].id}>">删除</a></td>
		</tr>
	<{sectionelse}>
		<tr>
			<td colspan="7">没有任何供应商</td>	
		</tr>
	<{/section}>
		<tr>
			<td></td>
			<td align="center"><a href="<{$url}>/add" >添加供应商</a></td>
                	<td colspan="5" align="right"><{$fpage}></td>
		</tr>

</table>
