<?php /* Smarty version 2.6.5-dev, created on 2018-04-03 22:07:45
         compiled from menu.tpl */ ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<link rel="stylesheet" href="css/newstyle.css">
	<SCRIPT>
	<?php echo '
	minus = new Image();
	minus.src = "images/minus.gif";
	function Display(obj)
	{
		str = new String(obj.id);
		str = str.replace("img_", "");
		var table = document.getElementById("table_" + str);

		if (table.style.display == "none")
		{
			SetActiveMenu(obj);
			table.style.display = "inline";
			obj.src = minus.src;
		}
		else
		{
			RemoveActiveMenu(obj);
			obj.src = "images/plus.gif";
			table.style.display = "none";
		}
	}
	function SetActiveMenu(obj)
	{
		var expire = new Date;
		expire.setTime( expire.getTime() + ( 30 * 24 * 60 * 60 * 1000) );
		'; ?>

		document.cookie = obj.id+"="+escape(obj.id)+"; expires="+expire.toGMTString()+"; path=/; domain=.<?php  print SERVER_NAME;  ?>";
		<?php echo '
	}
	function RemoveActiveMenu(obj)
	{
		var expire = new Date;
		expire.setTime( expire.getTime() - ( 30 * 24 * 60 * 60 * 1000) );
		document.cookie = obj.id + "=" +"; expires=" + expire.toGMTString();
	}
	function GetActiveMenu()
	{
		var theCookies = document.cookie.split("; ");
		for( var i in theCookies )
		{
			var aCookie = theCookies[i];

			if (aCookie.split( "=" )[0].match(\'^img_.+\'))
				document.getElementById( unescape( aCookie.split( "=" )[1] ) ).click();
		}
	}
	function selectstart()
	{
		window.event.cancelBubble = true;
		window.event.returnValue = false;
		return false;
	}
	</script>
	'; ?>

</head>

<body class="<?php echo $this->_tpl_vars['SkinId']; ?>
" topmargin="0" leftmargin="0" background="images_<?php echo $this->_tpl_vars['SkinId']; ?>
/ver_line1.gif" onselectstart="selectstart();" onhelp="return Help();">
	<?php echo $this->_tpl_vars['valMenu']; ?>

</body>
</html>