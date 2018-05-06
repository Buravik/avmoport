<?php /* Smarty version 2.6.5-dev, created on 2018-04-07 21:18:31
         compiled from base.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'base.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "colors.conf",'section' => ($this->_tpl_vars['SkinId'])), $this);?>

<html>
<head>
	<title><?php echo $this->_tpl_vars['title']; ?>
</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<META name="copyright" content="&copy; 2005 Sayqal Solutions">
	<META HTTP-EQUIV="MSThemeCompatible" Content="No">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="css/style3.css">

	<?php if ($this->_tpl_vars['isTabs'] == 1): ?>
	<link rel="stylesheet" href="css/tabs.css">
	<link rel="stylesheet" href="css/forms.css">
	<?php endif; ?>

	<?php if ($this->_tpl_vars['PhotoUploadPage'] == 1): ?>
		<link href="uploadify/css/default.css" rel="stylesheet" type="text/css" />
		<link href="uploadify/css/uploadify.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="uploadify/scripts/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="uploadify/scripts/swfobject.js"></script>
		<script type="text/javascript" src="uploadify/scripts/jquery.uploadify.v2.1.0.min.js"></script>
	<?php else: ?>
	<script src="js/jquery.min.js"></script>
  <script src="js/jquery.printElement.js" type="text/javascript" charset="utf-8"></script>
  <script src="modal/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" href="modal/jquery.modal.css" type="text/css" media="screen" />
  <script src="js/jquery.maskedinput.min.js"></script>
  <script src="js/jquery.keyfilter-1.7.js"></script>

	<?php endif; ?>
	<?php if ($this->_tpl_vars['isDate'] == 1): ?>
	<script language="JavaScript" src="js/calendar_1.js"></script>
	<link rel="stylesheet" href="css/calendar.css">
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['elTRE'] == 1): ?>
		<link rel="stylesheet" href="elrte/css/cupertino/jquery-ui-1.10.4.custom.css" type="text/css" media="screen" charset="utf-8">
 		<link rel="stylesheet" href="elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
 
		<script src="elrte/js/jquery-1.6.1.min.js"          type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
		<script src="elrte/js/i18n/elrte.ru.js"              type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="elfinder/css/elfinder.min.css" type="text/css" media="screen" charset="utf-8" />
	<script src="elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
	<script src="elfinder/js/i18n/elfinder.ru.js"    type="text/javascript" charset="utf-8"></script>
	<?php endif; ?>	
	

	<SCRIPT language="JavaScript" src="js/functions.js"></SCRIPT>
	<SCRIPT>
	function RowColorChange(row, color)
	<?php echo '{'; ?>

	if (row.bgColor == "<?php echo $this->_config[0]['vars']['TR_ODD_COLOR']; ?>
" || row.bgColor == "<?php echo $this->_config[0]['vars']['TR_EVEN_COLOR']; ?>
")
	row.bgColor = "<?php echo $this->_config[0]['vars']['TR_MOUSEOVER_COLOR']; ?>
";
	else
	row.bgColor = color;
	<?php echo '}'; ?>

	var expire = new Date;
	expire.setTime( expire.getTime() - ( 1 * 24 * 60 * 60 * 1000) );

	function HighlightRow(tr_obj, color)
	<?php echo '{'; ?>

	var table = tr_obj.parentElement;
	for (var i=1; i<table.rows.length; i++)
	<?php echo '{'; ?>

	table.rows(i).bgColor = "white";
	<?php echo '}'; ?>

	tr_obj.bgColor = color;
	<?php echo '}'; ?>


	function SetCookie(name, value)
	<?php echo '{'; ?>

	document.cookie = '<?php  print session_id();  ?>'+"["+name+"]" + "=" + escape(value);
	<?php echo '}'; ?>


	function DropCookie(name)
	<?php echo '{'; ?>

	document.cookie = '<?php  print session_id();  ?>'+"["+name+"]"+"=; expires="+expire.toGMTString()+"; path=/;";
	window.status = expire.toGMTString();
	<?php echo '}'; ?>

	</SCRIPT>
	<script for=window event=onbeforeunload>
	document.body.innerHTML="<table width=100%><tr><td align=center><h2>Ожидайте ответа системы...</h2></td></tr></table>";
	</script>
	<?php echo '
	<style media="print">
		SPAN.noprint {display: none;}
		td.noprint {display: none; background-color:#FFFFFF}
	</style>
	<style>
		thead{display:table-header-group}
	</style>
	'; ?>

</head>
<input type="hidden" value="google" name="MyFileName" id="MyFileName">
<body bgcolor="<?php echo $this->_config[0]['vars']['BODY_BGCOLOR']; ?>
" topmargin="0" leftmargin="0" marginwidth="0" class="<?php echo $this->_tpl_vars['SkinId']; ?>
" onhelp="return Help();">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
	<td valign="top" align="center">
		<div class="HeadBox"> 
			<img src="images/icons/<?php echo $this->_tpl_vars['PageIcon']; ?>
" class="HeadIcon"> 
			<h2<?php echo $this->_tpl_vars['h2class']; ?>
><?php echo $this->_tpl_vars['PageTitle']; ?>
</h2> 
			<div class="topButtons">
							<?php if ($this->_tpl_vars['SortSelectBox'] != ""): ?>
								<table cellpadding="2" cellspacing="2" border="0">
									<tr>
										<td class="SortTitle">Саралаш:&nbsp;</td><?php echo $this->_tpl_vars['SortSelectBox']; ?>

									</tr>
								</table>
							<?php endif; ?>
							<?php echo $this->_tpl_vars['LangLinks']; ?>

			
			</div> 
		</div>
	<TABLE cellpadding="0" cellspacing="0" align="center" width="99%">
				<TR>
					<td align="center" valign="top"><br>