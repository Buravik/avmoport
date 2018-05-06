		{if $MESSAGE_TYPE eq 1}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E9FAD0" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info1.gif"></td><td class="WelcomeText">{$MESSAGE}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="7FD7F7"></td>
		</tr>
		</table>
		{/if}		
		
		{if $MESSAGE_TYPE eq 2}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E5F6FD" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info2.gif"></td><td class="WelcomeText">{$MESSAGE}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		</table>
		{/if}		
		
		{if $MESSAGE_TYPE eq 3}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="F77F7F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="FDE1E1" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info3.gif" height="25"></td><td class="WelcomeText">{$MESSAGE}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="F77F7F"></td>
		</tr>
		</table>
		{/if}		
		
		{if $MESSAGE_TYPE eq ""}
		<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E9FAD0" height="30">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info.gif"></td><td class="WelcomeText">{$MESSAGE}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		</table>
		{/if}
