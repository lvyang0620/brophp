<p align="right"><a href="<{$url}>/index/project_id/<{$pro_id}>">返回</a></p>
<center><h2>添加新BOM</h2></center>
<form action="<{$url}>/insert" method="post" >
	BOM编号：<input type="text" name="bomcode"><br><br>
	BOM描述：<textarea cols="40" rows="5" name="description"></textarea><br><br>
        项目名称：
                  <select name="project_id">
                        <option value="0">---请选择---</option>
                        <{section loop="$pro" name="ls"}>
                                <option value="<{$pro[ls].id}>"><{$pro[ls].name}></option>
                        <{/section}>
                  </select><br><br>
	PCB类型：<select name="pcbtype">
                        <option value="M">主板</option>
                        <option value="S">小板</option>
                        <option value="A">天线板</option>
                        <option value="K">按键板</option>
                        <option value="F">软板</option>
                        <option value="T">其他</option>
		</select><br><br>
	PCB版本：<input type="text" name="pcbversion"><br><br>
        客户名称：
                  <select name="custom_id">
                        <option value="0">---请选择---</option>
                        <{section loop="$cus" name="ls"}>
                                <option value="<{$cus[ls].id}>"><{$cus[ls].name}></option>
                        <{/section}>
                  </select><br><br>

	客户项目：<input type="text" name="customproject">(请输入字母或数字)<br><br>

	<input type="submit" name="sub" value="添加BOM">
</form>
