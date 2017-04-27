<p align="right"><a href="<{$url}>/index/bomcode/<{$bomcode}>">返回</a></p>
<center><h2>往&nbsp;<{$bomname}>&nbsp;BOM添加ECN变更记录</h2></center>
<form action="<{$url}>/insert/bomcode/<{$bomcode}>" method="post" >
	ECN单号：<input type="text" name="ecn_num"><br><br>
	变更描述：<textarea cols="40" rows="5" name="description"></textarea><br><br>
		<input type="hidden" name="bomcode" value="<{$bomcode}>">
		<input type="hidden" name="ecnrectablename" value="<{$ecnrectablename}>">
	<input type="submit" name="sub" value="加入变更表">
</form>
