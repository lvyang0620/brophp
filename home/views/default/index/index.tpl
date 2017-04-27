<table border="1" width="800">
	<{section loop=$data name="ls"}>
		<tr>
			<td><{$data[ls].id}></td>
			<td><{$data[ls].name}></td>
			<td><{$data[ls].age}></td>
			<td><{$data[ls].sex}></td>
			<td><{$data[ls].email}></td>
		</tr>
	<{/section}>
</table>
