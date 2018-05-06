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

function selectByValue(sel, value) {
	var i = 0;
	var end = sel.options.length;
	while(i < end) {
		if (sel.options[i].value == value) {
			sel.options[i].selected = true;
			//sel.selectedIndex = i;
			return;
		}
		i++;
	}
}

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
			//document.getElementById("MenuIdr").value = ;

			var newMenuArr = newArray[8].split(",");
			for (var key in newMenuArr) {
				selectByValue(document.getElementById("MenuIdr"), newMenuArr[key]);
			}

			document.getElementById("BuildTyper").value = newArray[9];
			document.getElementById("PicPathr").value = newArray[10];
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
	{include file="messages.tpl"}
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
									<br>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										
										{foreach key=key item=ThisRow from=$SubjRows}
											{if $ThisRow.parent_id eq 0}
											<tr bgcolor="E9FAD0">
												<td align="right"><a class="nameLink"  href="formfields.php?form_id={$ThisRow.menu_id|crypt}">{$key+1}.</a>&nbsp;</td>
												<td>&nbsp;<a class="nameLink"  href="formfields.php?form_id={$ThisRow.menu_id|crypt}">{$ThisRow.name_e}</a></td>
												<td align="center" height="40"><a href="#" onclick="TabRightSwitch4(2); GetAjaxInfo({$ThisRow.menu_id});"><img src="images/insert.gif" border="0"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$ThisRow.menu_id});"><img src="images/edit.gif" border="0"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); subjDelete('{$ThisRow.name_e}', {$ThisRow.menu_id})"><img src="images/del.gif" border="0"></a></td>
											</tr>				
											{else}	
											<tr bgcolor="White">
												<td align="right"></td>
												<td>&nbsp;<a class="nameLink"  href="formfields.php?form_id={$ThisRow.menu_id|crypt}">{$key+1}.</a>&nbsp;&nbsp;<a class="nameLink"  href="formfields.php?form_id={$ThisRow.menu_id|crypt}">{$ThisRow.name_e}</a></td>
												<td align="center" height="40"><a href="#" onclick="TabRightSwitch4(2); GetAjaxInfo({$ThisRow.menu_id});"><img src="images/insert.gif" border="0"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(3); GetAjaxInfoEdit({$ThisRow.menu_id});"><img src="images/edit.gif" border="0"></a></td>
												<td align="center"><a href="#" onclick="TabRightSwitch4(4); subjDelete('{$ThisRow.name_e}', {$ThisRow.menu_id})"><img src="images/del.gif" border="0"></a></td>
											</tr>	
											{/if}
											<tr><td colspan="5" height="1" bgcolor="AEE756"></tr>
										{/foreach}	
									</table>
								</td>
							</tr>
						</table>
						
						<table id="TabContent2" width="100%">
						<tr>
						<td>
							<BR>
							<form action="forms.php?act=subjects" method="POST" id="frmAdd">
							<input type="hidden" name="actParam" value="4">
							<input type="hidden" name="actedit" value="1">				
							<input type="hidden" name="parentId" value="{$PARENT_ID_ADD}"><br>
							<div align="center"><span id="spAdd" class="formTitle">{$ADDING}</span></div>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="E9FAD0">
								<tr><td height="1" bgcolor="AEE756"></td></tr>
								<tr>
									<td align="center"><br><br>

										<table cellpadding="0" cellspacing="0">
											<tr>
												<td class="forms"><b>{$SUBJECT_TYPE}</b></td>
												<td>&nbsp;</td>
												<td>{$PARENTBOX}</td>
											</tr>
											<tr>
												<td rowspan="3" valign="top" class="forms" width="200"><b>{$NAME}</b></td>
												<td class="formsAdd"><span id="Lang1{$key}">Uzb:&nbsp;</span></td>
												<td><input type="text" name="name1" class="flatText" value=""></td>
											</tr>
											<tr>
												<td class="formsAdd"><span id="Lang1{$key}">Рус:&nbsp;</span></td>
												<td><input type="text" name="name2" value="" class="flatText" ></td>
											</tr>
											<tr>
												<td class="formsAdd"><span id="Lang1{$key}">Eng:&nbsp;</span></td>
												<td><input type="text" name="name3" value="" class="flatText" ></td>
											</tr>
											<tr>
												<td class="forms" colspan="2"><b>SQL Таблица</b></td>
												<td><input type="text" name="tablename" value="" class="flatText" ></td>
											</tr>
											<tr>
												<td align="center" colspan="3">
													<br>
													<table cellpadding="0" cellspacing="0">
														<tr>
															<td><input type="image" name="btnsave" src="images/button1.gif"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table><br><br>

								</td>								
								</tr>
								<tr><td height="1" bgcolor="AEE756"></td></tr>
							</table>

							<br>
							</form>
						</td>
						</tr>
						</table>
						<table id="TabContent3" width="100%">
						<tr>
						<td>
							<BR><br>
							<form action="forms.php?act=subjects" method="POST" id="frmEdit">
							<input type="hidden" name="actParam" value="2">
							<input type="hidden" name="actedit" value="1">
							<input type="hidden" name="subjIdr" value="{$PARENT_ID_ADD}">
							<div align="center"><span id="spEdit" class="formTitle">{$EDITING}</span></div>
							<table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="E5F7FD">
								<tr><td height="1" bgcolor="7FD7F7"></td></tr>
								<tr>
									<td align="center"><br><br>

										<table cellpadding="0" cellspacing="0">
											<tr>
												<td class="forms"><b>{$SUBJECT_TYPE}</b></td>
												<td>&nbsp;</td>
												<td>{$PARENTBOX_EDIT}</td>
											</tr>	
											<tr>
												<td rowspan="3" valign="top" class="forms" width="200"><b>{$NAME}</b></td>
												<td class="formsAdd"><span id="Lang1{$key}">Uzb:&nbsp;</span></td>
												<td><input type="text" name="name1r" class="flatEdit" value=""></td>
											</tr>
											<tr>
												<td class="formsAdd"><span id="Lang1{$key}">Рус:&nbsp;</span></td>
												<td><input type="text" name="name2r" value="" class="flatEdit" ></td>
											</tr>
											<tr>
												<td class="formsAdd"><span id="Lang1{$key}">Eng:&nbsp;</span></td>
												<td><input type="text" name="name3r" value="" class="flatEdit" ></td>
											</tr>
											<tr>
												<td colspan="2" class="forms">Меню</td>
												<td>
													<select name="MenuId[]" style="height:100px; width:300px;" multiple id="MenuIdr">
													{foreach from=$MenuArr item=ThisRow key=key}
														<option value="{$ThisRow.menu_id}">{$ThisRow.name_e}</option>
													{/foreach}
													</select>
												</td>
											</tr>
											<tr>
												<td class="forms" colspan="2"><b>SQL Таблица</b></td>
												<td><input type="text" name="tablenamer" value="" class="flatEdit" ></td>
											</tr>
											<tr>
												<td class="forms" colspan="2"><b>Порядок</b></td>
												<td><input type="text" name="ordr" value=""  class="flatEdit" ></td>
											</tr>
											<tr>
												<td class="forms" colspan="2"><b>Строение</b></td>
												<td>
													<select name="BuildType" class="aClassSelect" id="BuildTyper">
														<option value="0">по вертикали</option>
														<option value="1">по горизонтали</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="forms" colspan="2"><b>Путь к рисункам</b></td>
												<td><input type="text" name="PicPath" value="" id="PicPathr" class="flatEdit"></td>
											</tr>
											<tr>
												<td align="center" colspan="3">
													<br>
													<table cellpadding="0" cellspacing="0">
														<tr>
															<td><input type="image" name="btnsave" src="images/button2.gif"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table><br><br>

								</td>								
								</tr>
								<tr><td height="1" bgcolor="7FD7F7"></td></tr>
							</table>
							</form>
						</td>
						</tr>
						</table>
						
						<table id="TabContent4" width="100%">
						<tr>
						<td>
							<BR><br>
							<form action="forms.php?act=subjects" method="POST" id="frmDelete">
							<input type="hidden" name="actParam" value="3">
							<input type="hidden" name="actedit" value="1">
							<input type="hidden" name="subjIdd" value="{$PARENT_ID_ADD}">
						
							<div align="center"><span id="spDelete" class="formTitle">{$DELETING} - <font color="Red">{$NAME1VAL}</font></span></div>
							<table cellpadding="0" cellspacing="0" width="100%" bgcolor="FDE1E1">
								<td colspan="3" bgcolor="F77F7F" height="1"></td>
								<tr>
									<td align="center"height="100" valign="middle" colspan="3" class="BigTitle">
									{$DELETE_CONFIRM}<br><br>
									<input type="image" src="images/button3.gif" name="btndel">
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