{config_load file="colors.conf" section="$SkinId"}
<html>
<head>
	<title>{$title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<META name="copyright" content="&copy; 2005 Sayqal Solutions">
	<META HTTP-EQUIV="MSThemeCompatible" Content="No">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="css/style3.css">

	{if $isTabs eq 1}
	<link rel="stylesheet" href="css/tabs.css">
	<link rel="stylesheet" href="css/forms.css">
	{/if}

	{if $PhotoUploadPage eq 1}
		<link href="uploadify/css/default.css" rel="stylesheet" type="text/css" />
		<link href="uploadify/css/uploadify.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="uploadify/scripts/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="uploadify/scripts/swfobject.js"></script>
		<script type="text/javascript" src="uploadify/scripts/jquery.uploadify.v2.1.0.min.js"></script>
	{else}
	<script src="js/jquery.min.js"></script>
  <script src="js/jquery.printElement.js" type="text/javascript" charset="utf-8"></script>
  <script src="modal/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" href="modal/jquery.modal.css" type="text/css" media="screen" />
  <script src="js/jquery.maskedinput.min.js"></script>
  <script src="js/jquery.keyfilter-1.7.js"></script>

	{/if}
	{if $isDate eq 1}
	<script language="JavaScript" src="js/calendar_1.js"></script>
	<link rel="stylesheet" href="css/calendar.css">
	{/if}
	
	{if $elTRE eq 1}
		<link rel="stylesheet" href="elrte/css/cupertino/jquery-ui-1.10.4.custom.css" type="text/css" media="screen" charset="utf-8">
 		<link rel="stylesheet" href="elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
 
		<script src="elrte/js/jquery-1.6.1.min.js"          type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/i18n/elrte.ru.js"              type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="elfinder/css/elfinder.min.css" type="text/css" media="screen" charset="utf-8" />
	<script src="elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
	<script src="elfinder/js/i18n/elfinder.ru.js"    type="text/javascript" charset="utf-8"></script>
	{/if}	
	

	<SCRIPT language="JavaScript" src="js/functions.js"></SCRIPT>
	<SCRIPT>
	function RowColorChange(row, color)
	{literal}{{/literal}
	if (row.bgColor == "{$smarty.config.TR_ODD_COLOR}" || row.bgColor == "{$smarty.config.TR_EVEN_COLOR}")
	row.bgColor = "{$smarty.config.TR_MOUSEOVER_COLOR}";
	else
	row.bgColor = color;
	{literal}}{/literal}
	var expire = new Date;
	expire.setTime( expire.getTime() - ( 1 * 24 * 60 * 60 * 1000) );

	function HighlightRow(tr_obj, color)
	{literal}{{/literal}
	var table = tr_obj.parentElement;
	for (var i=1; i<table.rows.length; i++)
	{literal}{{/literal}
	table.rows(i).bgColor = "white";
	{literal}}{/literal}
	tr_obj.bgColor = color;
	{literal}}{/literal}

	function SetCookie(name, value)
	{literal}{{/literal}
	document.cookie = '{php} print session_id(); {/php}'+"["+name+"]" + "=" + escape(value);
	{literal}}{/literal}

	function DropCookie(name)
	{literal}{{/literal}
	document.cookie = '{php} print session_id(); {/php}'+"["+name+"]"+"=; expires="+expire.toGMTString()+"; path=/;";
	window.status = expire.toGMTString();
	{literal}}{/literal}
	</SCRIPT>
	<script for=window event=onbeforeunload>
	document.body.innerHTML="<table width=100%><tr><td align=center><h2>Ожидайте ответа системы...</h2></td></tr></table>";
	</script>
	{literal}
	<style media="print">
		SPAN.noprint {display: none;}
		td.noprint {display: none; background-color:#FFFFFF}
	</style>
	<style>
		thead{display:table-header-group}
	</style>
	{/literal}
</head>
<input type="hidden" value="google" name="MyFileName" id="MyFileName">
<body bgcolor="{#BODY_BGCOLOR#}" topmargin="0" leftmargin="0" marginwidth="0" class="{$SkinId}" onhelp="return Help();">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
	<td valign="top" align="center">
		<div class="HeadBox"> 
			<img src="images/icons/{$PageIcon}" class="HeadIcon"> 
			<h2{$h2class}>{$PageTitle}</h2> 
			<div class="topButtons">
							{if $SortSelectBox neq ""}
								<table cellpadding="2" cellspacing="2" border="0">
									<tr>
										<td class="SortTitle">Саралаш:&nbsp;</td>{$SortSelectBox}
									</tr>
								</table>
							{/if}
							{$LangLinks}
			
			</div> 
		</div>
	<TABLE cellpadding="0" cellspacing="0" align="center" width="99%">
				<TR>
					<td align="center" valign="top"><br>
