{$base}
<!--	<script>
		parent.infoframe.ChangeInfo('{$Info.company}','{$Info.name} ({$Info.username})');
	</script>-->
	<script for=window event=onbeforeunload>
	document.body.innerHTML="<table width=100%><tr><td align=center><h4>Тизим жавобини кутинг....</h4></td></tr></table>";
	</script>
<br>
<br>
<br>
		<table cellpadding="0" cellspacing="0" border="0" width="95%" align="center">
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		<tr>
			<td align="center" bgcolor="E9FAD0" height="100">
				<table cellpadding="2" cellspacing="2" border="0">
					<tr>
						<td width="50"><img src="images/info.gif"></td><td class="WelcomeText">{$WelcomeMess}</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="98D23F"></td>
		</tr>
		</table>
{$bottom}