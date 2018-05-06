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
	var url = "get_ajax_info.php?case=structure&menu_id="+MenuID;
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
	var url = "get_ajax_info.php?case=structure&menu_id="+MenuID;
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
			document.getElementById("procnamer").value = newArray[6];
			document.getElementById("targetr").value = newArray[8];
			document.getElementById("ordr").value = newArray[7];
			spEdit.innerHTML = spEditing;
			document.getElementById("name1r").focus();
		}
	}
}

function subjDelete(subjName, subjId)
{
	document.getElementById("subjIdd").value = subjId;
	spDelete.innerHTML = spDeleting + ' - <font color="Red">' + subjName + '</font>';
}

{/literal}
</script>
	{if $MESSAGE neq ""}
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td class="Message">{$MESSAGE}</td>
		</tr>
		</table>
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
						
						<table id="TabContent1" width="98%">
							<tr>
								<td>
									<br>
									<table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="Gray">
											<tr bgcolor="A6A4A4">
												<td height="20">
													&nbsp;{$ThisRow.name_e}
												</td>
												<td>
													&nbsp;{$ThisRow.name_r}
												</td>
												<td>
													&nbsp;{$ThisRow.name_u}
												</td>
												<td colspan="3"></td>
											</tr>					
										
											{foreach key=key item=ThisRow from=$SubjRows}
											{if $ThisRow.parent_id eq 0}
											<tr bgcolor="DEDEE1">
												<td height="20">
													<b>&nbsp;{$ThisRow.name_e}</b>
												</td>
												<td>
													<b>&nbsp;{$ThisRow.name_r}</b>
												</td>
												<td>
													<b>&nbsp;{$ThisRow.name_u}</b>
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(2); GetAjaxInfo({$ThisRow.menu_id});">Добавить</a>
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$ThisRow.menu_id});">Редактировать</a>
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(4); subjDelete('{$ThisRow.NAME1}', {$ThisRow.menu_id})">Удалить</a>
												</td>
											</tr>				
											{else}	
											<tr bgcolor="White">
												<td height="20">
													&nbsp;{$ThisRow.name_e}
												</td>
												<td>
													&nbsp;{$ThisRow.name_r}
												</td>
												<td>
													&nbsp;{$ThisRow.name_u}
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(2); GetAjaxInfo({$ThisRow.menu_id});">Добавить</a>
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$ThisRow.menu_id});">Редактировать</a>
												</td>
												<td align="center">
													<a href="#" onclick="TabRightSwitch4(4); subjDelete('{$ThisRow.NAME1}', {$ThisRow.menu_id})">Удалить</a>
												</td>
											</tr>											
											{/if}
										{/foreach}	
									</table>
								</td>
							</tr>
						</table>
						
						<table id="TabContent2">
						<tr>
						<td>
							<BR>
							<form action="structure.php?act=subjects" method="POST" id="frmAdd">
							<input type="hidden" name="actParam" value="4">
							<input type="hidden" name="actedit" value="1">				
							<input type="hidden" name="parentId" value="{$PARENT_ID_ADD}">
							{include file=child_box_topside.tpl}
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td align="center" bgcolor="346464" height="25" valign="top" colspan="3"><span id="spAdd" class="InfoWhite">{$ADDING}</span></td>
								</tr>
							</table>	<br>
			
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td width="150"><b>{$SUBJECT_TYPE}</b></td>
									<td>&nbsp;</td>
									<td>{$PARENTBOX}</td>
								</tr>
								<tr>
									<td rowspan="3" valign="top"><b>{$NAME}</b></td>
									<td width="100"><span id="Lang1{$key}">Uzb</span></td>
									<td><input type="text" name="name1" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100"><span id="Lang1{$key}">Рус</span></td>
									<td><input type="text" name="name2" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100"><span id="Lang1{$key}">Eng</span></td>
									<td><input type="text" name="name3" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100" colspan="2"><b>Ссылка</b></td>
									<td><input type="text" name="procname" value="formbuilder.php" style="width:300"></td>
								</tr>
								<tr>
									<td width="100" colspan="2"><b>Фрейм</b></td>
									<td><input type="text" name="target" value="mainframe" style="width:300"></td>
								</tr>
								<tr>
									<td align="center" colspan="3">
										<br>
										<table cellpadding="0" cellspacing="0">
											<tr>
												<td><input type="submit" value="{$SAVE}" name="btnsave" class="button"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table><br>
							{include file=child_box_bootside.tpl}		
							</form>
						</td>
						</tr>
						</table>
						
						<table id="TabContent3">
						<tr>
						<td>
							<BR>
							<form action="structure.php?act=subjects" method="POST" id="frmEdit">
							<input type="hidden" name="actParam" value="2">
							<input type="hidden" name="actedit" value="1">
							<input type="hidden" name="subjIdr" value="{$PARENT_ID_ADD}">
							<input type="hidden" name="parentIdr" value="{$PARENT_ID_EDIT}">
							{include file=child_box_topside.tpl}
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td align="center" bgcolor="346464" height="25" valign="top" colspan="3"><span id="spEdit" class="InfoWhite">{$EDITING}</span></td>
								</tr>
							</table>	<br>
			
							<table cellpadding="0" cellspacing="0">
																<tr>
									<td rowspan="3" width="100" valign="top"><b>{$NAME}</b></td>
									<td width="100"><span id="Lang1{$key}">Uzb</span></td>
									<td><input type="text" name="name1r" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100"><span id="Lang1{$key}">Рус</span></td>
									<td><input type="text" name="name2r" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100"><span id="Lang1{$key}">Eng</span></td>
									<td><input type="text" name="name3r" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100" colspan="2"><b>Ссылка</b></td>
									<td><input type="text" name="procnamer" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100" colspan="2"><b>Фрейм</b></td>
									<td><input type="text" name="targetr" value="" style="width:300"></td>
								</tr>
								<tr>
									<td width="100" colspan="2"><b>Порядок</b></td>
									<td><input type="text" name="ordr" value="" style="width:300"></td>
								</tr>
								<tr>
									<td align="center" colspan="3">
										<br>
										<table cellpadding="0" cellspacing="0">
											<tr>
												<td><input type="submit" value="{$EDIT}" name="btnsave" class="button"></td>
											</tr>
										</table>
									</td>
								</tr>
							</table><br>
							{include file=child_box_bootside.tpl}		
							</form>
						</td>
						</tr>
						</table>
						
						<table id="TabContent4">
						<tr>
						<td>
							<BR>
							<form action="structure.php?act=subjects" method="POST" id="frmDelete">
							<input type="hidden" name="actParam" value="3">
							<input type="hidden" name="actedit" value="1">
							<input type="hidden" name="subjIdd" value="{$PARENT_ID_ADD}">
							{include file=child_box_topside.tpl}
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td align="center" bgcolor="346464" height="25" valign="top" colspan="3"><span id="spDelete" class="InfoWhite">{$DELETING} - <font color="Red">{$NAME1VAL}</font></span></td>
								</tr>
							</table>	<br>
							
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td align="center" height="25" valign="top" colspan="3" class="BigTitle">{$DELETE_CONFIRM}</td>
								</tr>
								<tr>
									<td align="center"><input type="submit" value="{$DELETE}" name="btndel" class="button"></td>
								</tr>
							</table><br>
							</form>
							{include file=child_box_bootside.tpl}
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