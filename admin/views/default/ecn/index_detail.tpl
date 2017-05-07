<table align="center" width="100%" border="1">
<p align="right"><a href="<{$app}>/bominfo/index">返回</a></p>
<caption><h2><{$bomname}>&nbsp;BOM的变更记录</h2></caption>
	<tr>
		<th>ITEM</th>
		<th>变更单号</th>
		<th>变更描述</th>
		<th>变更创建时间</th>
		<th>最后修改时间</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><{$data[ls].item}></td>
		<td><a href="<{$url}>/index/bomcode/<{$bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>"><{$data[ls].ecn_num}></a></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].ecntime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><{$data[ls].lastmodtime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><a href="<{$url}>/mod/bomcode/<{$bomcode}>/ecn_item/<{$data[ls].item}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].ecn_num}>吗？')" href="<{$url}>/del/bomcode/<{$bomcode}>/ecn_item/<{$data[ls].item}>//ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>">删除</a>/<a href="<{$url}>/index/bomcode/<{$bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>">明细</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="6">没有变更记录</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="2" align="center"><a href="<{$url}>/add/bomcode/<{$bomcode}>"><b>添加变更</b></a></td>
	
			<td colspan="4" align="right"><{$fpage}></td>
		</tr>

	</form>
</table>

<table align="center" width="100%" border="1" cellpadding="0" cellspacing="1">
	<caption><h3><{$ecn_num}>&nbsp;变更单明细表</h3></caption>
		<tr>
                        <th>ITEM</th>
                        <th>更改原因</th>
                        <th>更改描述</th>
                        <th>动作</th>
                        <th>物料编码</th>
                        <th>新数量</th>
                        <th>新位号列表</th>
                        <th>新替代料</th>
                        <th>执行方式</th>
                        <th>旧料处理方式</th>
		</tr>
	<{section loop=$ecn_detail_data name="es"}>
		<tr>
			<td><{$ecn_detail_data[es].item}></td>
			<td><{$ecn_detail_data[es].reason}></td>
			<td><{$ecn_detail_data[es].description}></td>
			<td><{$ecn_detail_data[es].act}></td>
			<td><{$ecn_detail_data[es].partcode}></td>
			<td><{$ecn_detail_data[es].new_num}></td>
			<td><{$ecn_detail_data[es].new_refs}></td>
			<td><{$ecn_detail_data[es].new_substitute}></td>
			<td><{$ecn_detail_data[es].action_type}></td>
			<td><{$ecn_detail_data[es].oldpart_dealing}></td>
		</tr>
	<{sectionelse}>
		<tr>
			<td colspan="10" >变更明细表里没有数据</td>
		</tr>
	<{/section}>
</table>
