{$base}
<head>
</head>
<script for=window event=onbeforeunload>
document.body.innerHTML="<table width=100% height=100%><tr><td align=center><h4>Дастур жавобини кутинг...</h4></td></tr></table>";
</script>
<script>
{literal}
function GetAjaxInfoEdit(RowID)
{
	document.getElementById('WaitEditSpan').innerHTML = '<font color=red><b>Please wait...</b></font>';
	var url = "get_ajax_info1.php?case=formbuilder&tid={/literal}{$Section.tablename}{literal}&rowid="+RowID;
	//document.getElementById('MyFieldsURL').value = url;

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
			//document.forms['add_card_frm'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = 'none';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "<&sep&>";
			var newArray = nameList.split(regexp);
			{/literal}
			{$JavaProccVal}
			{literal}
			document.getElementById('WaitEditSpan').innerHTML = '';
		}
	}
}

function GetAjaxInfoDel(RowID)
{
	var url = "get_ajax_info1.php?case=formbuilder&tid={/literal}{$Section.tablename}{literal}&rowid="+RowID;
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
			//document.forms['add_card_frm'].contract_num.value = "";
			//contract_status.innerHTML = "Нет утвержденного контракта дилера!";
			//document.getElementById("block_type").disabled = false;
			//document.getElementById("MyBladeNumber").style.display = 'none';
			//esn_status.innerHTML = "<font color=red><b>Радиоблок не найден !</b></font><br>";
		}
		else
		{
			var nameList = resp;
			var regexp = "<&sep&>";
			var newArray = nameList.split(regexp);
			{/literal}
			{$JavaProccVald}
			{literal}
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
	document.getElementById('ContentList').innerHTML = "<p class=AlarmText><b>Пожалуйста ждите!</b></p>";
	SetCookie('sortmenu',menu_id);
	SetCookie('sortby',field);
	SetCookie('sortid',sort);
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
		document.getElementById('ContentList').innerHTML = resp;
	}
}

function AddDynamicSB(id,name,type,parfield)
{
	var dynCount = document.getElementById(name+"DynCount").value;
	if(el=document.getElementById("ThisDyn"+name+"_"+dynCount))
	{
		dynCount++;
	}

	if (document.getElementById('DynamicFormName').value == name)
	{
		var ThisDynCount = parseInt(dynCount)+1;
		if(el=document.getElementById(name))
		{
			el.innerHTML += "<div id=ThisDyn"+name+"_"+ThisDynCount+"><input type=button value='x' style='width:25px; height=25px;'  ondblclick=DelDynSB('"+name+"',"+ThisDynCount+");>"+document.getElementById('DynamicFormContent').innerHTML+"</div>";
		}
		if(ell=document.getElementById(name+'DynCount'))
		{
			ell.value ++;
		}
	}
	else
	{
		if (type == 'edit')
		{
			if (el=document.getElementById(parfield+'fe'))
			{
				var ParVal = document.getElementById(parfield+'fe').value;
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
			}
			else
			{
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
			}
		}
		else
		{
			if (el=document.getElementById(parfield+'fc'))
			{
				var ParVal = document.getElementById(parfield+'fc').value;
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
			}
			else
			{
				var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
			}
		}
		//window.status = url;
		//document.getElementById('MyFieldsURL').value = url;
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
	if (type == 'edit')
	{
		if (el=document.getElementById(parfield+'fe'))
		{
			var ParVal = document.getElementById(parfield+'fe').value;
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
		}
		else
		{
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
		}
	}
	else
	{
		if (el=document.getElementById(parfield+'fc'))
		{
			var ParVal = document.getElementById(parfield+'fc').value;
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount+"&parid="+ParVal;
		}
		else
		{
			var url = "get_ajax_page.php?case=dynamicSB&id="+id+"&type="+type+"&dc="+dynCount;
		}
	}
	//window.status = url;
	//document.getElementById('MyFieldsURL').value = url;
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
				el.innerHTML += "<div id=ThisDyn"+newArray[0]+"_"+newArray[1]+"><input type=button value='x' style='width:25px; height=25px;'  ondblclick=DelDynSB('"+newArray[0]+"',"+newArray[1]+");>"+newArray[2]+"</div>";
				document.getElementById('DynamicFormContent').innerHTML = newArray[2];
				document.getElementById('DynamicFormName').value = newArray[0];
			}
			if(ell=document.getElementById(newArray[0]+'DynCount'))
			{
				ell.value ++;
			}
		}
	}
}

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ' ' + '$2');
	}
	return x1 + x2;
}

function DelDynSB(field,id)
{
	//var thidId = id +1;
	//document.getElementById('MyFieldsURL').value = "ThisDyn"+field+"_"+id;
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
	//document.getElementById('MyFieldsURL').value = url;
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
						el.innerHTML = document.getElementById(newArray2[0]+'d').innerHTML + newArray2[1];
						document.getElementById(newArray2[0]+'DynCount').value = newArray2[2];
						//document.getElementById(newArray2[0]+'DynCount').value ++;
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
		var s2 = s1.substring(0,3) + ',' + s1.substring(3);
		s.value = s0.substring(0,s0.length-6) + ',' + s2;
		return true;
	}
	if(s.value > 999){
		var s1 = Math.floor(s.value / 1000);
		var s2 = s.value % 1000;
		if(s2 == 0)  s.value = s1 + ',' + '000';
		else if(s2 < 10)  s.value = s1 + ',' + '00' + s2;
		else if(s2 < 100) s.value = s1 + ',' + '0' + s2;
		else s.value = s1 + ',' + s2;
	}
	return true;
}

function removeThousands(s){
	var s2 = '';
	for(j=0; j < s.length; j++){
		if (s.charAt(j)!=','){
			s2 += s.charAt(j);
		}
	}
	return s2;
}
{/literal}


</script>

<!--<textarea cols="100" id="MyFieldsURL" rows="5"></textarea>-->
	{if $MESSAGE neq ""}
	<span id="MessageSpan">{include file="messages.tpl"}</span>
	{/if}
	{if $SYS_STATUS neq ""}
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
						{if $Section.name_r|checkparams:noactions eq ""}
						{if $Section.name_r|checkparams:addactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.LIST}</p></i></i></b>
						{elseif $Section.name_r|checkparams:addedactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">{$Lang.EDIT}</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.LIST}</p></i></i></b>
						{elseif $Section.name_r|checkparams:adddellactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">{$Lang.DELETE}</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.LIST}</p></i></i></b>
						{else}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">{$Lang.DELETE}</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">{$Lang.EDIT}</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.LIST}</p></i></i></b>
						{/if}
						{/if}
						</div>
						
						<div class="news_sort" id="RightTabs2">
						<strong>
						
						</strong>
						{if $Section.name_r|checkparams:addactions neq ""}
						<b><i><i><p>{$Lang.ADD}</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{elseif $Section.name_r|checkparams:addedactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">{$Lang.EDIT}</a></p></i></i></div><em></em>	
						<b><i><i><p>{$Lang.ADD}</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{elseif $Section.name_r|checkparams:adddellactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">{$Lang.DELETE}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.ADD}</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{else}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">{$Lang.DELETE}</a></p></i></i></div><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">{$Lang.EDIT}</a></p></i></i></div><em></em>	
						<b><i><i><p>{$Lang.ADD}</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{/if}
						<div class="news_sort" id="RightTabs3">
						<strong>
						
						</strong>
						{if $Section.name_r|checkparams:addactions neq ""}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{elseif $Section.name_r|checkparams:addedactions neq ""}
						<b><i><i><p>{$Lang.EDIT}</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{else}
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(4);">{$Lang.DELETE}</a></p></i></i></div><em></em>
						<b><i><i><p>{$Lang.EDIT}</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{/if}
						
						<div class="news_sort" id="RightTabs4">
						<strong>
						
						</strong>
						{if $Section.name_r|checkparams:adddellactions neq ""}
						<b><i><i><p>{$Lang.DELETE}</p></i></i></b><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{else}
						<b><i><i><p>{$Lang.DELETE}</p></i></i></b><em></em>
						<div><i><i><p><a href="#" onclick="TabRightSwitch4(3);">{$Lang.EDIT}</a></p></i></i></div><em></em>
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(2);">{$Lang.ADD}</a></p></i></i></div><em></em>	
						<div><i><i><p><a  href="#" onclick="TabRightSwitch4(1);">{$Lang.LIST}</a></p></i></i></div>	
						</div>
						{/if}						<!-- ) News sort -->
						<table id="TabContent1" width="100%">
						<tr>
						<td>
							<div id="ContentList">
								{if $ContentRows neq ""}<br>
								<table cellpadding="5" cellspacing="1" border="0" width="100%" align="center" bgcolor="BCC7DD">
									<tr class="titleth">
										<td height="25"></td>
										{foreach from=$ListMembers item=Members key=mkey}
										<td align="center">
										{$Members}
										</td>
										{/foreach}
										{if $Section.name_r|checkparams:noactions eq "" and $Section.name_r|checkparams:addactions eq ""}
											<td colspan="2"></td>
										{/if}
									</tr>
									{assign var=RowsCount value=0}
									{assign var=ColorRow value=0}
									{assign var=AnchorId value=0}
									{foreach from=$ContentRows key=key item=Rows}
									{assign var=RowsCount value=$RowsCount+1}
									{if $ColorRow eq 0}
									<tr bgcolor="FFFFFF">
									{assign var=ColorRow value=1}
									{else}
									<tr bgcolor="#E4EAF2">
									{assign var=ColorRow value=0}
									{/if}
										<td class="LittleRows"  height="25" align="center"><b>{$RowsCount}</b></td>
										{foreach from=$ListMember key=key item=Member}
										<td	 
											{if $ListMembersTypes.$key eq "Money"} nowrap align="right"{/if}
											{if $ListMembersInputTypes.$key eq "date"} align="center"{/if}
											>
										{if $Member eq "mid_path_link"}
											<a href="formbuilder.php?mid={$Rows.$Member}&cid={$Rows.id|crypt}">{$ListMembers.$key}</a>
										{else}
											{if $ListMembersTypes.$key eq "Money"}
												{$Rows.$Member|number_format}&nbsp;
											{elseif $ListMembersTypes.$key eq "SysDate" and $ListMembersInputTypes.$key eq "hidden"}
												{$Rows.$Member|time_date_format}&nbsp;
											{*elseif $ListMemberChild.$key neq ""}
												<a href="formbuilder.php?setconst={$Section.name_u}&mid={$ListMemberChild.$key|crypt}" onclick="SetCookie('{$Section.name_u}', {$AnchorId});">{$Rows.$Member}</a>*}
											{else}	
												{if $Member eq "id"}
													{assign var=AnchorId value=$Rows.$Member}
													{if $Section.name_r|checkparams:SetCookieId neq ""}
														<DIV align="center">
														{assign var=ThisFieldName value=$Section.name_u}
														<input type="radio" name="{$ThisFieldName}" id="{$ThisFieldName}_{$key}" {if $smarty.cookies.$ThisFieldName eq $Rows.$Member}checked{/if} onclick="SetCookie('{$ThisFieldName}', {$Rows.$Member});">
														</DIV>
													{else}	
													{$Rows.$Member}
													{/if}
												{else}
													{if $Member eq 'nodecount'}
														<a href="formbuilder.php?mid={$smarty.get.mid}&parent={$Rows.id}"><font size="2"><b>{$Rows.$Member}</b></font></a>
													{elseif $ListMembersTypes.$key eq 'Fields'}
														<a href="formfields.php?form_id={$Rows.id|crypt}"><font size="2"><b>{$Rows.$Member}</b></font></a>
													{else}
														{$Rows.$Member}
													{/if}
												{/if}
											{/if}	
										{/if}	
										</td>
										{/foreach}
										{if $Section.name_r|checkparams:noactions eq "" and $Section.name_r|checkparams:addactions eq ""}
											{if $Section.name_r|checkparams:addedactions neq ""}
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$Rows.id});"><img src="images/edit.gif" border="0" width="26"></a></td>
											{elseif $Section.name_r|checkparams:adddellactions neq ""}
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); GetAjaxInfoDel({$Rows.id});"><img src="images/del.gif" border="0" width="26"></a></td>
											{else}
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$Rows.id});"><img src="images/edit.gif" border="0" width="26"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); GetAjaxInfoDel({$Rows.id});"><img src="images/del.gif" border="0" width="26"></a>
												</td>
											{/if}
										{/if}
									</tr>	
									{/foreach}
								</table>
							{/if}
							</div>
							{if $MyPagesList neq ""}<br>
							<table cellpadding="0" cellspacing="1" border="0" width="100%" bgcolor="Silver">
								<tr>
									<td height="30" align="center" bgcolor="E7E4E4">
										<table cellpadding="2" cellspacing="2" border="0">
											<tr>
												<td class="SortTitle">Са&#1203;ифаларга ўтиш:</td>
												<td>
												{$MyPagesList}
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>	
							{/if}
						</td>
						</tr>
						</table>
						<table id="TabContent2" width="100%">
						<tr>
						<td>
							<BR>
							<form action="formbuilder.php?mid={$smarty.get.mid}{$addUrl}{$addUrlForm}" method="POST" name="FormAdd" id="PutOn" enctype="multipart/form-data">
							<fieldset>
							<legend><span id="FieldLegend{$key}">{$Lang.ADD}</span></legend>
							<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
							
							{if $Section.BuildType eq 1}
										<tr>
									{foreach from=$Fields item=Field key=key}
										{if $Field.InputType neq 'hidden'}
											<td class="fComments" height="60">
											{$Field.name_e}:<br>
											
											{if $Field.InputType eq 'html'}
												{if $Field.addoptions eq 'HTMLArea'}
												{$TheField.$key}
													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "{$Field.height}px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('{$Field.fieldname}', config);
													</script>
												{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															               fmOpen : function(callback) {
																		      $('<div/>').dialogelfinder({
																		        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
																		        // lang: 'ru', // elFinder language (OPTIONAL)
																		        commandsOptions: {
																		          getfile: {
																		            oncomplete: 'destroy' // destroy elFinder after file selection
																		          }
																		        },
																		        getFileCallback: callback // pass callback to editor
																		      });
																		    }
															            }
														$('#{/literal}{$Field.fieldname}{literal}').elrte(opts);
													})
													{/literal}
													</script>
													{$TheField.$key}
												{else}
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditor = new FCKeditor( '{$Field.fieldname}' ) ;
													oFCKeditor.BasePath	= sBasePath ;
													oFCKeditor.Height	= 500 ;
													oFCKeditor.Create() ;
													</script>									
												{/if}
											{else}
											{$TheField.$key}
											{/if}
											
											{if $Field.InputType eq 'date'}
												<script>
												{literal}
												function toggleCalendar(elem_name)
												{
													window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
												}
												{/literal}
												</script>
												{/if}
			
												{if $Field.InputType eq 'file'}
												<script>
												{literal}
												function BackFileForm(thisField)
												{
													{/literal}
													document.getElementById(thisField).innerHTML = "{$DirSelBoxA}<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog('"+thisField+"');>";
													{literal}
												}

												function dialog(thisField)
												{
													result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
													if (result == null)
													return;
													var ElementCurrHTML = document.getElementById(thisField).innerHTML;
													document.getElementById(thisField).innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm('"+thisField+"');>";
												}
												{/literal}
												</script>
											{/if}
											</td>
									{else}
										{if $Field.addoptions eq 'setUser'}
										{$Field.name_e}: 
										{/if}
										{if $TheField.coupleoptions eq ""}
										{$TheField.key}
										{/if}
									{/if}	
									{/foreach}	
									<td align="right"><br><input type="submit" name="SaveContent" value="Save"><!--<input type="image" src="images/button1.gif">--></td>
									</tr>
							{else}
									{assign var=DoubleNum value=0}
									{foreach from=$Fields item=Field key=key}
										{if $Field.InputType neq 'hidden'}
											{if $Field.id neq $DoubleNum}
												<tr>
													<td class="fComments" height="40">
													{$Field.name_e}:	
													</td>
													<td>
													{if $Field.InputType eq 'html'}
														{if $Field.addoptions eq 'HTMLArea'}
														{$TheField.$key}
															<script src='tools/htmlarea/editor.js'></script>
															<script>
															_editor_url = "tools/htmlarea/";
															</script>
															<script language="javascript1.2">
															var config = new Object();    // create new config object
															config.width = "100%";
															config.height = "{$Field.height}px";
															config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
															config.debug = 0;
															editor_generate('{$Field.fieldname}', config);
															</script>
														{elseif $Field.addoptions eq 'elRTE'}
															<script type="text/javascript" charset="utf-8">
															{literal}
															     $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															               fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
            													$('#{/literal}{$Field.fieldname}{literal}').elrte(opts);
															})
															{/literal}
															</script>	
															{$TheField.$key}
														{else}
															<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
															<script type="text/javascript">
															var sBasePath = 'fckeditor/' ;

															var oFCKeditor = new FCKeditor( '{$Field.fieldname}' ) ;
															oFCKeditor.BasePath	= sBasePath ;
															oFCKeditor.Height	= 500 ;
															oFCKeditor.Create() ;
															</script>												
														{/if}									
													{else}
													{$TheField.$key}
													{/if}
		
													{if $Field.InputType eq 'date'}
													<script>
													{literal}
													function toggleCalendar(elem_name)
													{
														window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
													}
													{/literal}
													</script>
													{/if}
				
													{if $Field.InputType eq 'file'}
													<script>
													{literal}
													function BackFileForm(thisField)
													{
														{/literal}
														document.getElementById(thisField).innerHTML = "{$DirSelBoxA}<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog('"+thisField+"');>";
														{literal}
													}

													function dialog(thisField)
													{
														result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
														if (result == null)
														return;
														var ElementCurrHTML = document.getElementById(thisField).innerHTML;
														document.getElementById(thisField).innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm('"+thisField+"');>";
													}
													{/literal}
													</script>
													{/if}
													</td>
													{if $Field.doubleoptions neq ''}
														{assign var=NextId value=$key+1}
														{assign var=NextRowVal value=$Fields.$NextId}
														{if $Field.doubleoptions eq $NextRowVal.doubleoptions}
														{assign var=DoubleNum value=$NextRowVal.id}
														<td align="right">
															{if $NextRowVal.InputType eq 'html'}
																{if $NextRowVal.addoptions eq 'HTMLArea'}
																{$TheField.$key}
																	<script src='tools/htmlarea/editor.js'></script>
																	<script>
																	_editor_url = "tools/htmlarea/";
																	</script>
																	<script language="javascript1.2">
																	var config = new Object();    // create new config object
																	config.width = "100%";
																	config.height = "{$NextRowVal.height}px";
																	config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
																	config.debug = 0;
																	editor_generate('{$NextRowVal.fieldname}', config);
																	</script>
																{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															             fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$('#{/literal}{$Field.fieldname}{literal}').elrte(opts);
													})
													{/literal}
													</script>
													{$TheField.$key}
																{else}															
																	<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
																	<script type="text/javascript">
																	var sBasePath = 'fckeditor/' ;

																	var oFCKeditor = new FCKeditor( '{$NextRowVal.fieldname}' ) ;
																	oFCKeditor.BasePath	= sBasePath ;
																	oFCKeditor.Height	= 500 ;
																	oFCKeditor.Value	= '' ;
																	oFCKeditor.Create() ;
																	</script>											
																{/if}
															{else}
															{$TheField.$NextId}
															{/if}
				
															{if $NextRowVal.InputType eq 'date'}
															<script>
															{literal}
															function toggleCalendar(elem_name)
															{
																window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
															}
															{/literal}
															</script>
															{/if}
						
															{if $NextRowVal.InputType eq 'file'}
															<script>
															{literal}
															function BackFileForm(thisField)
															{
																{/literal}
																document.getElementById(thisField).innerHTML = "{$DirSelBoxA}<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog('"+thisField+"');>";
																{literal}
															}

															function dialog(thisField)
															{
																result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
																if (result == null)
																return;
																var ElementCurrHTML = document.getElementById(thisField).innerHTML;
																document.getElementById(thisField).innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm('"+thisField+"');>";
															}
															{/literal}
															</script>
															{/if}
															</td>	
															<td class="fComments" height="40" align="right">
															:{$NextRowVal.name_e}	
															</td>
																														
														{/if}
													{/if}
												</tr>
											{/if}
										{else}
											{if $Field.addoptions eq 'setUser'}
													{$TheField.$key}
											{else}
												{$TheField.$key}
											{/if}
										{/if}	
										{if $Field.InputType neq 'hidden'}
										<tr>
											<td height="1" colspan="4" bgcolor="C7F482"></td>
										</tr>
										{/if}
								{/foreach}	
								<tr>
									<td height="60" align="center" colspan="4"><input type="hidden" name="SaveContent" value="Save"><input type="image" src="images/button1.gif"></td>
								</tr>
							{/if}
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
							<form action="formbuilder.php?mid={$smarty.get.mid}{$addUrl}{$addUrlForm}" method="POST" name="FormEdit" id="PutOn" enctype="multipart/form-data">
							<fieldset class="edit">
							<legend><span id="FieldLegendE{$key}">{$Lang.EDIT}</span></legend>
							<DIV class="EditPlace">
							<input type="hidden" id="DynamicFormName">
							<div id="DynamicFormContent" style="display:none"></div>

							<table cellpadding="0" cellspacing="0" border="0" width="96%" align="center">
							{if $Section.BuildType eq 1}
										<tr>
									{foreach from=$Fields item=Field key=key}
											<td class="fComments" height="60">
											{$Field.name_e}:<br>
											{if $Field.InputType eq 'html'}
												{if $Field.addoptions eq 'HTMLArea'}
													{$TheFielde.$key}
													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "{$Field.height}px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('{$Field.fieldname}e', config);
													</script>
												{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															              fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$('#{/literal}{$Field.fieldname}e{literal}').elrte(opts);
													})
													{/literal}
													</script>	
													{$TheFielde.$key}
												{else}
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditorE = new FCKeditor( '{$Field.fieldname}e' ) ;
													oFCKeditorE.BasePath	= sBasePath ;
													oFCKeditorE.Height	= 500 ;
													oFCKeditorE.Create() ;
													</script>														
												{/if}
											{else}
												{$TheFielde.$key}
											{/if}
											{if $Field.InputType eq 'date'}
											<script>
											{literal}
											function toggleCalendar(elem_name)
											{
												window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
											}
											{/literal}
											</script>
											{/if}
		
											{if $Field.InputType eq 'file'}
											<script>
											{literal}
											function BackFileForm(thisField)
											{
												{/literal}
												document.getElementById(thisField).innerHTML = "<select name='"+thisField+"ed' class=free>{$DirSelBoxU}<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog('"+thisField+"');>";
												{literal}
											}

											function dialog(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField, "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField).innerHTML;
												document.getElementById(thisField).innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm('"+thisField+"');>";
											}
											{/literal}
											</script>
											{/if}
											</td>
									{/foreach}	
									<td align="right"><br><input type="hidden" name="SaveContent" value="Update"><input type="image" src="images/button2.gif"></td>
									</tr>
							{else}
									{assign var=DoubleNum value=0}
									{foreach from=$Fields item=Field key=key}
										{if $Field.InputType neq 'hidden'}
											{if $Field.id neq $DoubleNum}
												<tr>
													<td class="fComments" height="40">
													{$Field.name_e}:	
													</td>
													<td>
													{if $Field.InputType eq 'html'}
														{if $Field.addoptions eq 'HTMLArea'}
														{$TheFielde.$key}
														<script src='tools/htmlarea/editor.js'></script>
														<script>
														_editor_url = "tools/htmlarea/";
														</script>
														<script language="javascript1.2">
														var config = new Object();    // create new config object
														config.width = "100%";
														config.height = "{$Field.height}px";
														config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
														config.debug = 0;
														editor_generate('{$Field.fieldname}e', config);
														</script>
													{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															               fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$('#{/literal}{$Field.fieldname}e{literal}').elrte(opts);
													})
													{/literal}
													</script>	
													{$TheFielde.$key}
													{else}
														<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
														<script type="text/javascript">
														var sBasePath = 'fckeditor/' ;

														var oFCKeditorE = new FCKeditor( '{$Field.fieldname}e' ) ;
														oFCKeditorE.BasePath	= sBasePath ;
														oFCKeditorE.Height	= 500 ;
														oFCKeditorE.Create() ;
														</script>														
													{/if}									
													{else}
													{$TheFielde.$key}
													{/if}
		
													{if $Field.InputType eq 'date'}
													<script>
													{literal}
													function toggleCalendar(elem_name)
													{
														window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
													}
													{/literal}
													</script>
													{/if}
							
													{if $Field.InputType eq 'file'}
														
														
														<script>
														{literal}
														function BackFileForm1(thisField)
														{
															{/literal}
															document.getElementById(thisField+'e').innerHTML = "<select name='"+thisField+"ed' class=free>{$DirSelBoxU}<br><input type='file' name='"+thisField+"' id='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=ChooseFile('"+thisField+"','e');>";
															{literal}
														}


														function dialog1(thisField)
														{
															result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+'e', "resizable: no; help: no; status: no; scroll: no; ");
															if (result == null)
															return;
															var ElementCurrHTML = document.getElementById(thisField+'e').innerHTML;
															document.getElementById(thisField+'e').innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm1('"+thisField+"');>";
														}
														{/literal}
														</script>
													{/if}
													</td>
													{if $Field.doubleoptions neq ''}
														{assign var=NextId value=$key+1}
														{assign var=NextRowVal value=$Fields.$NextId}
														{if $Field.doubleoptions eq $NextRowVal.doubleoptions}
														{assign var=DoubleNum value=$NextRowVal.id}
														<td align="right">
															{if $NextRowVal.InputType eq 'html'}
																{if $NextRowVal.addoptions eq 'HTMLArea'}
																{$TheFielde.$key}
																<script src='tools/htmlarea/editor.js'></script>
																<script>
																_editor_url = "tools/htmlarea/";
																</script>
																<script language="javascript1.2">
																var config = new Object();    // create new config object
																config.width = "100%";
																config.height = "{$NextRowVal.height}px";
																config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
																config.debug = 0;
																editor_generate('{$NextRowVal.fieldname}e', config);
																</script>
															{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															               fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$('#{/literal}{$Field.fieldname}e{literal}').elrte(opts);
													})
													{/literal}
													</script>	
													{$TheFielde.$key}
															{else}
																<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
																<script type="text/javascript">
																var sBasePath = 'fckeditor/' ;

																var oFCKeditor = new FCKeditor( '{$NextRowVal.fieldname}e' ) ;
																oFCKeditor.BasePath	= sBasePath ;
																oFCKeditor.Height	= 500 ;
																oFCKeditor.Value	= '' ;
																oFCKeditor.Create() ;
																</script>		
															{/if}										
															{else}
															{$TheFielde.$NextId}
															{/if}
				
															{if $NextRowVal.InputType eq 'date'}
															<script>
															{literal}
															function toggleCalendar(elem_name)
															{
																window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
															}
															{/literal}
															</script>
															{/if}
						
															{if $Field.InputType eq 'file'}
																<script>
																{literal}
																function BackFileForm1(thisField)
																{
																	{/literal}
																	document.getElementById(thisField+'e').innerHTML = "<select name='"+thisField+"ed' class=free>{$DirSelBoxU}<br><input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog1('"+thisField+"');>";
																	{literal}
																}


																function dialog1(thisField)
																{
																	result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+'e', "resizable: no; help: no; status: no; scroll: no; ");
																	if (result == null)
																	return;
																	var ElementCurrHTML = document.getElementById(thisField+'e').innerHTML;
																	document.getElementById(thisField+'e').innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm1('"+thisField+"');>";
																}
																{/literal}
																</script>
															{/if}
															</td>	
															<td class="fComments" height="40" align="right">
															:{$NextRowVal.name_e}	
															</td>
																														
														{/if}
													{/if}
												</tr>
											{/if}
										{else}
											{if $Field.addoptions eq 'setUser'}
													{$TheFielde.$key}
											{else}
												{$TheFielde.$key}
											{/if}
										{/if}	
										{if $Field.InputType neq 'hidden'}
										<tr>
											<td height="1" colspan="4" bgcolor="C7F482"></td>
										</tr>
										{/if}
								{/foreach}	
								<tr>
									<td height="60" align="center" colspan="4"><input type="hidden" name="SaveContent" value="Update"><input type="image" src="images/button2.gif"></td>
								</tr>
							{/if}
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
							<form action="formbuilder.php?mid={$smarty.get.mid}{$addUrl}{$addUrlForm}" method="POST" name="FormDel" id="PutOn" enctype="multipart/form-data">
							<fieldset class="del">
							<legend><span id="FieldLegendD{$key}">{$Lang.DELETE}</span></legend>
							<DIV class="DelPlace" align="center">
							<span id="DelSpan"><div class="BigTitle">Вы действительно хотите удалить данную запись?</div></span><br>
							<table cellpadding="0" cellspacing="0" border="0" width="80%" align="center">
							{if $Section.BuildType eq 1}
										<tr>
									{foreach from=$Fields item=Field key=key}
											<td class="fComments" height="60">
											{$Field.name_e}:<br>
											{$TheFieldd.$key}
											{if $Field.InputType eq 'html'}
												{if $Field.addoptions eq 'HTMLArea'}
													<script src='tools/htmlarea/editor.js'></script>
													<script>
													_editor_url = "tools/htmlarea/";
													</script>
													<script language="javascript1.2">
													var config = new Object();    // create new config object
													config.width = "100%";
													config.height = "{$Field.height}px";
													config.bodyStyle = 'background-color: white; font-family: "Verdana"; font-size: x-small;';
													config.debug = 0;
													editor_generate('{$Field.fieldname}d', config);
													</script>
												{elseif $Field.addoptions eq 'elRTE'}
													<script type="text/javascript" charset="utf-8">
													{literal}
													 $().ready(function() {
															            var opts = {
															                absoluteURLs: false,
															                cssClass : 'el-rte',
															                lang     : 'ru',
															                height   : {/literal}{$Field.height}{literal},
															                toolbar  : 'maxi',
															                cssfiles : ['elrte/css/elrte-inner.css'],                
															               fmOpen : function(callback) {
													      $('<div/>').dialogelfinder({
													        url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
													        // lang: 'ru', // elFinder language (OPTIONAL)
													        commandsOptions: {
													          getfile: {
													            oncomplete: 'destroy' // destroy elFinder after file selection
													          }
													        },
													        getFileCallback: callback // pass callback to editor
													      });
													    }
															            }
														$('#{/literal}{$Field.fieldname}d{literal}').elrte(opts);
													})
													{/literal}
													</script>	
													{$TheFieldd.$key}
												{else}
													<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
													<script type="text/javascript">
													var sBasePath = 'fckeditor/' ;

													var oFCKeditorD = new FCKeditor( '{$Field.fieldname}d' ) ;
													oFCKeditorD.BasePath	= sBasePath ;
													oFCKeditorD.Height	= 500 ;
													oFCKeditorD.Value	= '' ;
													oFCKeditorD.Create() ;
													</script>														
												{/if}
											{/if}
											{if $Field.InputType eq 'date'}
											<script>
											{literal}
											function toggleCalendar(elem_name)
											{
												window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
											}
											{/literal}
											</script>
											{/if}
		
											{if $Field.InputType eq 'file'}
											<script>
											{literal}
											function BackFileForm2(thisField)
											{
												{/literal}
												document.getElementById(thisField+'d').innerHTML = "<input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog2('"+thisField+"');>";
												{literal}
											}


											function dialog2(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+'e', "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField+'e').innerHTML;
												document.getElementById(thisField+'d').innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm2('"+thisField+"');>";
											}
											{/literal}
											</script>
											{/if}
											</td>
									{/foreach}	
									<td align="right"><br><input type="hidden" name="SaveContent" value="Delete"><input type="image" src="images/button3.gif"></td>
									</tr>
							{else}
									{foreach from=$Fields item=Field key=key}
										{if $Field.InputType eq 'hidden'}
										{$TheFieldd.$key}
										{else}
										<tr>
											<td class="fComments" height="40">
											{$Field.name_e}:	
											</td>
											<td>
											{$TheFieldd.$key}
											{if $Field.InputType eq 'date'}
											<script>
											{literal}
											function toggleCalendar(elem_name)
											{
												window.open('templates/calendar.html?c='+elem_name,'cal','height=220,width=190');
											}
											{/literal}
											</script>
											{/if}
		
											{if $Field.InputType eq 'file'}
											<script>
											{literal}
											function BackFileForm2(thisField)
											{
												{/literal}
												document.getElementById(thisField+'d').innerHTML = "<input type='file' name='"+thisField+"' class='flatFields' style='width:250;'><input value='{$Lang.CHOOSE_PIC}' type=button onclick=dialog2('"+thisField+"');>";
												{literal}
											}


											function dialog2(thisField)
											{
												result = window.showModalDialog("tools/htmlarea/popups/insert_images.html", thisField+'e', "resizable: no; help: no; status: no; scroll: no; ");
												if (result == null)
												return;
												var ElementCurrHTML = document.getElementById(thisField+'e').innerHTML;
												document.getElementById(thisField+'d').innerHTML = "<img src='pictures/"+result+"' border=0><br><input type=text name='"+thisField+"' value='"+result+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm2('"+thisField+"');>";
											}
											{/literal}
											</script>
											{/if}
											</td>
										</tr>
										<tr>
											<td height="1" colspan="2" bgcolor="C7F482"></td>
										</tr>
										{/if}
									{/foreach}	
								<tr>
									<td height="60" align="center" colspan="2"><input type="hidden" name="SaveContent" value="Delete"><input type="image" src="images/button3.gif"></td>
								</tr>
							{/if}
							</table>
							</DIV>
							</fieldset>
							</form>
						</td>
						</tr>
						</table>
					<script language="javascript">
					TabRightSwitch4(1);
					{$JavaSetValues}
					//ChangeLangs('LangEdit', document.forms['frmEdit'].elements['ltableEdit'].selectedIndex);
					{literal}
					function ChooseFile(id,type)
							 {
							 $('<div/>').dialogelfinder({
																										 url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
																										 // lang: 'ru', // elFinder language (OPTIONAL)
																										 commandsOptions: {
																											 getfile: {
																												 oncomplete: 'destroy' // destroy elFinder after file selection
																											 }
																										 },
																										 getFileCallback: function(url) {
																										 var thisUrl = url.replace("pictures/", "");
																										 document.getElementById(id+type).innerHTML = "<img src='pictures/"+thisUrl+"' border=0 style='maxlength:400px !important;'><br><input type=text name='"+id+"' value='"+thisUrl+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm1('"+id+"');>";
																											 
																											 //$("#"+id).val(url.replace("pictures/", ""));
																				 //document.getElementById("sfilename").value = url;
																		 } // pass callback to editor
																									 });
							 }					
					{/literal}
					</script>	
					</td>
				</tr>
			</table>
		</tr>
		</table>
	{/if}
{$bottom}