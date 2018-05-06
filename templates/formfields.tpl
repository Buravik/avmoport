{$base}
	<script for=window event=onbeforeunload>
	document.body.innerHTML="<table width=100% height=100%><tr><td align=center><h4>Ожидайте ответа системы...</h4></td></tr></table>";
	</script>
<script>
var xmlHTTP = createXMLHttp();
var spWait = '{$PLEASE_WAIT}';
var spAdding = '{$ADDING}';
var spEditing = '{$EDITING}';
var spDeleting = '{$DELETING}';
var optSection = '{$SECTION}';
{literal}
function GetAjaxInfo(MenuID)
{
	spAdd.innerHTML = spWait;
	var url = "get_ajax_info.php?case=forms&menu_id="+MenuID;
	MakeHttpRequiest(url);
}
function MakeHttpRequiest(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = Process;
	xmlHTTP.send(null);
}
function Process()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
			//document.forms['add_card_frm'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = 'none';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "/";
			var newArray = nameList.split(regexp);
			document.getElementById("parentId").value = newArray[1];
			//document.forms['frmAdd'].elements['ltable'].value = newArray[3];
			//ChangeLangs('Lang', document.forms['frmAdd'].elements['ltable'].selectedIndex);

			newOpt = new Option();
			newOpt.value = 1;
			newOpt.text = optSection + ' (' + newArray[4] + ')';
			var abox = document.forms['frmAdd'].elements['parented'];
			abox.options[1] = null;
			abox.options[1] = newOpt;
			abox.options[1].selected = true;

			document.getElementById("name1").value = '';
			document.getElementById("name2").value = '';
			document.getElementById("name3").value = '';
			spAdd.innerHTML = spAdding;
			document.getElementById("name1").focus();
		}
	}
}

function GetAjaxInfoEdit(MenuID)
{
	spEdit.innerHTML = spWait;
	var url = "get_ajax_info.php?case=forms&menu_id="+MenuID;
	MakeHttpRequiestEdit(url);
}
function MakeHttpRequiestEdit(url)
{
	xmlHTTP.open("GET", url, true);
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
			//document.forms['add_card_frm'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = 'none';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "/";
			var newArray = nameList.split(regexp);
			document.getElementById("subjIdr").value = newArray[1];
			document.getElementById("parentIdr").value = newArray[2];
			//document.forms['frmEdit'].elements['ltableEdit'].value = newArray[3];
			//ChangeLangs('LangEdit', document.forms['frmEdit'].elements['ltableEdit'].selectedIndex);

			document.getElementById("name1r").value = newArray[3];
			document.getElementById("name2r").value = newArray[4];
			document.getElementById("name3r").value = newArray[5];
			document.getElementById("tablenamer").value = newArray[6];
			document.getElementById("ordr").value = newArray[7];
			spEdit.innerHTML = spEditing;
			document.getElementById("name1r").focus();
		}
	}
}

function GetAjaxForm()
{
	var TheNumber = new Number(document.getElementById("FieldCount").value);
	var FieldNumber = TheNumber + 1;

	var resp = "<div id=DivId"+FieldNumber+"><br><fieldset><legend><span id=FieldLegend"+FieldNumber+">Поля "+FieldNumber+"</span></legend><br><table cellpadding=0 cellspacing=0 border=0 width=98% align=center><tr>";
	resp += "<td nowrap valign=top>";
	resp += "<table cellpadding=0 cellspacing=0 border=0>";
	resp += "<tr><td class=fComments>Наименование:&nbsp;</td><td><input type=text name=name_e[] id=NameE"+FieldNumber+" class=flatFields onchange=ChangeLegend('FieldLegend"+FieldNumber+"','NameE"+FieldNumber+"',"+FieldNumber+")></td></tr>";
	resp += "<tr><td class=fComments>Комментарий:&nbsp;</td><td><input type=text name=comment_e[] class=flatFields></td></tr>";
	resp += "<tr><td class=fComments>SQL поля:&nbsp;</td><td><input type=text name=fieldname[] class=flatFields></td></tr>";
	resp += "</table>";
	resp += "</td>";
	resp += "<td valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%>";
	resp += "<tr><td class=fComments height=25>Тип поля:&nbsp;</td><td class=fComments>{/literal}{foreach from=$FieldTypes key=key item=TheRow}<img src=images/fields/{$TheRow}.gif alt={$TheRow} id=TypePic_"+FieldNumber+"{$TheRow} style=cursor:hand;  onclick=ChangeInputType('InputType"+FieldNumber+"','{$TheRow}',"+FieldNumber+")>&nbsp;{/foreach}{literal}<input type=hidden value='' name=InputType[] id=InputType"+FieldNumber+"></td></tr>";
	resp += "<tr><td class=fComments height=25>Размеры:</td><td class=fComments><table cellpadding=0 cellspacing=0 border=0><tr>";
	resp += "<td>Width:</td><td><input type=text name=width[] id=width"+FieldNumber+" value='300' size=3 class=flatFields></td><td width=20>";
	resp += "<td>Height:</td><td><input type=text name=height[] id=height"+FieldNumber+" value='' size=3 class=flatFields></td><td width=20>";
	resp += "<td class=fComments>Приоритет:</td><td><input type=checkbox value=1 name=priority[] class=flatFields></td>";
	resp += "</table></td></tr>";
	resp += "<tr><td class=fComments height=25 valign=top>Таблица:</td><td class=fComments><table cellpadding=0 cellspacing=0 border=0>";
	resp += "<tr><td><select name=stable[] id=stable"+FieldNumber+" class=free onchange=GetAjaxIdValue("+FieldNumber+");><option value=>Выберите</option>{/literal}{foreach from=$TableList item=TheTable}<option value={$TheTable.$TablesInBase}>{$TheTable.$TablesInBase}</option>{/foreach}{literal}</select><br><span id=idValue1SelBox"+FieldNumber+"></span></td></tr>";
	resp += "</table></td>";
	resp += "</tr></table>";
	resp += "<td valign=top><table cellpadding=0 cellspacing=0 border=0 width=100%>";
	resp += "<tr><td class=fComments>SQL поля:&nbsp;</td><td class=fComments><select name=sqltype[] id=sqltype"+FieldNumber+" class=free><option value=>Выберите</option>{/literal}{foreach from=$SQLTypes item=TheType}<option value={$TheType}>{$TheType}</option>{/foreach}{literal}</select></td><td><input type=text name=sqllen[] id=sqllen"+FieldNumber+" size=1 class=flatFields></td></tr>";
	resp += "<tr><td class=fComments>Доп. опц:&nbsp;</td><td class=fComments><select name=addoptions[] id=addoptions"+FieldNumber+" class=free><option value=>Выберите</option>{/literal}{foreach from=$AddOptions item=TheType}<option value={$TheType}>{$TheType}</option>{/foreach}{literal}</select></td></tr>";
	resp += "<tr><td class=fComments>Сортировка:&nbsp;</td><td class=fComments><select name=sortoptions[] id=sortoptions"+FieldNumber+" class=free><option value=>Выберите</option>{/literal}{foreach from=$SortOptions item=TheType}<option value={$TheType}>{$TheType}</option>{/foreach}{literal}</select></td></tr>";
	resp += "<tr><td class=fComments>Список:&nbsp;</td><td class=fComments><input value=1 type=checkbox name=ListMember[] id=ListMember"+FieldNumber+"></td></tr>";
	resp += "</table></td>";
	resp += "</tr></table></td></tr>";
	resp += "</tr></table><div align=right><img src=images/del.gif vspace=2 hspace=2 onclick=DelAjaxForm("+FieldNumber+");></div></fieldset></div>";
	document.getElementById("AddForm").innerHTML += resp;
	document.getElementById("FieldCount").value = FieldNumber;
}

function DelAjaxForm(id)
{
	if(el=document.getElementById("DivId"+id))
	{
		el.outerHTML = "";
	}
}

function DelAjaxFormE(id)
{
	if(el=document.getElementById("DivIdE"+id))
	{
		var theEl = el.innerHTML.replace(/edit/,"del");
		var Chaged1 = theEl.replace(/onclick=DelAjaxFormE/,"style='display: none;'  onclick=DelAjaxFormE");
		var Chaged2 = Chaged1.replace(/<select/,"<select disabled");
		var Chaged3 = Chaged2.replace(/<input/,"<input disabled");
		document.getElementById("DelSpan").innerHTML = Chaged3;
		document.getElementById("btndel").style.display = 'inline';
	}
}

function BackToEdit()
{
	document.getElementById("DelSpan").innerHTML = "<div class='BigTitle'>Не выбрано поля для удаления</div>";
	document.getElementById("btndel").style.display = 'none';
	TabRightSwitch4(3);
}

function subjDelete(subjName, subjId)
{
	document.getElementById("subjIdd").value = subjId;
	spDelete.innerHTML = spDeleting + ' - <font color="Red">' + subjName + '</font>';
}
function ChangeLegend(id,name,num)
{
	document.getElementById(id).innerHTML = "Поля "+num+" <font color=blue>("+document.getElementById(name).value+")</font>";
}

function ChangeLegendE(id,name,num)
{
	document.getElementById(id).innerHTML = "Поля "+num+" <font color=blue>("+document.getElementById(name).value+")</font>";
}
function ChangeInputType(id,type,num)
{
	var ThisType = document.getElementById(id).value;
	if (ThisType != "")
	{
		document.getElementById('TypePic_'+num+ThisType).src = "images/fields/"+ThisType+".gif";
	}
	document.getElementById('TypePic_'+num+type).src = "images/fields/"+type+"_sel.gif";
	document.getElementById(id).value = type;

	if (type == "text")
	{
		document.getElementById('sqltype'+num).value = "VARCHAR";
		document.getElementById('sqllen'+num).value = "50";
		document.getElementById('width'+num).value = "300";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "file")
	{
		document.getElementById('sqltype'+num).value = "VARCHAR";
		document.getElementById('sqllen'+num).value = "50";
		document.getElementById('width'+num).value = "250";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "password")
	{
		document.getElementById('sqltype'+num).value = "VARCHAR";
		document.getElementById('sqllen'+num).value = "50";
		document.getElementById('width'+num).value = "300";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "textarea")
	{
		document.getElementById('sqltype'+num).value = "TINYTEXT";
		document.getElementById('sqllen'+num).value = "";
		document.getElementById('width'+num).value = "300";
		document.getElementById('height'+num).value = "5";
	}
	else if (type == "html")
	{
		document.getElementById('sqltype'+num).value = "TEXT";
		document.getElementById('sqllen'+num).value = "";
		document.getElementById('width'+num).value = "600";
		document.getElementById('height'+num).value = "6";
	}
	else if (type == "select")
	{
		document.getElementById('sqltype'+num).value = "INTEGER";
		document.getElementById('sqllen'+num).value = "4";
		document.getElementById('width'+num).value = "300";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "hidden")
	{
		document.getElementById('sqltype'+num).value = "INTEGER";
		document.getElementById('sqllen'+num).value = "4";
		document.getElementById('width'+num).value = "";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "date")
	{
		document.getElementById('sqltype'+num).value = "DATE";
		document.getElementById('sqllen'+num).value = "";
		document.getElementById('width'+num).value = "100";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "radio")
	{
		document.getElementById('sqltype'+num).value = "INTEGER";
		document.getElementById('sqllen'+num).value = "2";
		document.getElementById('width'+num).value = "";
		document.getElementById('height'+num).value = "";
	}
	else if (type == "checkbox")
	{
		document.getElementById('sqltype'+num).value = "INTEGER";
		document.getElementById('sqllen'+num).value = "2";
		document.getElementById('width'+num).value = "";
		document.getElementById('height'+num).value = "";
	}
	else
	{
		document.getElementById('sqltype'+num).value = "";
		document.getElementById('sqllen'+num).value = "";
		document.getElementById('width'+num).value = "";
		document.getElementById('height'+num).value = "";
	}
}

function ChangeInputTypeE(id,type,num)
{
	var ThisType = document.getElementById(id).value;
	if (ThisType != "")
	{
		document.getElementById('TypePic_E'+num+ThisType).src = "images/fields/"+ThisType+".gif";
	}
	document.getElementById('TypePic_E'+num+type).src = "images/fields/"+type+"_sel.gif";
	document.getElementById(id).value = type;

	if (type == "text")
	{
		document.getElementById('sqltypeE'+num).value = "VARCHAR";
		document.getElementById('sqllenE'+num).value = "50";
		document.getElementById('widthE'+num).value = "300";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "file")
	{
		document.getElementById('sqltypeE'+num).value = "VARCHAR";
		document.getElementById('sqllenE'+num).value = "50";
		document.getElementById('widthE'+num).value = "250";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "password")
	{
		document.getElementById('sqltypeE'+num).value = "VARCHAR";
		document.getElementById('sqllenE'+num).value = "50";
		document.getElementById('widthE'+num).value = "300";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "textarea")
	{
		document.getElementById('sqltypeE'+num).value = "TINYTEXT";
		document.getElementById('sqllenE'+num).value = "";
		document.getElementById('widthE'+num).value = "300";
		document.getElementById('heightE'+num).value = "5";
	}
	else if (type == "html")
	{
		document.getElementById('sqltypeE'+num).value = "TEXT";
		document.getElementById('sqllenE'+num).value = "";
		document.getElementById('widthE'+num).value = "600";
		document.getElementById('heightE'+num).value = "6";
	}
	else if (type == "select")
	{
		document.getElementById('sqltypeE'+num).value = "INTEGER";
		document.getElementById('sqllenE'+num).value = "4";
		document.getElementById('widthE'+num).value = "300";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "hidden")
	{
		document.getElementById('sqltypeE'+num).value = "INTEGER";
		document.getElementById('sqllenE'+num).value = "4";
		document.getElementById('widthE'+num).value = "";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "date")
	{
		document.getElementById('sqltypeE'+num).value = "DATE";
		document.getElementById('sqllenE'+num).value = "";
		document.getElementById('widthE'+num).value = "100";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "radio")
	{
		document.getElementById('sqltypeE'+num).value = "INTEGER";
		document.getElementById('sqllenE'+num).value = "2";
		document.getElementById('widthE'+num).value = "";
		document.getElementById('heightE'+num).value = "";
	}
	else if (type == "checkbox")
	{
		document.getElementById('sqltypeE'+num).value = "INTEGER";
		document.getElementById('sqllenE'+num).value = "2";
		document.getElementById('widthE'+num).value = "";
		document.getElementById('heightE'+num).value = "";
	}
	else
	{
		document.getElementById('sqltypeE'+num).value = "";
		document.getElementById('sqllenE'+num).value = "";
		document.getElementById('widthE'+num).value = "";
		document.getElementById('heightE'+num).value = "";
	}
}

function GetAjaxIdValue(num)
{
	document.getElementById("idValue1SelBox"+num).innerHTML = "Please wait!";
	var table = document.getElementById("stable"+num).value;
	document.getElementById("SelBoxFieldsNum").value = num;
	var url = "get_ajax_page.php?case=sb_fields&table="+table;
	MakeHttpRequiestIdValue(url);
}
function GetAjaxIdValueE(num)
{
	document.getElementById("idValue1SelBoxE"+num).innerHTML = "Please wait!";
	var table = document.getElementById("stableE"+num).value;
	document.getElementById("SelBoxFieldsNumE").value = num;
	var url = "get_ajax_page.php?case=sb_fields&table="+table;
	MakeHttpRequiestIdValueE(url);
}
function MakeHttpRequiestIdValue(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = ProcessIdValue;
	xmlHTTP.send(null);
}
function MakeHttpRequiestIdValueE(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = ProcessIdValueE;
	xmlHTTP.send(null);
}
function ProcessIdValue()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if( resp == 0 )
		{
			document.getElementById("idValue1SelBox1").innerHTML = "Ощибка!";
		}
		else
		{
			var num = document.getElementById("SelBoxFieldsNum").value;
			var selectBoxes = "<table cellpadding=0 cellspacing=0 border=0>";
			selectBoxes += "<tr><td>Parent:</td><td><select class=free id=idParent"+num+" name=idParent["+num+"]><option value=''>Нет</option>"+resp+"</select></td></td>";
			selectBoxes += "<tr><td>ID:</td><td><select class=free id=idField"+num+" name=idField["+num+"]>"+resp+"</select></td></td>";
			selectBoxes += "<tr><td>Value:</td><td><select class=free id="+num+" name=idValue["+num+"]>"+resp+"</select></td></td>";
			selectBoxes += "</table>";
			document.getElementById("idValue1SelBox"+num).innerHTML = selectBoxes;
		}
	}
}
function ProcessIdValueE()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		var num = document.getElementById("SelBoxFieldsNumE").value;
		if( resp == 0 )
		{
			document.getElementById("idValue1SelBoxE"+num).innerHTML = "Ощибка!";
		}
		else
		{
			var selectBoxes = "<table cellpadding=0 cellspacing=0 border=0>";
			selectBoxes += "<tr><td>Parent:</td><td><select class=free id=idParent"+num+" name=idParent["+num+"]><option value=''>Нет</option>"+resp+"</select></td></td>";
			selectBoxes += "<tr><td>ID:</td><td><select class=free id=idField"+num+" name=idField["+num+"]>"+resp+"</select></td></td>";
			selectBoxes += "<tr><td>Value:</td><td><select class=free id="+num+" name=idValue["+num+"]>"+resp+"</select></td></td>";
			selectBoxes += "<tr><td>Order:</td><td><select class=free id="+num+" name=idOrder["+num+"]>"+resp+"</select></td></td>";
			selectBoxes += "</table>";
			document.getElementById("idValue1SelBoxE"+num).innerHTML = selectBoxes;
		}
	}
}



{/literal}
</script>
	{if $MESSAGE neq ""}
	<span id="MessageSpan">{include file="messages.tpl"}</span>
	{/if}
	
	{if $SHOWDIALOG neq 0}
		<table cellpadding="0" cellspacing="0" border="0" width="98%">
		<tr>
			<td height="1"></td>
		</tr>
		<tr>
			<td>
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="1"></td>
				{$FULLPATH}
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
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">Удалить</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">Редактировать</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">Добавить</a></p></i></i></div><em></em>
						<b><i><i><p>Просмотр</p></i></i></b>
						</div>
						
						<div class="news_sort" id="RightTabs2">
						<strong>
						
						</strong>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">Удалить</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">Редактировать</a></p></i></i></div><em></em>	
						<b><i><i><p>Добавить</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">Просмотр</a></p></i></i></div>	
						</div>
						
						<div class="news_sort" id="RightTabs3">
						<strong>
						
						</strong>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">Удалить</a></p></i></i></div><em></em>
						<b><i><i><p>Редактировать</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">Добавить</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">Просмотр</a></p></i></i></div>	
						</div>
						
						<div class="news_sort" id="RightTabs4">
						<strong>
						
						</strong>
						<b><i><i><p>Удалить</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">Редактировать</a></p></i></i></div><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(2);">Добавить</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">Просмотр</a></p></i></i></div>	
						</div>
						<!-- ) News sort -->
						
						<table id="TabContent1" width="100%">
						<tr>
						<td>
							{if $FieldList neq ""}
							<BR>
							<form action="formfields.php?form_id={$smarty.get.form_id}" method="POST" id="frmAdd">
							<div align="center"><span id="spAdd" class="formTitle">{$VIEWING}</span></div>
									
									<span id="AddFormV">	
									{foreach from=$FieldList item=ThisField key=key}
									<div id="DivIdV{$key}">  
									<fieldset class="view">
									  <legend><span id="FieldLegendv1">Поля {$key+1} <font color=blue>({$ThisField.name_e})</font></span></legend><br>
									  <table cellpadding="0" cellspacing="0" border="0" width="98%" align="center">
									  	<tr>
									  		<td nowrap valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0">
												  	<tr>
												  		<td class="fComments">
												  		Наименование:&nbsp;
												  		</td>
	  											  		<td><input type="text" readonly name="name_e[]" value="{$ThisField.name_e}" class="flatFields"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		Комментарий:&nbsp;
												  		</td>
												  		<td><input type="text" readonly name="comment_e[]" value="{$ThisField.comment_e}" id="CommentE{$key}" class="flatFields"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		SQL поля:&nbsp;
												  		</td>
												  		<td><input type="text" readonly name="fieldname[]" value="{$ThisField.fieldname}" id="FieldName{$key}" class="flatFields"></td>
												  	</tr>
									  			</table>
									  		</td>
									  		<td valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
												  	<tr>
												  		<td class="fComments" height="25">
												  		Тип поля:&nbsp;
												  		</td>
												  		<td class="fComments">
												  		{foreach from=$FieldTypes key=key item=TheRow}
												  		<img id="TypePic_{$key}{$TheRow}" alt="{$TheRow}" src="images/fields/{$TheRow}{if $ThisField.InputType eq $TheRow}_sel{/if}.gif" style="cursor:hand;">
														{/foreach}
														<input type="hidden" name="InputType[]" value="{$ThisField.InputType}" id="InputType{$key}">
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25">
													  		Размеры:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>Width:</td><td><input type="text" readonly name="width[]"  id="width{$key}" value="{$ThisField.width}" size="3" class="flatFields"></td><td width="20">
												  		<td>Height:</td><td><input type="text" readonly name="height[]" id="height{$key}" value="{$ThisField.height}" size="3" class="flatFields"></td><td width="20">
												  		<td class="fComments">Приоритет:</td><td><input type="checkbox" disabled value="1" {if $ThisField.priority eq 1}checked{/if} name="priority[]" class="flatFields"></td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25" valign="top">
													  		Таблица:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>
												  		<select name="stable[]" disabled id="stable{$key}" class="free" onchange="GetAjaxIdValue(1);">
													  		<option value="">не выбрань</option>
												  		{foreach from=$TableList item=TheTable}
															{if $ThisField.stable eq $TheTable.$TablesInBase}			  		
													  		<option value="{$TheTable.$TablesInBase}" selected>{$TheTable.$TablesInBase}</option>
													  		{/if}
												  		{/foreach}
												  		</select><br>
												  		<span id="idValue1SelBox{$key}">
												  		{if $ThisField.idField != 0}
												  			<script>
												  			GetAjaxIdValue({$key});
												  			</script>
												  		{/if}
												  		</span>
												 
												  		</td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												</table>  	
									  		</td>
									  		<td valign="top"> 
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
									  				<tr>
									  					<td class="fComments">SQL поля:&nbsp;</td>
									  					<td class="fComments">
									  					<select name="sqltype[]" disabled id="sqltype{$key}" class="free">
													  		<option value="">не выбрань</option>
												  		{foreach from=$SQLTypes item=TheType}
												  			{if $ThisField.sqltype eq $TheType}
													  		<option value="{$TheType}" selected>{$TheType}</option>
													  		{/if}
												  		{/foreach}
												  		</select>
									  					</td>
									  					<td><input type="text" readonly name="sqllen[]" id="sqllen{$key}" size="1" class="flatFields" value="{$ThisField.sqllen}"></td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Доп.:</td>
									  					<td>
									  					<select name="addoptions[]" disabled id="addoptions{$key}" class="free">
													  		<option value="">не выбрань</option>
												  		{foreach from=$AddOptions item=TheType}
													  		{if $ThisField.addoptions eq $TheType}
												  			<option value="{$TheType}" selected>{$TheType}</option>
												  			{/if}
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>	
									  				<tr>
									  					<td class="fComments">Сорт.:</td>
									  					<td>
									  					<select name="sortoptions[]" disabled id="sortoptions{$key}" class="free">
													  		<option value="">не выбрань</option>
												  		{foreach from=$SortOptions item=TheType}
													  		{if $ThisField.sortoptions eq $TheType}
												  			<option value="{$TheType}" selected>{$TheType}</option>
												  			{/if}
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Список</td>
									  					<td>
									  						<input value="1" type="checkbox" disabled name="ListMember[]" id="ListMember{$key}" {if $ThisField.ListMember eq 1}checked{/if}>
									  					</td>
									  				</tr>
									  			</table>
									  			
									  		</td>
									  	</tr>
									  </table>
									  </fieldset><br>
									  </div>
									  {/foreach}
									  </span>
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="50%"></td>
									</tr>
									</table>  
							</form>
							{/if}
						</td>
						</tr>
						</table>
						
						<table id="TabContent2" width="100%">
						<tr>
						<td>
							<BR>
							<form action="formfields.php?form_id={$smarty.get.form_id}" method="POST" id="frmAdd">
							<div align="center"><span id="spAdd" class="formTitle">{$ADDING}</span></div>
									{assign var=NFCount value=$FieldCount+1}
									<span id="AddForm">	
									<div id="DivId{$NFCount}">  
									<fieldset>
									  <legend><span id="FieldLegend{$NFCount}">Поля {$NFCount}</span></legend><br>
									  <table cellpadding="0" cellspacing="0" border="0" width="98%" align="center">
									  	<tr>
									  		<td nowrap valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0">
												  	<tr>
												  		<td class="fComments">
												  		Наименование:&nbsp;
												  		</td>
	  											  		<td><input type="text" name="name_e[]" id="NameE{$NFCount}" class="flatFields" onchange="ChangeLegend('FieldLegend{$NFCount}', 'NameE{$NFCount}',{$NFCount})"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		Комментарий:&nbsp;
												  		</td>
												  		<td><input type="text" name="comment_e[]" id="CommentE{$NFCount}" class="flatFields"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		SQL поля:&nbsp;
												  		</td>
												  		<td><input type="text" name="fieldname[]" id="FieldName{$NFCount}" class="flatFields"></td>
												  	</tr>
									  			</table>
									  		</td>
									  		<td valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
												  	<tr>
												  		<td class="fComments" height="25">
												  		Тип поля:&nbsp;
												  		</td>
												  		<td class="fComments">
												  		{foreach from=$FieldTypes key=key item=TheRow}
												  		<img id="TypePic_{$NFCount}{$TheRow}" alt="{$TheRow}" src="images/fields/{$TheRow}.gif" style="cursor:hand;" onclick="ChangeInputType('InputType{$NFCount}','{$TheRow}',{$NFCount})">
														{/foreach}
														<input type="hidden" name="InputType[]" id="InputType{$NFCount}" value="">
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25">
													  		Размеры:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>Width:</td><td><input type="text" name="width[]" id="width{$NFCount}" value="300" size="3" class="flatFields"></td><td width="20">
												  		<td>Height:</td><td><input type="text" name="height[]" id="height{$NFCount}" value="" size="3" class="flatFields"></td><td width="20">
												  		<td class="fComments">Приоритет:</td><td><input type="checkbox" value="1" name="priority[]" class="flatFields"></td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25" valign="top">
													  		Таблица:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>
												  		<select name="stable[]" id="stable{$NFCount}" class="free" onchange="GetAjaxIdValue({$NFCount});">
													  		<option value="">Выберите</option>
												  		{foreach from=$TableList item=TheTable}
													  		<option value="{$TheTable.$TablesInBase}">{$TheTable.$TablesInBase}</option>
												  		{/foreach}
												  		</select><br>
												  		<span id="idValue1SelBox{$NFCount}"></span>
												 
												  		</td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												</table>  	
									  		</td>
									  		<td valign="top"> 
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
									  				<tr>
									  					<td class="fComments">SQL поля:&nbsp;</td>
									  					<td class="fComments">
									  					<select name="sqltype[]" id="sqltype{$NFCount}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$SQLTypes item=TheType}
													  		<option value="{$TheType}">{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  					<td><input type="text" name="sqllen[]" id="sqllen{$NFCount}" size="1" class="flatFields"></td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Доп.:</td>
									  					<td>
									  					<select name="addoptions[]" id="addoptions{$NFCount}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$AddOptions item=TheType}
													  		<option value="{$TheType}">{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Сорт.:</td>
									  					<td>
									  					<select name="sortoptions[]" id="sortoptions{$NFCount}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$SortOptions item=TheType}
													  		<option value="{$TheType}">{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Список</td>
									  					<td>
									  						<input value="1" type="checkbox" name="ListMember[]" id="ListMember{$NFCount}">
									  					</td>
									  				</tr>
									  			</table>
									  			
									  		</td>
									  	</tr>
									  </table><div align="right"><img src="images/del.gif" vspace="2" hspace="2" onclick="DelAjaxForm({$NFCount});"></div>
									  </fieldset>
									  </div>
									  </span>
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="50%"></td>
									</tr>
									</table>  
									<div align="left"><img src="images/insert.gif" onclick="GetAjaxForm();">
									<input type="hidden" id="FieldCount" value="{$NFCount}">
									{if $NFCount > 1}
									<input type="hidden" name="AddToBase" value="1">
									{/if}
									<input type="hidden" id="SelBoxFieldsNum" value="0"></div>  
									<table cellpadding="5" cellspacing="5" align="center">
										
										<tr>
											<td>
											<input type="hidden" name="ActType" value="enter">
											<input type="image" name="btnsave" src="images/button1.gif"></td>
										</tr>
									</table>
							</form>
						</td>
						</tr>
						</table>
						<table id="TabContent3" width="100%">
						<tr>
						<td>
							{if $FieldList neq ""}
							<BR>
							<form action="formfields.php?form_id={$smarty.get.form_id}" method="POST" id="frmEdit">
							<div align="center"><span id="spAdd" class="formTitle">{$EDITING}</span></div>
									
									<span id="AddFormE">	
									{foreach from=$FieldList item=ThisField key=key}
									<div id="DivIdE{$key}">  
									<fieldset class="edit">
									  <legend><span id="FieldLegendE{$key}">Поля  {$key+1} <font color=blue>({$ThisField.name_e})</font></span></legend><br>
									  <table cellpadding="0" cellspacing="0" border="0" width="98%" align="center">
									  	<tr>
									  		<td nowrap valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0">
												  	<tr>
												  		<td class="fComments">
												  		Наименование:&nbsp;
												  		<input type="hidden" name="idfield[]" value="{$ThisField.id}">
												  		</td>
	  											  		<td><input type="text" name="name_e[]" id="NameEE{$key}" value="{$ThisField.name_e}" class="flatEdit" onchange="ChangeLegendE('FieldLegendE{$key}', 'NameEE{$key}',{$key})"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		Комментарий:&nbsp;
												  		</td>
												  		<td><input type="text" name="comment_e[]" value="{$ThisField.comment_e}" id="CommentEE{$key}" class="flatEdit"></td>
	  											  	</tr>	
	  											  	<tr>	
												  		<td class="fComments">
												  		SQL поля:&nbsp;
												  		</td>
												  		<td><input type="text" name="fieldname[]" value="{$ThisField.fieldname}" id="FieldNameE{$key}" class="flatEdit">
												  		<input type="hidden" name="fieldname_old[]" value="{$ThisField.fieldname}"></td>
												  	</tr>
													<tr>
									  					<td class="fComments">Дубл. поля:</td>
									  					<td>
									  					<select name="doubleoptions[]" id="doubleoptionsE{$key}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$DoubleOptions item=PareNum}
													  		<option value="{$PareNum}" {if $ThisField.doubleoptions eq $PareNum}selected{/if}>{$PareNum}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Пара поля:</td>
									  					<td>
									  					<select name="coupleoptions[]" id="coupleoptionsE{$key}" class="free">
													  		<option value="">нет</option>
												  		{foreach from=$DoubleOptions item=CoupleNum}
													  		<option value="{$CoupleNum}" {if $ThisField.coupleoptions eq $CoupleNum}selected{/if}>{$CoupleNum}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
													<!--<tr>
									  					<td class="fComments">Пара поля</td>
									  					<td>
									  					<select name="сщгздущз[]" id="ChildFieldE{$key}" class="freeLittle">
													  		<option value="0">Нет</option>
												  		{foreach from=$FieldList item=FieldsRow}
												  			{if $FieldsRow.id != $ThisField.id}
													  		<option value="{$FieldsRow.id}" {if $ThisField.ChildField eq $FieldsRow.id}selected{/if}>{$FieldsRow.name_e}</option>
													  		{/if}
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>	-->								  																  	
									  			</table>
									  		</td>
									  		<td valign="top">
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
												  	<tr>
												  		<td class="fComments" height="25">
												  		Тип поля:&nbsp;
												  		</td>
												  		<td class="fComments">
												  		{foreach from=$FieldTypes key=keys item=TheRow}
												  		<img id="TypePic_E{$key}{$TheRow}" alt="{$TheRow}" src="images/fields/{$TheRow}{if $ThisField.InputType eq $TheRow}_sel{/if}.gif" style="cursor:hand;" onclick="ChangeInputTypeE('InputTypeE{$key}','{$TheRow}',{$key})">
														{/foreach}
														<input type="hidden" name="InputType[]" value="{$ThisField.InputType}" id="InputTypeE{$key}">
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25">
													  		Размеры:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>Width:</td><td><input type="text" name="width[]"  id="widthE{$key}" value="{$ThisField.width}" size="3" class="flatEdit"></td><td width="20">
												  		<td>Height:</td><td><input type="text" name="height[]" id="heightE{$key}" value="{$ThisField.height}" size="3" class="flatEdit"></td><td width="20">
												  		<td class="fComments">Приоритет:</td><td><input type="checkbox" value="1" {if $ThisField.priority eq 1}checked{/if} name="priority[{$key}]" class="flatEdit"></td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												  	<tr>
												  		<td class="fComments" height="25" valign="top">
													  		Таблица:
												  		</td>
												  		<td class="fComments">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		<tr>
												  		<td>
												  		<select name="stable[]" id="stableE{$key}" class="free" onchange="GetAjaxIdValueE({$key});">
													  		<option value="">Выберите</option>
												  		{foreach from=$TableList item=TheTable}
													  		<option value="{$TheTable.$TablesInBase}" {if $ThisField.stable eq $TheTable.$TablesInBase}selected{/if}>{$TheTable.$TablesInBase}</option>
												  		{/foreach}
												  		</select><br>
												  		<span id="idValue1SelBoxE{$key}">
												  		<table cellpadding="0" cellspacing="0" border="0">
												  		{if $ThisField.idParent neq ""}
												  		<tr><td>Parent:</td><td><select class=free id=idParentE{$key} name=idParent[{$key}]><option value="{$ThisField.idParent}">{$ThisField.idParent}</option></select></td>
												  		{/if}
												  		{if $ThisField.idField neq ""}
												  		<tr><td>ID:</td><td><select class=free id=idFieldE{$key} name=idField[{$key}]><option value="{$ThisField.idField}">{$ThisField.idField}</option></select></td>
												  		{/if}
												  		{if $ThisField.idValue neq ""}
												  		<tr><td>Value:</td><td><select class=free id=idValueE{$key} name=idValue[{$key}]><option value="{$ThisField.idValue}">{$ThisField.idValue}</option></select></td>
												  		{/if}
												  		{if $ThisField.idOrder neq ""}
												  		<tr><td>Order:</td><td><select class=free id=idOrderE{$key} name=idOrder[{$key}]><option value="{$ThisField.idOrder}">{$ThisField.idOrder}</option></select></td>
												  		{/if}
												  		</table>
												  		</span>
												 
												  		</td>
												  		</tr>
												  		</table>
												  		</td>
												  	</tr>
												</table>  	
									  		</td>
									  		<td valign="top"> 
									  			<table cellpadding="0" cellspacing="0" border="0" width="100%">
									  				<tr>
									  					<td class="fComments">SQL поля:&nbsp;</td>
									  					<td class="fComments">
									  					<select name="sqltype[]" id="sqltypeE{$key}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$SQLTypes item=TheType}
													  		<option value="{$TheType}" {if $ThisField.sqltype eq $TheType}selected{/if}>{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  					<td><input type="text" name="sqllen[]" id="sqllenE{$key}" size="1" class="flatEdit" value="{$ThisField.sqllen}"></td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Доп.:</td>
									  					<td>
									  					<select name="addoptions[]" id="addoptionsE{$key}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$AddOptions item=TheType}
													  		<option value="{$TheType}" {if $ThisField.addoptions eq $TheType}selected{/if}>{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Сорт.:</td>
									  					<td>
									  					<select name="sortoptions[]" id="sortoptionsE{$key}" class="free">
													  		<option value="">Выберите</option>
												  		{foreach from=$SortOptions item=TheType}
													  		<option value="{$TheType}" {if $ThisField.sortoptions eq $TheType}selected{/if}>{$TheType}</option>
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				<tr>
									  					<td class="fComments">Список</td>
									  					<td>
									  						<input value="1" type="checkbox" name="ListMember[{$key}]" id="ListMemberE{$key}" {if $ThisField.ListMember eq 1}checked{/if}>
									  					</td>
									  				</tr>
									  				{if $ThisField.InputType eq 'select' || $ThisField.InputType eq 'checkbox'}
									  				<tr>
									  					<td class="fComments">Под. форма</td>
									  					<td>
									  					<select name="ChildField[]" id="ChildFieldE{$key}" class="freeLittle">
													  		<option value="0">Нет</option>
												  		{foreach from=$FieldList item=FieldsRow}
												  			{if $FieldsRow.id != $ThisField.id}
													  		<option value="{$FieldsRow.id}" {if $ThisField.ChildField eq $FieldsRow.id}selected{/if}>{$FieldsRow.name_e}</option>
													  		{/if}
												  		{/foreach}
												  		</select>
									  					</td>
									  				</tr>
									  				{else}
									  					<input type="hidden" name="ChildField[]" value="0">
									  				{/if}									  				
									  			</table>
									  			
									  		</td>
									  	</tr>
									  </table><div align="right"><img src='images/del.gif' vspace=2 hspace=2 onclick=DelAjaxFormE({$key});TabRightSwitch4(4);></div>
									  </fieldset>
									  </div>
									  {/foreach}
									  </span>
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="50%"></td>
									</tr>
									</table>  
									<div align="left">
									<input type="hidden" id="FieldCountE" value="1"></div>  
									<input type="hidden" id="SelBoxFieldsNumE" value="0"></div>  
									<table cellpadding="5" cellspacing="5" align="center">
										
										<tr>
											<td>
											<input type="hidden" name="ActType" value="edit">
											<input type="image" name="btnedit" src="images/button2.gif" {if $FieldCount eq 0}style="display:none;"{/if}>
											</td>
										</tr>
									</table>
							</form>
							{/if}
						</td>
						</tr>
						</table>
						
						<table id="TabContent4" width="100%">
						<tr>
						<td><br>
						<form action="formfields.php?form_id={$smarty.get.form_id}" method="POST" id="frmEdit">
						<div align="center"><span id="spDelete" class="formTitle">{$DELETING}</span></div>
							<table cellpadding="0" cellspacing="0" width="100%" bgcolor="FDE1E1">
								<td colspan="3" bgcolor="F77F7F" height="1"></td>
								<tr>
									<td align="center" height="50">							
										<span id="DelSpan"><div class="BigTitle">Не выбрано поля для удаления</div></span>
									</td>
								</tr>
								<tr>
									<td align="center" valign="middle" height="100" colspan="3" class="BigTitle" align="center">
									<span id="btndel" style="display:none">Вы действительно хотите удалить данную полю?<br><br>
									<input type="hidden" name="ActType" value="delete">
									<input type="image" src="images/button3.gif" name="btndel">&nbsp;<img src="images/cancel.gif" style="cursor:hand;" onclick="BackToEdit();"></span>
									</td>
								</tr>
								<td colspan="3" bgcolor="F77F7F" height="1"></td>
							</table><br>
						</form>
							
						</td>
						</tr>
						</table>
						
					<script language="javascript">
					TabRightSwitch4(1);
					//ChangeLangs('LangEdit', document.forms['frmEdit'].elements['ltableEdit'].selectedIndex);
					</script>	
					</td>
				</tr>
			</table>
		</tr>
		</table>
	{/if}
{$bottom}