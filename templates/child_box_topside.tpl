{if ($BOX_WIDTH==0) or ($BOX_WIDTH == '')}
	{assign var="BOX_WIDTH" value="600px"}
{/if}

<table cellpadding="0" cellspacing="0" border="0" width="{$BOX_WIDTH}" align="center">
	<tr>
		<td width="7" height="12" background="images/boxtopleft.gif"></td>
		<td background="images/boxtop.gif" class="MenuLink">{$BOX_TITLE}</td>
		<td width="7" height="12" background="images/boxtopright.gif"></td>
	</tr>
	<tr>
		<td background="images/boxleft.gif"></td>
		<td background="images/form_bg.gif" align="center" valign="middle">