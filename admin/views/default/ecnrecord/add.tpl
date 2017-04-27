<p align="right"><a href="<{$url}>/index/bomcode/<{$bomcode}>">返回</a></p>
<center><h2>往&nbsp;<{$bomname}>&nbsp;BOM中添加新物料</h2></center>
<form action="<{$url}>/insert/bomcode/<{$bomcode}>" method="post" >
	物料编码：<input type="text" name="partcode"><br><br>
	数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：<input type="text" name="num"><br><br>
	位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<textarea cols="40" rows="5" name="refs"></textarea><br><br>
	替代物料：<input type="text" name="substitute"><br><br>
	<label>参与成本核算：<input type="checkbox" name="accounting"></label><br><br>
						  <input type="hidden" name="bomcode" value="<{$bomcode}>">
	<input type="submit" name="sub" value="加入BOM">
</form>
