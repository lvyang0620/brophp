<br>
<table align="left" border="0">
	<tr>
		<td><h4>项目名:</h4></td>
                        <td colspan="1">
                                <select name="project_id" onchange="window.location.href=this.options[selectedIndex].value" >
                                                        <option value="<{$url}>/index/project_id/0">全部</option>
                                        <{section loop="$pro" name="ls"}>
                                                <{if $pro_id eq $pro[ls].id }>
                                                        <option selected value="<{$url}>/index/project_id/<{$pro[ls].id}>"><{$pro[ls].name}></option>
                                                <{else}>
                                                        <option value="<{$url}>/index/project_id/<{$pro[ls].id}>"><{$pro[ls].name}></option>
                                                <{/if}>
                                        <{/section}>
                                </select>

                        </td>

		<td><h4>BOM名:</h4></td>
                        <td colspan="1">
                                <select name="bom_name" onchange="window.location.href=this.options[selectedIndex].value" >
                                                        <option value="<{$url}>/index/bomname/0">全部</option>
                                        <{section loop=$bominfo name="bm"}>
                                                <{if $bomname eq $bominfo[bm].bomname }>
                                                        <option selected value="<{$url}>/index/project_id/<{$pro_id}>/bomname/<{$bominfo[bm].bomname}>"><{$bominfo[bm].bomname}></option>
                                                <{else}>
                                                        <option value="<{$url}>/index/project_id/<{$pro_id}>/bomname/<{$bominfo[bm].bomname}>"><{$bominfo[bm].bomname}></option>
                                                <{/if}>
                                        <{/section}>
                                </select>

                        </td>

	</tr>
	
</table>

<table align="center" width="100%" border="1">
<caption><h2><{$bomname}>&nbsp;BOM的变更记录</h2></caption>
	<tr>
		<th>ID</th>
		<th>项目名称</th>
		<th>BOM名称</th>
		<th>变更单号</th>
		<th>变更描述</th>
		<th>变更创建时间</th>
		<th>最后修改时间</th>
		<th>操作</th>
	</tr>
<form action="<{$url}>/del" method="post" onsubmit="return confirm('确定要删除这些产品吗？')">
<{section loop=$data name="ls"}>
	<tr>
		<td><{$data[ls].id}></td>
		<td><{$data[ls].projectname}></td>
		<td><{$data[ls].bomname}></td>
		<td><a href="<{$url}>/index/bomcode/<{$data[ls].bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>"><{$data[ls].ecn_num}></a></td>
		<td><{$data[ls].description}></td>
		<td><{$data[ls].ctime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><{$data[ls].lastmodtime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
		<td><a href="<{$url}>/mod/bomcode/<{$data[ls].bomcode}>/ecn_item/<{$data[ls].item}>">修改</a>/<a onclick="return confirm('确定要删除<{$data[ls].ecn_num}>吗？')" href="<{$url}>/del/bomcode/<{$data[ls].bomcode}>/ecn_item/<{$data[ls].item}>//ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>">删除</a>/<a href="<{$url}>/index/bomcode/<{$data[ls].bomcode}>/ecn_num/<{$data[ls].ecn_num}>/ecn_detail_tablename/<{$data[ls].ecn_detail_tablename}>">明细</a></td>
		</tr>	
	<{sectionelse}>
		<tr>
			<td colspan="8">没有变更记录</td>
		</tr>
	
	<{/section}>
		<tr>
			<td colspan="8" align="right"><{$fpage}></td>
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
