<p align="right"><a href="<{$url}>/index/bomcode/<{$bomcode}>">返回</a></p>
<center><h2>修改BOM&nbsp;<{$bomname}>&nbsp;中的物料</h2></center>
<form action="<{$url}>/update/bomcode/<{$bomcode}>" method="post" >
	物料编码：<input type="text" name="partcode" value="<{$partcode}>"><br><br>
	数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量：<input type="text" name="num" value="<{$num}>"><br><br>
	位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<textarea cols="40" rows="5" name="refs"><{$refs}></textarea><br><br>
	替代物料：<input type="text" name="substitute" value="<{$substitute}>"><br><br>
	<{if $accounting eq 1 }>
		<label>参与成本核算：<input type="checkbox" name="accounting" checked="checked" ></label><br><br>
	<{else}>
		<label>参与成本核算：<input type="checkbox" name="accounting" ></label><br><br>
	<{/if}>
						  <input type="hidden" name="bomcode" value="<{$bomcode}>">
	<input type="submit" name="sub" value="修改">
</form>
