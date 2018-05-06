{$base}
<head>
<script src="js/jquery.js"></script>
<script language="JavaScript" src="js/calendar_1.js"></script> 
<link rel="stylesheet" href="css/calendar.css"> 
</head>
	{if $MESSAGE neq ""}
	<span id="MessageSpan">{include file="messages.tpl"}</span>
	{/if}
<table cellpadding="5" cellspacing="1" border="0" width="100%" align="center" bgcolor="BCC7DD">
	<tbody>
		<tr class="titleth">
			<td align="center">
			Паролни алмаштириш
			</td>
		</tr>
		<tr>
			<td bgcolor="White" align="center">
				<form method="POST" action="">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>Жорий пароль</td>
					<td><input type="password" name="oldpaswwd" value=""></td>
				</tr>
				<tr>
					<td>Янги пароль</td>
					<td><input type="password" name="newpaswwd" value=""></td>
				</tr>
				<tr>
					<td>Текшириш учун</td>
					<td><input type="password" name="retpaswwd" value=""></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="SubPasswd" class="myButton" value="Алмаштириш"></div>
					</td>
				</tr>
			</table>
			
		</form>
			</td>
		</tr>
	</tbody>
</table>

{$bottom}