<center><h2>修改供应商</h2></center>
<form action="<{$url}>/update" method="post">
		<input type="hidden" name="id" value="<{$data.id}>">
	供应商：<input type="text" name="name" value="<{$data.name}>"><br>
	<br>
	联络人：<input type="text" name="contacts" value="<{$data.contacts}>"><br>
	<br>
	电&nbsp;&nbsp;&nbsp;&nbsp;话：<input type="text" name="phonenum" value="<{$data.phonenum}>"><br>
	<br>
	地&nbsp;&nbsp;&nbsp;&nbsp;址：<textarea cols="40" rows="5" name="address"><{$data.address}></textarea><br>
	<br>
	代理商：<input type="text" name="agent" value="<{$data.agent}>"><br>
	<br>
	<input type="submit" value="修改供应商">
</form>
