<table width=900 border="1" align="center">
	<{section loop=$data name="ls"}>
		<tr>
			<td><{$data[ls].id}></td>
			<td><{$data[ls].name}></td>
			<td><{$data[ls].age}></td>
			<td><{$data[ls].sex}></td>
			<td><{$data[ls].email}></td>
		</tr>
	<{/section}>

	<tr>
		<tr><td colspan="5" align="right"><{$fpage}></td></tr>
	</tr>

</table>
