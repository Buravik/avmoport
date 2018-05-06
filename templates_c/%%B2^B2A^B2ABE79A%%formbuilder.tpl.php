<?php /* Smarty version 2.6.5-dev, created on 2018-04-12 21:48:47
         compiled from formbuilder.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'checkparams', 'formbuilder.tpl', 431, false),array('modifier', 'crypt', 'formbuilder.tpl', 550, false),array('modifier', 'number_format', 'formbuilder.tpl', 553, false),array('modifier', 'time_date_format', 'formbuilder.tpl', 555, false),)), $this); ?>
<?php echo $this->_tpl_vars['base']; ?>

<head>
</head>
<script for=window event=onbeforeunload>
document.body.innerHTML="<table width=100% height=100%><tr><td align=center><h4>Дастур жавобини кутинг...</h4></td></tr></table>";
</script>
<script>
<?php echo '
function GetAjaxInfoEdit(RowID)
{
	document.getElementById(\'WaitEditSpan\').innerHTML = \'<font color=red><b>Please wait...</b></font>\';
	var url = "get_ajax_info1.php?case=formbuilder&tid=';  echo $this->_tpl_vars['Section']['tablename'];  echo '&rowid="+RowID;
	//document.getElementById(\'MyFieldsURL\').value = url;

	MakeHttpRequiestEdit(url);
}
function MakeHttpRequiestEdit(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessEdit;
	xmlHTTP.send(null);
}
function ProcessEdit()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
			//document.forms[\'add_card_frm\'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = \'none\';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "<&sep&>";
			var newArray = nameList.split(regexp);
			'; ?>

			<?php echo $this->_tpl_vars['JavaProccVal']; ?>

			<?php echo '
			document.getElementById(\'WaitEditSpan\').innerHTML = \'\';
		}
	}
}

function GetAjaxInfoDel(RowID)
{
	var url = "get_ajax_info1.php?case=formbuilder&tid=';  echo $this->_tpl_vars['Section']['tablename'];  echo '&rowid="+RowID;
	MakeHttpRequiestDel(url);
}
function MakeHttpRequiestDel(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessDel;
	xmlHTTP.send(null);
}
function ProcessDel()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
			//document.forms[\'add_card_frm\'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = \'none\';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "<&sep&>";
			var newArray = nameList.split(regexp);
			'; ?>

			<?php echo $this->_tpl_vars['JavaProccVald']; ?>

			<?php echo '
		}
	}
}

function getChildBoxVal(id,parent,parname,type)
{
	var url = "get_ajax_page.php?case=childsb&rowid="+id+"&parid="+parent+"&type="+type+"&parname="+parname;
	//window.status = url;
	MakeHttpRequiestChild(url);
}
function MakeHttpRequiestChild(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessChild;
	xmlHTTP.send(null);
}
function ProcessChild()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
		}
		else
		{
			var nameList = resp;
			var regexp = "<&ArrSep&>";
			var newArray = nameList.split(regexp);
			for ( var i = 0 ; i < newArray.length ; i++ )
			{
				if (newArray[i] != "")
				{
					var regexp2 = "<&sep&>";
					var newArray2 = newArray[i].split(regexp2);
					window.alert = newArray2[0];
					if (el= document.getElementById(newArray2[0]))
					{
						el.innerHTML = newArray2[1];
					}
				}
			}
		}
	}
}

function getListBySort(menu_id,sort,field,lang)
{
	document.getElementById(\'ContentList\').innerHTML = "<p class=AlarmText><b>Пожалуйста ждите!</b></p>";
	SetCookie(\'sortmenu\',menu_id);
	SetCookie(\'sortby\',field);
	SetCookie(\'sortid\',sort);
	var url = "get_ajax_page.php?case=list_by_sort&menuid="+menu_id+"&sortid="+sort+"&field="+field+"&lang="+lang;
	//window.status = url;
	MakeHttpRequiestList(url);
}
function MakeHttpRequiestList(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessList;
	xmlHTTP.send(null);
}
function ProcessList()
{
	//window.status = xmlHTTP.readyState;
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		document.getElementById(\'ContentList\').innerHTML = resp;
	}
}

function AddDynamicSB(id,name,type,parfield)
{
	var dynCount = document.getElementById(name+"DynCount").value;
	if(el=document.getElementById("ThisDyn"+name+"_"+dynCount))
	{
		dynCount++;
	}

	if (document.getElementById(\'DynamicFormName\').value == name)
	{
		var ThisDynCount = parseInt(dynCount)+1;
		if(el=document.getElementById(name))
		{
			el.innerHTML += "<div id=ThisDyn"+name+"_"+ThisDynCount+"><input type=button value=\'x\' style=\'width:25px; height=25px;\'  ondblclick=DelDynSB(\'"+name+"\',"+ThisDynCount+");>"+document.getElementById(\'DynamicFormContent\').innerHTML+"</div>";
		}
		if(ell=document.getElementById(name+\'DynCount\'))
		{
			ell.value ++;
		}
	}
	else
	{
		if (type == \'edit\')
		{
			if (el=document.getElementById(parfield+\'fe\'))
			{
				var ParVal = document.getElementById(parfield+\'fe\').value;
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
			}
			else
			{
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
			}
		}
		else
		{
			if (el=document.getElementById(parfield+\'fc\'))
			{
				var ParVal = document.getElementById(parfield+\'fc\').value;
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
			}
			else
			{
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
			}
		}
		//window.status = url;
		//document.getElementById(\'MyFieldsURL\').value = url;
		MakeHttpRequiestListDynamic(url);
	}
}
function AddDynamicSBNew(id,name,type,parfield)
{
	var dynCount = document.getElementById(name+"DynCount").value;
	if(el=document.getElementById("ThisDyn"+name+"_"+dynCount))
	{
		var dynCount = dynCount+1;
	}
	if (type == \'edit\')
	{
		if (el=document.getElementById(parfield+\'fe\'))
		{
			var ParVal = document.getElementById(parfield+\'fe\').value;
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
		}
		else
		{
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
		}
	}
	else
	{
		if (el=document.getElementById(parfield+\'fc\'))
		{
			var ParVal = document.getElementById(parfield+\'fc\').value;
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
		}
		else
		{
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
		}
	}
	//window.status = url;
	//document.getElementById(\'MyFieldsURL\').value = url;
	MakeHttpRequiestListDynamic(url);
}
function MakeHttpRequiestListDynamic(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessListDynamic;
	xmlHTTP.send(null);
}
function ProcessListDynamic()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
		}
		else
		{
			var nameList = resp;
			var regexp = "<&sep&>";
			var newArray = nameList.split(regexp);
			if(el=document.getElementById(newArray[0]))
			{
				el.innerHTML += "<div id=ThisDyn"+newArray[0]+"_"+newArray[1]+"><input type=button value=\'x\' style=\'width:25px; height=25px;\'  ondblclick=DelDynSB(\'"+newArray[0]+"\',"+newArray[1]+");>"+newArray[2]+"</div>";
				document.getElementById(\'DynamicFormContent\').innerHTML = newArray[2];
				document.getElementById(\'DynamicFormName\').value = newArray[0];
			}
			if(ell=document.getElementById(newArray[0]+\'DynCount\'))
			{
				ell.value ++;
			}
		}
	}
}

function addCommas(nStr)
{
	nStr += \'\';
	x = nStr.split(\'.\');
	x1 = x[0];
	x2 = x.length > 1 ? \'.\' + x[1] : \'\';
	var rgx = /(\\d+)(\\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, \'$1\' + \' \' + \'$2\');
	}
	return x1 + x2;
}

function DelDynSB(field,id)
{
	//var thidId = id +1;
	//document.getElementById(\'MyFieldsURL\').value = "ThisDyn"+field+"_"+id;
	if(el=document.getElementById("ThisDyn"+field+"_"+id))
	{
		el.outerHTML = "";
	}
}

function SetDynamicValues(fields,values,table,rowid)
{
	var url = "get_ajax_page.php?case=set_dyn_vals&rowid="+rowid+"&fields="+fields+"&values="+values+"&table="+table;

	/*	var regexp = "<s>";
	var newArray = fields.split(regexp);
	for ( var i = 0 ; i < newArray.length ; i++ )
	{
	if (el= document.getElementById(newArray[i]+"e"))
	{
	el.innerHTML = "";
	}
	}
	*/	//window.alarm = fields;
	//document.getElementById(\'MyFieldsURL\').value = url;
	MakeHttpRequiestDynamic(url);
}

function MakeHttpRequiestDynamic(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.setRequestHeader("Content-Type", "text/html; charset=UTF8");
	xmlHTTP.onreadystatechange = ProcessDynamic;
	xmlHTTP.send(null);
}
function ProcessDynamic()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
		}
		else
		{
			var nameList = resp;
			var regexp = "<&ArrSep&>";
			var newArray = nameList.split(regexp);
			for ( var i = 0 ; i < newArray.length ; i++ )
			{
				if (newArray[i] != "")
				{
					var regexp2 = "<&sep&>";
					var newArray2 = newArray[i].split(regexp2);

					if (el= document.getElementById(newArray2[0]))
					{
						el.innerHTML = document.getElementById(newArray2[0]+\'d\').innerHTML + newArray2[1];
						document.getElementById(newArray2[0]+\'DynCount\').value = newArray2[2];
						//document.getElementById(newArray2[0]+\'DynCount\').value ++;
					}
				}
			}
		}
	}
}

function separateThousands(s){
	s.value = removeThousands(s.value);
	try{
		var v = s/1000;
	}catch (exception){
		alert("Ошибка введения суммы!");
		return true;
	}
	if(s.value > 999999){
		var s0 = s.value;
		var s1 = s0.substring(s0.length-6);
		var s2 = s1.substring(0,3) + \',\' + s1.substring(3);
		s.value = s0.substring(0,s0.length-6) + \',\' + s2;
		return true;
	}
	if(s.value > 999){
		var s1 = Math.floor(s.value / 1000);
		var s2 = s.value % 1000;
		if(s2 == 0)  s.value = s1 + \',\' + \'000\';
		else if(s2 < 10)  s.value = s1 + \',\' + \'00\' + s2;
		else if(s2 < 100) s.value = s1 + \',\' + \'0\' + s2;
		else s.value = s1 + \',\' + s2;
	}
	return true;
}

function removeThousands(s){
	var s2 = \'\';
	for(j=0; j < s.length; j++){
		if (s.charAt(j)!=\',\'){
			s2 += s.charAt(j);
		}
	}
	return s2;
}
'; ?>



</script>

<!--<textarea cols="100" id="MyFieldsURL" rows="5"></textarea>-->
	<?php if ($this->_tpl_vars['MESSAGE'] != ""): ?>
	<span id="MessageSpan"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['SYS_STATUS'] != ""): ?>
	<span id="MessageSpan"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['SHOWDIALOG'] != 0): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="98%">
		<tr>
			<td height="1"></td>
		</tr>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="1"></td>
				<?php echo $this->_tpl_vars['FULLPATH']; ?>

			</tr>
			</table>
			
			</td>
		</tr>
		
		<tr>
			<table class="w_100 ta_c">
				<tr>
					<td class="va_t">
						<!-- News sort ( -->
						<div class="news_sort" id="RightTabs1">
						<strong>
						
						</strong>
						<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'noactions') : smarty_modifier_checkparams($_tmp, 'noactions')) == ""): ?>
						<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addactions') : smarty_modifier_checkparams($_tmp, 'addactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</p></i></i></b>
						<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addedactions') : smarty_modifier_checkparams($_tmp, 'addedactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</p></i></i></b>
						<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'adddellactions') : smarty_modifier_checkparams($_tmp, 'adddellactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</p></i></i></b>
						<?php else: ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</p></i></i></b>
						<?php endif; ?>
						<?php endif; ?>
						</div>
						
						<div class="news_sort" id="RightTabs2">
						<strong>
						
						</strong>
						<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addactions') : smarty_modifier_checkparams($_tmp, 'addactions')) != ""): ?>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addedactions') : smarty_modifier_checkparams($_tmp, 'addedactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</a></p></i></i></div><em></em>	
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'adddellactions') : smarty_modifier_checkparams($_tmp, 'adddellactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php else: ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</a></p></i></i></div><em></em>	
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php endif; ?>
						<div class="news_sort" id="RightTabs3">
						<strong>
						
						</strong>
						<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addactions') : smarty_modifier_checkparams($_tmp, 'addactions')) != ""): ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addedactions') : smarty_modifier_checkparams($_tmp, 'addedactions')) != ""): ?>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php else: ?>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</a></p></i></i></div><em></em>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php endif; ?>
						
						<div class="news_sort" id="RightTabs4">
						<strong>
						
						</strong>
						<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'adddellactions') : smarty_modifier_checkparams($_tmp, 'adddellactions')) != ""): ?>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php else: ?>
						<b><i><i><p><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</a></p></i></i></div><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(2);"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);"><?php echo $this->_tpl_vars['Lang']['LIST']; ?>
</a></p></i></i></div>	
						</div>
						<?php endif; ?>						<!-- ) News sort -->
						<table id="TabContent1" width="100%">
						<tr>
						<td>
							<div id="ContentList">
								<?php if ($this->_tpl_vars['ContentRows'] != ""): ?><br>
								<table cellpadding="5" cellspacing="1" border="0" width="100%" align="center" bgcolor="BCC7DD">
									<tr class="titleth">
										<td height="25"></td>
										<?php if (count($_from = (array)$this->_tpl_vars['ListMembers'])):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['Members']):
?>
										<td align="center">
										<?php echo $this->_tpl_vars['Members']; ?>

										</td>
										<?php endforeach; unset($_from); endif; ?>
										<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'noactions') : smarty_modifier_checkparams($_tmp, 'noactions')) == "" && ((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addactions') : smarty_modifier_checkparams($_tmp, 'addactions')) == ""): ?>
											<td colspan="2"></td>
										<?php endif; ?>
									</tr>
									<?php $this->assign('RowsCount', 0); ?>
									<?php $this->assign('ColorRow', 0); ?>
									<?php $this->assign('AnchorId', 0); ?>
									<?php if (count($_from = (array)$this->_tpl_vars['ContentRows'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Rows']):
?>
									<?php $this->assign('RowsCount', $this->_tpl_vars['RowsCount']+1); ?>
									<?php if ($this->_tpl_vars['ColorRow'] == 0): ?>
									<tr bgcolor="FFFFFF">
									<?php $this->assign('ColorRow', 1); ?>
									<?php else: ?>
									<tr bgcolor="#E4EAF2">
									<?php $this->assign('ColorRow', 0); ?>
									<?php endif; ?>
										<td class="LittleRows"  height="25" align="center"><b><?php echo $this->_tpl_vars['RowsCount']; ?>
</b></td>
										<?php if (count($_from = (array)$this->_tpl_vars['ListMember'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Member']):
?>
										<td	 
											<?php if ($this->_tpl_vars['ListMembersTypes'][$this->_tpl_vars['key']] == 'Money'): ?> nowrap align="right"<?php endif; ?>
											<?php if ($this->_tpl_vars['ListMembersInputTypes'][$this->_tpl_vars['key']] == 'date'): ?> align="center"<?php endif; ?>
											>
										<?php if ($this->_tpl_vars['Member'] == 'mid_path_link'): ?>
											<a href="formbuilder.php?mid=<?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>
&cid=<?php echo ((is_array($_tmp=$this->_tpl_vars['Rows']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
"><?php echo $this->_tpl_vars['ListMembers'][$this->_tpl_vars['key']]; ?>
</a>
										<?php else: ?>
											<?php if ($this->_tpl_vars['ListMembersTypes'][$this->_tpl_vars['key']] == 'Money'): ?>
												<?php echo ((is_array($_tmp=$this->_tpl_vars['Rows'][$this->_tpl_vars['Member']])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
&nbsp;
											<?php elseif ($this->_tpl_vars['ListMembersTypes'][$this->_tpl_vars['key']] == 'SysDate' && $this->_tpl_vars['ListMembersInputTypes'][$this->_tpl_vars['key']] == 'hidden'): ?>
												<?php echo ((is_array($_tmp=$this->_tpl_vars['Rows'][$this->_tpl_vars['Member']])) ? $this->_run_mod_handler('time_date_format', true, $_tmp) : smarty_modifier_time_date_format($_tmp)); ?>
&nbsp;
																						<?php else: ?>	
												<?php if ($this->_tpl_vars['Member'] == 'id'): ?>
													<?php $this->assign('AnchorId', $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]); ?>
													<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'SetCookieId') : smarty_modifier_checkparams($_tmp, 'SetCookieId')) != ""): ?>
														<DIV align="center">
														<?php $this->assign('ThisFieldName', $this->_tpl_vars['Section']['name_u']); ?>
														<input type="radio" name="<?php echo $this->_tpl_vars['ThisFieldName']; ?>
" id="<?php echo $this->_tpl_vars['ThisFieldName']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_COOKIE[$this->_tpl_vars['ThisFieldName']] == $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]): ?>checked<?php endif; ?> onclick="SetCookie('<?php echo $this->_tpl_vars['ThisFieldName']; ?>
', <?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>
);">
														</DIV>
													<?php else: ?>	
													<?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>

													<?php endif; ?>
												<?php else: ?>
													<?php if ($this->_tpl_vars['Member'] == 'nodecount'): ?>
														<a href="formbuilder.php?mid=<?php echo $_GET['mid']; ?>
&parent=<?php echo $this->_tpl_vars['Rows']['id']; ?>
"><font size="2"><b><?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>
</b></font></a>
													<?php elseif ($this->_tpl_vars['ListMembersTypes'][$this->_tpl_vars['key']] == 'Fields'): ?>
														<a href="formfields.php?form_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['Rows']['id'])) ? $this->_run_mod_handler('crypt', true, $_tmp) : smarty_modifier_crypt($_tmp)); ?>
"><font size="2"><b><?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>
</b></font></a>
													<?php else: ?>
														<?php echo $this->_tpl_vars['Rows'][$this->_tpl_vars['Member']]; ?>

													<?php endif; ?>
												<?php endif; ?>
											<?php endif; ?>	
										<?php endif; ?>	
										</td>
										<?php endforeach; unset($_from); endif; ?>
										<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'noactions') : smarty_modifier_checkparams($_tmp, 'noactions')) == "" && ((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addactions') : smarty_modifier_checkparams($_tmp, 'addactions')) == ""): ?>
											<?php if (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'addedactions') : smarty_modifier_checkparams($_tmp, 'addedactions')) != ""): ?>
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit(<?php echo $this->_tpl_vars['Rows']['id']; ?>
);"><img src="images/edit.gif" border="0" width="26"></a></td>
											<?php elseif (((is_array($_tmp=$this->_tpl_vars['Section']['name_r'])) ? $this->_run_mod_handler('checkparams', true, $_tmp, 'adddellactions') : smarty_modifier_checkparams($_tmp, 'adddellactions')) != ""): ?>
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); GetAjaxInfoDel(<?php echo $this->_tpl_vars['Rows']['id']; ?>
);"><img src="images/del.gif" border="0" width="26"></a></td>
											<?php else: ?>
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit(<?php echo $this->_tpl_vars['Rows']['id']; ?>
);"><img src="images/edit.gif" border="0" width="26"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); GetAjaxInfoDel(<?php echo $this->_tpl_vars['Rows']['id']; ?>
);"><img src="images/del.gif" border="0" width="26"></a>
												</td>
											<?php endif; ?>
										<?php endif; ?>
									</tr>	
									<?php endforeach; unset($_from); endif; ?>
								</table>
							<?php endif; ?>
							</div>
							<?php if ($this->_tpl_vars['MyPagesList'] != ""): ?><br>
							<table cellpadding="0" cellspacing="1" border="0" width="100%" bgcolor="Silver">
								<tr>
									<td height="30" align="center" bgcolor="E7E4E4">
										<table cellpadding="2" cellspacing="2" border="0">
											<tr>
												<td class="SortTitle">Са&#1203;ифаларга ўтиш:</td>
												<td>
												<?php echo $this->_tpl_vars['MyPagesList']; ?>

												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>	
							<?php endif; ?>
						</td>
						</tr>
						</table>
						<table id="TabContent2" width="100%">
						<tr>
						<td>
							<BR>
							<form action="formbuilder.php?mid=<?php echo $_GET['mid'];  echo $this->_tpl_vars['addUrl'];  echo $this->_tpl_vars['addUrlForm']; ?>
" method="POST" name="FormAdd" id="PutOn" enctype="multipart/form-data">
							<fieldset>
							<legend><span id="FieldLegend<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['Lang']['ADD']; ?>
</span></legend>
							<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
							
							<?php if ($this->_tpl_vars['Section']['BuildType'] == 1): ?>
										<tr>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
										<?php if ($this->_tpl_vars['Field']['InputType'] != 'hidden'): ?>
											<td class="fComments" height="60">
											<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:<br>
											
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'html'): ?>
												<?php if ($this->_tpl_vars['Field']['addoptions'] == 'HTMLArea'): ?>
												<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "<?php echo $this->_tpl_vars['Field']['height']; ?>
px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
', config);
													</script>
												<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															               fmOpen : function(callback) {
																		      $(\'<div/>\').dialogelfinder({
																		        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
																		        // lang: \'ru\', // elFinder language (OPTIONAL)
																		        commandsOptions: {
																		          getfile: {
																		            oncomplete: \'destroy\' // destroy elFinder after file selection
																		          }
																		        },
																		        getFileCallback: callback // pass callback to editor
																		      });
																		    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname'];  echo '\').elrte(opts);
													})
													'; ?>

													</script>
													<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

												<?php else: ?>
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditor = new FCKeditor( '<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
' ) ;
													oFCKeditor.BasePath	= sBasePath ;
													oFCKeditor.Height	= 500 ;
													oFCKeditor.Create() ;
													</script>									
												<?php endif; ?>
											<?php else: ?>
											<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

											<?php endif; ?>
											
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
												<script>
												<?php echo '
												function toggleCalendar(elem_name)
												{
													window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
												}
												'; ?>

												</script>
												<?php endif; ?>
			
												<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
												<script>
												<?php echo '
												function BackFileForm(thisField)
												{
													'; ?>

													document.getElementById(thisField).innerHTML = "<?php echo $this->_tpl_vars['DirSelBoxA']; ?>
<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog('"+thisField+"');>";
													<?php echo '
												}

												function dialog(thisField)
												{
													result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
													if (result == null)
													return;
													var ElementCurrHTML = document.getElementById(thisField).innerHTML;
													document.getElementById(thisField).innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm(\'"+thisField+"\');>";
												}
												'; ?>

												</script>
											<?php endif; ?>
											</td>
									<?php else: ?>
										<?php if ($this->_tpl_vars['Field']['addoptions'] == 'setUser'): ?>
										<?php echo $this->_tpl_vars['Field']['name_e']; ?>
: 
										<?php endif; ?>
										<?php if ($this->_tpl_vars['TheField']['coupleoptions'] == ""): ?>
										<?php echo $this->_tpl_vars['TheField']['key']; ?>

										<?php endif; ?>
									<?php endif; ?>	
									<?php endforeach; unset($_from); endif; ?>	
									<td align="right"><br><input type="submit" name="SaveContent" value="Save"><!--<input type="image" src="images/button1.gif">--></td>
									</tr>
							<?php else: ?>
									<?php $this->assign('DoubleNum', 0); ?>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
										<?php if ($this->_tpl_vars['Field']['InputType'] != 'hidden'): ?>
											<?php if ($this->_tpl_vars['Field']['id'] != $this->_tpl_vars['DoubleNum']): ?>
												<tr>
													<td class="fComments" height="40">
													<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:	
													</td>
													<td>
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'html'): ?>
														<?php if ($this->_tpl_vars['Field']['addoptions'] == 'HTMLArea'): ?>
														<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

															<script src='tools/htmlarea/editor.js'></script>
															<script>
															_editor_url = "tools/htmlarea/";
															</script>
															<script language="javascript1.2">
															var config = new Object();    // create new config object
															config.width = "100%";
															config.height = "<?php echo $this->_tpl_vars['Field']['height']; ?>
px";
															config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
															config.debug = 0;
															editor_generate('<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
', config);
															</script>
														<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
															<script type="text/javascript" charset="utf-8">
															<?php echo '
															     $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															               fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
            													$(\'#';  echo $this->_tpl_vars['Field']['fieldname'];  echo '\').elrte(opts);
															})
															'; ?>

															</script>	
															<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

														<?php else: ?>
															<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
															<script type="text/javascript">
															var sBasePath = 'fckeditor/' ;

															var oFCKeditor = new FCKeditor( '<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
' ) ;
															oFCKeditor.BasePath	= sBasePath ;
															oFCKeditor.Height	= 500 ;
															oFCKeditor.Create() ;
															</script>												
														<?php endif; ?>									
													<?php else: ?>
													<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

													<?php endif; ?>
		
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
													<script>
													<?php echo '
													function toggleCalendar(elem_name)
													{
														window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
													}
													'; ?>

													</script>
													<?php endif; ?>
				
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
													<script>
													<?php echo '
													function BackFileForm(thisField)
													{
														'; ?>

														document.getElementById(thisField).innerHTML = "<?php echo $this->_tpl_vars['DirSelBoxA']; ?>
<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog('"+thisField+"');>";
														<?php echo '
													}

													function dialog(thisField)
													{
														result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
														if (result == null)
														return;
														var ElementCurrHTML = document.getElementById(thisField).innerHTML;
														document.getElementById(thisField).innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm(\'"+thisField+"\');>";
													}
													'; ?>

													</script>
													<?php endif; ?>
													</td>
													<?php if ($this->_tpl_vars['Field']['doubleoptions'] != ''): ?>
														<?php $this->assign('NextId', $this->_tpl_vars['key']+1); ?>
														<?php $this->assign('NextRowVal', $this->_tpl_vars['Fields'][$this->_tpl_vars['NextId']]); ?>
														<?php if ($this->_tpl_vars['Field']['doubleoptions'] == $this->_tpl_vars['NextRowVal']['doubleoptions']): ?>
														<?php $this->assign('DoubleNum', $this->_tpl_vars['NextRowVal']['id']); ?>
														<td align="right">
															<?php if ($this->_tpl_vars['NextRowVal']['InputType'] == 'html'): ?>
																<?php if ($this->_tpl_vars['NextRowVal']['addoptions'] == 'HTMLArea'): ?>
																<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

																	<script src='tools/htmlarea/editor.js'></script>
																	<script>
																	_editor_url = "tools/htmlarea/";
																	</script>
																	<script language="javascript1.2">
																	var config = new Object();    // create new config object
																	config.width = "100%";
																	config.height = "<?php echo $this->_tpl_vars['NextRowVal']['height']; ?>
px";
																	config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
																	config.debug = 0;
																	editor_generate('<?php echo $this->_tpl_vars['NextRowVal']['fieldname']; ?>
', config);
																	</script>
																<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															             fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname'];  echo '\').elrte(opts);
													})
													'; ?>

													</script>
													<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

																<?php else: ?>															
																	<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
																	<script type="text/javascript">
																	var sBasePath = 'fckeditor/' ;

																	var oFCKeditor = new FCKeditor( '<?php echo $this->_tpl_vars['NextRowVal']['fieldname']; ?>
' ) ;
																	oFCKeditor.BasePath	= sBasePath ;
																	oFCKeditor.Height	= 500 ;
																	oFCKeditor.Value	= '' ;
																	oFCKeditor.Create() ;
																	</script>											
																<?php endif; ?>
															<?php else: ?>
															<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['NextId']]; ?>

															<?php endif; ?>
				
															<?php if ($this->_tpl_vars['NextRowVal']['InputType'] == 'date'): ?>
															<script>
															<?php echo '
															function toggleCalendar(elem_name)
															{
																window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
															}
															'; ?>

															</script>
															<?php endif; ?>
						
															<?php if ($this->_tpl_vars['NextRowVal']['InputType'] == 'file'): ?>
															<script>
															<?php echo '
															function BackFileForm(thisField)
															{
																'; ?>

																document.getElementById(thisField).innerHTML = "<?php echo $this->_tpl_vars['DirSelBoxA']; ?>
<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog('"+thisField+"');>";
																<?php echo '
															}

															function dialog(thisField)
															{
																result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
																if (result == null)
																return;
																var ElementCurrHTML = document.getElementById(thisField).innerHTML;
																document.getElementById(thisField).innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm(\'"+thisField+"\');>";
															}
															'; ?>

															</script>
															<?php endif; ?>
															</td>	
															<td class="fComments" height="40" align="right">
															:<?php echo $this->_tpl_vars['NextRowVal']['name_e']; ?>
	
															</td>
																														
														<?php endif; ?>
													<?php endif; ?>
												</tr>
											<?php endif; ?>
										<?php else: ?>
											<?php if ($this->_tpl_vars['Field']['addoptions'] == 'setUser'): ?>
													<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

											<?php else: ?>
												<?php echo $this->_tpl_vars['TheField'][$this->_tpl_vars['key']]; ?>

											<?php endif; ?>
										<?php endif; ?>	
										<?php if ($this->_tpl_vars['Field']['InputType'] != 'hidden'): ?>
										<tr>
											<td height="1" colspan="4" bgcolor="C7F482"></td>
										</tr>
										<?php endif; ?>
								<?php endforeach; unset($_from); endif; ?>	
								<tr>
									<td height="60" align="center" colspan="4"><input type="hidden" name="SaveContent" value="Save"><input type="image" src="images/button1.gif"></td>
								</tr>
							<?php endif; ?>
							</table>
							</fieldset>
							</form>
						</td>
						</tr>
						</table>
						
						<table id="TabContent3" width="100%">
						<tr>
						<td>
						<span id="WaitEditSpan"></span>
							<BR>
							<form action="formbuilder.php?mid=<?php echo $_GET['mid'];  echo $this->_tpl_vars['addUrl'];  echo $this->_tpl_vars['addUrlForm']; ?>
" method="POST" name="FormEdit" id="PutOn" enctype="multipart/form-data">
							<fieldset class="edit">
							<legend><span id="FieldLegendE<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['Lang']['EDIT']; ?>
</span></legend>
							<DIV class="EditPlace">
							<input type="hidden" id="DynamicFormName">
							<div id="DynamicFormContent" style="display:none"></div>

							<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
							<?php if ($this->_tpl_vars['Section']['BuildType'] == 1): ?>
										<tr>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
											<td class="fComments" height="60">
											<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:<br>
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'html'): ?>
												<?php if ($this->_tpl_vars['Field']['addoptions'] == 'HTMLArea'): ?>
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "<?php echo $this->_tpl_vars['Field']['height']; ?>
px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
e', config);
													</script>
												<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															              fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname']; ?>
e<?php echo '\').elrte(opts);
													})
													'; ?>

													</script>	
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

												<?php else: ?>
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditorE = new FCKeditor( '<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
e' ) ;
													oFCKeditorE.BasePath	= sBasePath ;
													oFCKeditorE.Height	= 500 ;
													oFCKeditorE.Create() ;
													</script>														
												<?php endif; ?>
											<?php else: ?>
												<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

											<?php endif; ?>
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
											<script>
											<?php echo '
											function toggleCalendar(elem_name)
											{
												window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
											}
											'; ?>

											</script>
											<?php endif; ?>
		
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
											<script>
											<?php echo '
											function BackFileForm(thisField)
											{
												'; ?>

												document.getElementById(thisField).innerHTML = "<select name='"+thisField+"ed' class=free><?php echo $this->_tpl_vars['DirSelBoxU']; ?>
<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog('"+thisField+"');>";
												<?php echo '
											}

											function dialog(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField).innerHTML;
												document.getElementById(thisField).innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm(\'"+thisField+"\');>";
											}
											'; ?>

											</script>
											<?php endif; ?>
											</td>
									<?php endforeach; unset($_from); endif; ?>	
									<td align="right"><br><input type="hidden" name="SaveContent" value="Update"><input type="image" src="images/button2.gif"></td>
									</tr>
							<?php else: ?>
									<?php $this->assign('DoubleNum', 0); ?>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
										<?php if ($this->_tpl_vars['Field']['InputType'] != 'hidden'): ?>
											<?php if ($this->_tpl_vars['Field']['id'] != $this->_tpl_vars['DoubleNum']): ?>
												<tr>
													<td class="fComments" height="40">
													<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:	
													</td>
													<td>
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'html'): ?>
														<?php if ($this->_tpl_vars['Field']['addoptions'] == 'HTMLArea'): ?>
														<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

														<script src='tools/htmlarea/editor.js'></script>
														<script>
														_editor_url = "tools/htmlarea/";
														</script>
														<script language="javascript1.2">
														var config = new Object();    // create new config object
														config.width = "100%";
														config.height = "<?php echo $this->_tpl_vars['Field']['height']; ?>
px";
														config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
														config.debug = 0;
														editor_generate('<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
e', config);
														</script>
													<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															               fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname']; ?>
e<?php echo '\').elrte(opts);
													})
													'; ?>

													</script>	
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

													<?php else: ?>
														<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
														<script type="text/javascript">
														var sBasePath = 'fckeditor/' ;

														var oFCKeditorE = new FCKeditor( '<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
e' ) ;
														oFCKeditorE.BasePath	= sBasePath ;
														oFCKeditorE.Height	= 500 ;
														oFCKeditorE.Create() ;
														</script>														
													<?php endif; ?>									
													<?php else: ?>
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

													<?php endif; ?>
		
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
													<script>
													<?php echo '
													function toggleCalendar(elem_name)
													{
														window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
													}
													'; ?>

													</script>
													<?php endif; ?>
							
													<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
														
														
														<script>
														<?php echo '
														function BackFileForm1(thisField)
														{
															'; ?>

															document.getElementById(thisField+'e').innerHTML = "<select name='"+thisField+"ed' class=free><?php echo $this->_tpl_vars['DirSelBoxU']; ?>
<br><input type='file' name='"+thisField+"' id='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=ChooseFile('"+thisField+"','e');>";
															<?php echo '
														}


														function dialog1(thisField)
														{
															result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+\'e\', "resizable: no; help: no; status: no; scroll: no; ");
															if (result == null)
															return;
															var ElementCurrHTML = document.getElementById(thisField+\'e\').innerHTML;
															document.getElementById(thisField+\'e\').innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm1(\'"+thisField+"\');>";
														}
														'; ?>

														</script>
													<?php endif; ?>
													</td>
													<?php if ($this->_tpl_vars['Field']['doubleoptions'] != ''): ?>
														<?php $this->assign('NextId', $this->_tpl_vars['key']+1); ?>
														<?php $this->assign('NextRowVal', $this->_tpl_vars['Fields'][$this->_tpl_vars['NextId']]); ?>
														<?php if ($this->_tpl_vars['Field']['doubleoptions'] == $this->_tpl_vars['NextRowVal']['doubleoptions']): ?>
														<?php $this->assign('DoubleNum', $this->_tpl_vars['NextRowVal']['id']); ?>
														<td align="right">
															<?php if ($this->_tpl_vars['NextRowVal']['InputType'] == 'html'): ?>
																<?php if ($this->_tpl_vars['NextRowVal']['addoptions'] == 'HTMLArea'): ?>
																<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

																<script src='tools/htmlarea/editor.js'></script>
																<script>
																_editor_url = "tools/htmlarea/";
																</script>
																<script language="javascript1.2">
																var config = new Object();    // create new config object
																config.width = "100%";
																config.height = "<?php echo $this->_tpl_vars['NextRowVal']['height']; ?>
px";
																config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
																config.debug = 0;
																editor_generate('<?php echo $this->_tpl_vars['NextRowVal']['fieldname']; ?>
e', config);
																</script>
															<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															               fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname']; ?>
e<?php echo '\').elrte(opts);
													})
													'; ?>

													</script>	
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

															<?php else: ?>
																<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
																<script type="text/javascript">
																var sBasePath = 'fckeditor/' ;

																var oFCKeditor = new FCKeditor( '<?php echo $this->_tpl_vars['NextRowVal']['fieldname']; ?>
e' ) ;
																oFCKeditor.BasePath	= sBasePath ;
																oFCKeditor.Height	= 500 ;
																oFCKeditor.Value	= '' ;
																oFCKeditor.Create() ;
																</script>		
															<?php endif; ?>										
															<?php else: ?>
															<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['NextId']]; ?>

															<?php endif; ?>
				
															<?php if ($this->_tpl_vars['NextRowVal']['InputType'] == 'date'): ?>
															<script>
															<?php echo '
															function toggleCalendar(elem_name)
															{
																window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
															}
															'; ?>

															</script>
															<?php endif; ?>
						
															<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
																<script>
																<?php echo '
																function BackFileForm1(thisField)
																{
																	'; ?>

																	document.getElementById(thisField+'e').innerHTML = "<select name='"+thisField+"ed' class=free><?php echo $this->_tpl_vars['DirSelBoxU']; ?>
<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog1('"+thisField+"');>";
																	<?php echo '
																}


																function dialog1(thisField)
																{
																	result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+\'e\', "resizable: no; help: no; status: no; scroll: no; ");
																	if (result == null)
																	return;
																	var ElementCurrHTML = document.getElementById(thisField+\'e\').innerHTML;
																	document.getElementById(thisField+\'e\').innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm1(\'"+thisField+"\');>";
																}
																'; ?>

																</script>
															<?php endif; ?>
															</td>	
															<td class="fComments" height="40" align="right">
															:<?php echo $this->_tpl_vars['NextRowVal']['name_e']; ?>
	
															</td>
																														
														<?php endif; ?>
													<?php endif; ?>
												</tr>
											<?php endif; ?>
										<?php else: ?>
											<?php if ($this->_tpl_vars['Field']['addoptions'] == 'setUser'): ?>
													<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

											<?php else: ?>
												<?php echo $this->_tpl_vars['TheFielde'][$this->_tpl_vars['key']]; ?>

											<?php endif; ?>
										<?php endif; ?>	
										<?php if ($this->_tpl_vars['Field']['InputType'] != 'hidden'): ?>
										<tr>
											<td height="1" colspan="4" bgcolor="C7F482"></td>
										</tr>
										<?php endif; ?>
								<?php endforeach; unset($_from); endif; ?>	
								<tr>
									<td height="60" align="center" colspan="4"><input type="hidden" name="SaveContent" value="Update"><input type="image" src="images/button2.gif"></td>
								</tr>
							<?php endif; ?>
							</table>
							</DIV>
							</fieldset>
							</form>
						</td>
						</tr>
						</table>
						
						<table id="TabContent4" width="100%">
						<tr>
						<td>
							<BR>
							<form action="formbuilder.php?mid=<?php echo $_GET['mid'];  echo $this->_tpl_vars['addUrl'];  echo $this->_tpl_vars['addUrlForm']; ?>
" method="POST" name="FormDel" id="PutOn" enctype="multipart/form-data">
							<fieldset class="del">
							<legend><span id="FieldLegendD<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['Lang']['DELETE']; ?>
</span></legend>
							<DIV class="DelPlace" align="center">
							<span id="DelSpan"><div class="BigTitle">Вы действительно хотите удалить данную запись?</div></span><br>
							<table cellpadding="0" cellspacing="0" border="0" width="80%" align="center">
							<?php if ($this->_tpl_vars['Section']['BuildType'] == 1): ?>
										<tr>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
											<td class="fComments" height="60">
											<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:<br>
											<?php echo $this->_tpl_vars['TheFieldd'][$this->_tpl_vars['key']]; ?>

											<?php if ($this->_tpl_vars['Field']['InputType'] == 'html'): ?>
												<?php if ($this->_tpl_vars['Field']['addoptions'] == 'HTMLArea'): ?>
													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "<?php echo $this->_tpl_vars['Field']['height']; ?>
px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
d', config);
													</script>
												<?php elseif ($this->_tpl_vars['Field']['addoptions'] == 'elRTE'): ?>
													<script type="text/javascript" charset="utf-8">
													<?php echo '
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : \'el-rte\',
															                lang     : \'ru\',
															                height   : ';  echo $this->_tpl_vars['Field']['height'];  echo ',
															                toolbar  : \'maxi\',
															                cssfiles : [\'elrte/css/elrte-inner.css\'],                
															               fmOpen : function(callback) {
													      $(\'<div/>\').dialogelfinder({
													        url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
													        // lang: \'ru\', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: \'destroy\' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$(\'#';  echo $this->_tpl_vars['Field']['fieldname']; ?>
d<?php echo '\').elrte(opts);
													})
													'; ?>

													</script>	
													<?php echo $this->_tpl_vars['TheFieldd'][$this->_tpl_vars['key']]; ?>

												<?php else: ?>
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditorD = new FCKeditor( '<?php echo $this->_tpl_vars['Field']['fieldname']; ?>
d' ) ;
													oFCKeditorD.BasePath	= sBasePath ;
													oFCKeditorD.Height	= 500 ;
													oFCKeditorD.Value	= '' ;
													oFCKeditorD.Create() ;
													</script>														
												<?php endif; ?>
											<?php endif; ?>
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
											<script>
											<?php echo '
											function toggleCalendar(elem_name)
											{
												window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
											}
											'; ?>

											</script>
											<?php endif; ?>
		
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
											<script>
											<?php echo '
											function BackFileForm2(thisField)
											{
												'; ?>

												document.getElementById(thisField+'d').innerHTML = "<input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog2('"+thisField+"');>";
												<?php echo '
											}


											function dialog2(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+\'e\', "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField+\'e\').innerHTML;
												document.getElementById(thisField+\'d\').innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm2(\'"+thisField+"\');>";
											}
											'; ?>

											</script>
											<?php endif; ?>
											</td>
									<?php endforeach; unset($_from); endif; ?>	
									<td align="right"><br><input type="hidden" name="SaveContent" value="Delete"><input type="image" src="images/button3.gif"></td>
									</tr>
							<?php else: ?>
									<?php if (count($_from = (array)$this->_tpl_vars['Fields'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['Field']):
?>
										<?php if ($this->_tpl_vars['Field']['InputType'] == 'hidden'): ?>
										<?php echo $this->_tpl_vars['TheFieldd'][$this->_tpl_vars['key']]; ?>

										<?php else: ?>
										<tr>
											<td class="fComments" height="40">
											<?php echo $this->_tpl_vars['Field']['name_e']; ?>
:	
											</td>
											<td>
											<?php echo $this->_tpl_vars['TheFieldd'][$this->_tpl_vars['key']]; ?>

											<?php if ($this->_tpl_vars['Field']['InputType'] == 'date'): ?>
											<script>
											<?php echo '
											function toggleCalendar(elem_name)
											{
												window.open(\'templates/calendar.html?c=\'+elem_name,\'cal\',\'height=220,width=190\');
											}
											'; ?>

											</script>
											<?php endif; ?>
		
											<?php if ($this->_tpl_vars['Field']['InputType'] == 'file'): ?>
											<script>
											<?php echo '
											function BackFileForm2(thisField)
											{
												'; ?>

												document.getElementById(thisField+'d').innerHTML = "<input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='<?php echo $this->_tpl_vars['Lang']['CHOOSE_PIC']; ?>
' type=button onclick=dialog2('"+thisField+"');>";
												<?php echo '
											}


											function dialog2(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+\'e\', "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField+\'e\').innerHTML;
												document.getElementById(thisField+\'d\').innerHTML = "<img src=\'pictures/"+result+"\' border=0><br><input type=text name=\'"+thisField+"\' value=\'"+result+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm2(\'"+thisField+"\');>";
											}
											'; ?>

											</script>
											<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td height="1" colspan="2" bgcolor="C7F482"></td>
										</tr>
										<?php endif; ?>
									<?php endforeach; unset($_from); endif; ?>	
								<tr>
									<td height="60" align="center" colspan="2"><input type="hidden" name="SaveContent" value="Delete"><input type="image" src="images/button3.gif"></td>
								</tr>
							<?php endif; ?>
							</table>
							</DIV>
							</fieldset>
							</form>
						</td>
						</tr>
						</table>
					<script language="javascript">
					TabRightSwitch4(1);
					<?php echo $this->_tpl_vars['JavaSetValues']; ?>

					//ChangeLangs('LangEdit', document.forms['frmEdit'].elements['ltableEdit'].selectedIndex);
					<?php echo '
					function ChooseFile(id,type)
							 {
							 $(\'<div/>\').dialogelfinder({
																										 url : \'elfinder/php/connector.php\', // connector URL (REQUIRED)
																										 // lang: \'ru\', // elFinder language (OPTIONAL)
																										 commandsOptions: {
																											 getfile: {
																												 oncomplete: \'destroy\' // destroy elFinder after file selection
																											 }
																										 },
																										 getFileCallback: function(url) {
																										 var thisUrl = url.replace("pictures/", "");
																										 document.getElementById(id+type).innerHTML = "<img src=\'pictures/"+thisUrl+"\' border=0 style=\'maxlength:400px !important;\'><br><input type=text name=\'"+id+"\' value=\'"+thisUrl+"\' class=flatFields><input type=\'button\' value=\'Cancel\' onclick=BackFileForm1(\'"+id+"\');>";
																											 
																											 //$("#"+id).val(url.replace("pictures/", ""));
																				 //document.getElementById("sfilename").value = url;
																		 } // pass callback to editor
																									 });
							 }					
					'; ?>

					</script>	
					</td>
				</tr>
			</table>
		</tr>
		</table>
	<?php endif; ?>
<?php echo $this->_tpl_vars['bottom']; ?>