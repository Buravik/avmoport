{config_load file="colors.conf" section="$SkinId"}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>{$Title}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<link rel="icon" href="/favicon.ico">
		<link rel="stylesheet" href="css/newstyle.css">
		{literal}
		<style>
body
{
background:#DEE8F6; margin: 0 0 0 0;
font-family:Arial;
font-size:10ps;

}
.Enter {
	color: #0A2059;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 10px;	
}

INPUT.EnterPage{
	BORDER-BOTTOM: 1px solid #000000;
	BORDER-LEFT: #000000 1px solid;
	BORDER-RIGHT: #000000 1px solid;
	BORDER-TOP: #000000 1px solid;
	FONT-COLOR: #f0f8ff FONT-SIZE: 7pt;
	PADDING-BOTTOM:0px;
	PADDING-LEFT: 2px;
	PADDING-RIGHT: 2px;
	PADDING-TOP: 0px;
	background-attachment : scroll;
	background-position : top;
	background-repeat : repeat-x;
	border-color : #5981D2;
	background-color : #F1F7FE;
	height: 20px;
	vertical-align : top;
	font-family : Arial;
	margin-top : 0;
}

a.ovalbutton{
background: transparent url('images/oval-blue-left.gif') no-repeat top left;
display: inline;
/*float: left;*/
font: normal 13px Tahoma; /* Change 13px as desired */
line-height: 16px; /* This value + 4px + 4px (top and bottom padding of SPAN) must equal height of button background (default is 24px) */
height: 24px; /* Height of button background height */
padding-left: 11px; /* Width of left menu image */
text-decoration: none;
}

a:link.ovalbutton, a:visited.ovalbutton, a:active.ovalbutton{
color: #000; /*button text color*/
text-decoration:none;
}

a.ovalbutton span{
background: transparent url('images/oval-blue-right.gif') no-repeat top right;
display: block;
padding: 4px 11px 4px 0; /*Set 11px below to match value of 'padding-left' value above*/
}

a.ovalbutton:hover{ /* Hover state CSS */
background-position: bottom left;
}

a.ovalbutton:hover span{ /* Hover state CSS */
background-position: bottom right;
color: black;
}

.buttonwrapper{ /* Container you can use to surround a CSS button to clear float */
/*overflow: hidden; /*See: http://www.quirksmode.org/css/clearing.html */
width: 100%;
text-align: center;
}

h2
{
	font-size: 25px;
	margin: 6px 0;
	  text-shadow: 0px 2px white;
}
h2.red
{
 color: red;
 margin-bottom: 20px;
 font-size: 45px;
}
		</style>		
		{/literal}
	</head>
<body class="login" leftmargin=0 rightmargin=0 topmargin=2><br>
<br>

<noscript>
<table cellpadding="0" cellspacing="0" border="0" align="center">
	<tr>
		<td height="4" background="images_{$SkinId}/left_top_corner.gif" width="4"></td>
		<td height="4" width="222" background="images_{$SkinId}/top_side_border.gif"></td>
		<td height="4" background="images_{$SkinId}/right_top_corner.gif" width="4"></td>
	</tr>
	<tr>
		<td background="images_{$SkinId}/left_side_border.gif" width="4"></td>
		<td valign="top" align="center">
		<table cellpadding="0" cellspacing="0" border="0" bgcolor="FDDDDD" width="765">
			<tr>
				<td align="center" height="25" class="AlarmText">{$JAVA_NOT_ENABLED}</td>
			</tr>
		</table>
		</td>
		<td background="images_{$SkinId}/right_side_border.gif" width="4"></td>
	</tr>
	<tr>
		<td height="4" background="images_{$SkinId}/left_boot_corner.gif" width="4"></td>
		<td height="4" width="150" background="images_{$SkinId}/boot_side_border.gif"></td>
		<td height="4" background="images_{$SkinId}/right_boot_corner.gif" width="4"></td>
	</tr>
</table>
</noscript>

{if $MESSAGE neq ""}
	<span id="MessageSpan">{include file="messages.tpl"}</span>
<br>
<br>
{/if}
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
			<TBODY>
			<TR>
				<TD>
					<div align="center"><img src="images/logo.png" style="width: 300px; margin-top: 100px;"></div>
					<div align="center">
					<h2>{$Dict.uzbekistan}</h2>
					<h2>{$Dict.ministry}</h2>
					<h2 class="red">{$Dict.test_center}</h2>
					</div>
					<TABLE cellSpacing=0 cellPadding=0 align=center border=0>
					<TBODY>
					<TR>
						<TD align=middle width=370 background=images/logon.gif height=191>
							<br><div align="center" class="Enter">{$ENTER_TO_SYSTEM}</div>
							<FORM name="Auth" action="auth.php" method="post" autocomplete="off">
								<TABLE cellSpacing=2 cellPadding=2 align=center border=0>
									<TBODY>
									<TR>
										<TD class=Enter align=right>Логин:&nbsp; </TD>
										<TD class=Logon align=right><input type="text" size="15" name="login" class="EnterPage"></TD>
									</TR>
									<TR>
										<TD class=Enter align=right>Пароль:&nbsp;</TD>
										<TD class=Logon align=right><input type="password" value="" size="15" name="password" class="EnterPage"></TD>
									</TR>
									<TR>
										<TD align=middle colSpan=2>
											<INPUT type="submit" value="  Вход  " class="buttonPerfect_{$SkinId}">
										</TD>
									</TR>
									</TBODY>
								</TABLE>
							</FORM>
							<script language="JavaScript">
							{if $smarty.cookies.login == ''}
								document.Auth.login.focus();
							{else}
								document.Auth.login.value="{$smarty.cookies.login}";
								document.Auth.password.focus();
							{/if}
							</script>
							</TD>
						</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
		</TABLE>
</body>
</html>