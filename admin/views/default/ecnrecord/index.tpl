<table align="center" width="100%" border="1">
<p align="right"><a href="<{$app}>/bominfo/index">返回</a></p>
<caption><h2><{$bomname}>&nbsp;BOM的变更记录</h2></caption>
	<tr>
		<th>ITEM</th>
		<th>变更单号</th>
		<th>变更描述</th>
		<th>变更时间</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><{$data[ls].item}></td>
		<td><a href="<{$url}>/index/bomcode/<{$bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>"><{$data[ls].ecn_num}></a></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].ecntime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><a href="<{$url}>/mod/bomcode/<{$bomcode}>/ecn_item/<{$data[ls].item}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].ecn_num}>吗？')" href="<{$url}>/del/bomcode/<{$bomcode}>/ecn_item/<{$data[ls].item}>">删除</a>/<a href="<{$url}>/index/bomcode/<{$bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>" >明细</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="5">没有变更记录</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="2" align="center"><a href="<{$url}>/add/bomcode/<{$bomcode}>"><b>添加变更</b></a></td>
	
			<td colspan="3" align="right"><{$fpage}></td>
		</tr>

	</form>
</table>
