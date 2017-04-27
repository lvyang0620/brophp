<p align="right"><a href="<{$url}>/index/project_id/<{$pro_id}>">返回</a></p>
<center><h2>修改BOM&nbsp;<{$data.bomname}>&nbsp;信息</h2></center>
<form action="<{$url}>/update" method="post" >
	BOM编号：<input type="text" name="bomcode" value="<{$data.bomcode}>"><br><br>
        BOM描述：<textarea cols="40" rows="5" name="description"><{$data.description}></textarea><br><br>
        项目名称：
                  <select name="project_id">
                        <option value="0">---请选择---</option>
                        <{section loop="$pro" name="ls"}>
				<{if $data.project_id eq $pro[ls].id }>
                                	<option selected value="<{$pro[ls].id}>"><{$pro[ls].name}></option>
				<{else}>
                                	<option value="<{$pro[ls].id}>"><{$pro[ls].name}></option>
				<{/if}>
                        <{/section}>
                  </select><br><br>
        PCB类型：<select name="pcbtype">
			<{if $data.pcbtype eq 'M'}>
                        	<option selected value="M">主板</option>
			<{else}>
                        	<option value="M">主板</option>
			<{/if}>
			
			<{if $data.pcbtype eq 'S'}>
                        	<option selected value="S">小板</option>
			<{else}>
                        	<option value="S">小板</option>
			<{/if}>

			<{if $data.pcbtype eq 'A'}>
                        	<option selected value="A">天线板</option>
			<{else}>
                        	<option value="A">天线板</option>
			<{/if}>

			<{if $data.pcbtype eq 'K'}>
                        	<option selected value="K">按键板</option>
			<{else}>
                        	<option value="K">按键板</option>
			<{/if}>
			
			<{if $data.pcbtype eq 'F'}>
                        	<option selected value="F">软板</option>
			<{else}>
                        	<option value="F">软板</option>
			<{/if}>
			
			<{if $data.pcbtype eq 'T'}>
                        	<option selected value="T">其他</option>
			<{else}>
                        	<option value="T">其他</option>
			<{/if}>
                </select><br><br>
	PCB版本：<input type="text" name="pcbversion" value="<{$data.pcbversion}>"><br><br>
        客户名称：
                  <select name="custom_id">
                        <option value="0">---请选择---</option>
                        <{section loop="$cus" name="ls"}>
				<{if $data.custom_id eq $cus[ls].id }>
                                	<option selected value="<{$cus[ls].id}>"><{$cus[ls].name}></option>
				<{else}>
                                	<option value="<{$cus[ls].id}>"><{$cus[ls].name}></option>
				<{/if}>
                        <{/section}>
                  </select><br><br>

	客户项目：<input type="text" name="customproject" value="<{$data.customproject}>">(请输入字母或数字)<br><br>

	<input type="submit" name="sub" value="修改BOM信息">
</form>
