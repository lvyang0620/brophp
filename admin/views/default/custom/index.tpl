<center><h2> 管理客户</h2></center>
<table width="100%" align="center" border="1">
	<tr>
		<th align="left">客户ID</th>
		<th align="left">客户名称</th>
		<th align="left">客户简称</th>
		<th align="left">联系人</th>
		<th align="left">电话号码</th>
		<th align="left">地址</th>
		<th align="left">操作</th>
	</tr>

	<{section loop=$cus name="ls"}>	
		<tr>
			<td><{$cus[ls].id}></td>
			<td><{$cus[ls].name}></td>
			<td><{$cus[ls].shortname}></td>
			<td><{$cus[ls].contacts}></td>
			<td><{$cus[ls].phonenum}></td>
			<td><{$cus[ls].address}></td>
			<td><a href="<{$url}>/mod/id/<{$cus[ls].id}>">修改</a>/<a onclick="return confirm('确定要删除《<{$cus[ls].name}>》供应商吗？')" href="<{$url}>/del/id/<{$cus[ls].id}>">删除</a></td>
		</tr>
	<{sectionelse}>
		<tr>
			<td colspan="7">没有任何客户信息</td>	
		</tr>
	<{/section}>
		<tr>
			<td></td>
			<td align="center"><a href="<{$url}>/add" >添加客户</a></td>
                	<td colspan="5" align="right"><{$fpage}></td>
		</tr>

</table>
