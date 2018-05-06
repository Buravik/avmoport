{include file=base.tpl}

	<div class="headlinks">{$HeadLinks}</div>
	{if $Action eq "view"}
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.faculty}</td>
		</tr>
		{foreach from=$Faculties key=key item=Faculty}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staffs.php?act=directions&fid={$Faculty.id|crypt}" class="names faculties">{$Faculty.name}</a></td>
		</tr>
		{/foreach}
	</table>
	{/if}
	
	{if $Action eq "directions"}
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.directions}</td>
		</tr>
		{foreach from=$Directions key=key item=Direction}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staffs.php?act=groups&did={$Direction.id|crypt}" class="names directions">{$Direction.name}</a></td>
		</tr>
		{/foreach}
	</table>
	{/if}
	
	{if $Action eq "groups"}
	<div id="ex1" style="display:none;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.add_new_group}</h2>
				<div class="forms">
				<label>{$Dict.groupname}:</label><div><input type="text" name="groupname" id="groupname" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="eid">
					<input type="submit" name="SubFAdd" value="{$Dict.save}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <div id="ex2" style="display:none;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.group_edit}</h2>
				<div class="forms">
				<label>{$Dict.groupname}:</label><div><input type="text" name="groupname" id="egroupname" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="fid">
					<input type="submit" name="SubUpdate" value="{$Dict.edit}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <div id="ex3" style="display:none; background:red;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.group_delete}</h2>
				<div class="forms">
				<label>{$Dict.groupname}:</label><div><input type="text" name="groupname" id="dgroupname" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="did">
					<input type="submit" name="SubDel" value="{$Dict.delete}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <!-- Link to open the modal -->
  <div class="actions">
		{if $Access.add eq 1}
		<a href="#ex1" rel="modal:open" class="myButton">{$Dict.add_groups}</a>
		{/if}
	</div>	
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.groups}</td>
			{if $Access.edit eq 1}
			<td align="center">{$Dict.edit}</td>
			{/if}
			{if $Access.del eq 1}
			<td align="center">{$Dict.delete}</td>
			{/if}
		</tr>
		{foreach from=$Groups key=key item=Group}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staffs.php?act=students&gid={$Group.id|crypt}" class="names groups">{$Group.name}</a></td>
			{if $Access.edit eq 1}
			<td align="center"><a href="#ex2" rel="modal:open"><img rel="{$Group.id|crypt}" class="editrow" src="images/edit.png" width="24"></a></td>
			{/if}
			{if $Access.del eq 1}
			<td align="center"><a href="#ex3" rel="modal:open"><img rel="{$Group.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a></td>
			{/if}
		</tr>
		{/foreach}
	</table>
	
	<script>
	{literal}

		$('.editrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=groups&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#fid').val(sInfo[1]);
				$('#egroupname').val($('<div/>').html(sInfo[2]).text());
				//myString.split
			});
		});
		
		$('.deltrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=groups&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#did').val(sInfo[1]);
				$('#dgroupname').val($('<div/>').html(sInfo[2]).text());
				//myString.split
			});
		});
	{/literal}
	</script>
	
	{/if}
		
	{if $Action eq "students"}
 <!-- Modal HTML embedded directly into document -->
  <div id="ex1" style="display:none;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.add_students}</h2>
				<div>
				<textarea name="newstudents" rows=10 cols=76></textarea>
				</div>
				<div class="btnbox">
					<input type="submit" name="SubForm" value="{$Dict.save}" class="myButton">
				</div>
		</div>
		</form>
  </div>
	<div id="ex2" style="display:none;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.edit_student}</h2>
				<div class="forms">
				<label>{$Dict.lastname}:</label><div><input type="text" name="lastname" id="elname" value="" size="20"></div>
				<label>{$Dict.firstname}:</label><div><input type="text" name="firstname" id="efname" value="" size="20"></div>
				<label>{$Dict.surname}:</label><div><input type="text" name="surname" id="esname" value="" size="20"></div>
				<label>{$Dict.birthdate}:</label><div><input type="text" name="birthdate" id="ebirthdate" value="" size="20"></div>
				<label>{$Dict.rank}:</label>
				<div>
				<select name="srank" id="esrank" style=min-width:172px;>
						<option value="0">{$Dict.select}</option>
						{foreach from=$Ranks key=key item=Rank}
						<option value="{$Rank.id}">{$Rank.name}</option>
						{/foreach}
					</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="eid">
					<input type="submit" name="SubEdit" value="{$Dict.edit}" class="myButton">
				</div>
		</div>
		</form>
  </div>
	{if $Access.add eq 1}
	<div id="ex3" style="display:none; background-color: red;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.delete_student}</h2>
				<div class="forms">
				<label>{$Dict.lastname}:</label><div><input type="text" name="lastname" id="dlname" value="" size="20"></div>
				<label>{$Dict.firstname}:</label><div><input type="text" name="firstname" id="dfname" value="" size="20"></div>
				<label>{$Dict.surname}:</label><div><input type="text" name="surname" id="dsname" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="did">
					<input type="submit" name="SubDel" value="{$Dict.delete}" class="myButton">
				</div>
		</div>
		</form>
  </div>
	{/if}
  <!-- Link to open the modal -->
  <div class="actions">
		{if $Access.add eq 1}
		<a href="#ex1" rel="modal:open" class="myButton">{$Dict.add_students}</a>
		{/if}
	</div>
	{if $StaffSett neq 1}
	<div class="info_type">
		{assign var=keyword value=bybase$StaffSett}
		{$Dict.$keyword}
	</div>
	{/if}
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center" width="30"><input type="checkbox" id="ChekAll" value="1"></td>
			<td align="center">{$Dict.student}</td>
			{if $Access.auth eq 1}
			<td align="center">{$Dict.username}</td>
			<td align="center">{$Dict.passwd}{$Access.edit_student}dd</td>
			{/if}
			{if $Access.edit_student eq 1}
			<td align="center"><img src="images/edit.png"></td>
			{/if}
			{if $Access.edit eq 1}
			<td align="center">{$Dict.edit}</td>
			{/if}
			{if $Access.del eq 1}
			<td align="center">{$Dict.delete}</td>
			{/if}
		</tr>
		{foreach from=$Students key=key item=Student}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td align="center" width="30"><input type="checkbox" value="{$Student.id|crypt}"></td>
			<td class="rank {$Student.rank_class}{if $Student.status eq 2} archived{/if}">{$Student.lastname} {$Student.firstname} {$Student.surname}</td>
			{if $Access.auth eq 1}
			<td align="center">{$Student.userid}</td>
			<td align="center">{$Student.passwd}</td>
			{/if}
			{if $Access.edit eq 1}
			<td align="center"><a href="#ex2" rel="modal:open"><img rel="{$Student.id|crypt}" class="editrow" src="images/edit.png" width="24"></a></td>
			{/if}
			{if $Access.del eq 1}
			<td align="center"><a href="#ex3" rel="modal:open"><img rel="{$Student.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a></td>
			{/if}
		</tr>
		{/foreach}
	</table>
	
	<div class="actions_left">
	{if $Access.print eq 1}	
		<a id="pbutton" class="myButton">{$Dict.print}</a>
	{/if}
	{if $Access.delstudent eq 1}	
	<a id="delbutton" class="myButton">{$Dict.delete}</a>
	{/if}
	{if $StaffSett eq 1}
		{if $Access.archstudent eq 1}	
		<a id="archbutton" class="myButton">{$Dict.set_archive}</a>
		{/if}
	{/if}
	{if $StaffSett eq 2}
		{if $Access.backstudent eq 1}	
		<a id="backbutton" class="myButton">{$Dict.back_archive}</a>
		{/if}
	{/if}
	</div>
	{if $Access.print eq 1}	
	<div id="printarea">
	</div>
	{/if}
	
	
	<script>
		{literal}
		
		$('.geditrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=groups&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#eid').val(sInfo[1]);
				$('#egroupname').val(sInfo[2]);
				//myString.split
			});
		});

		$('.gdeltrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=groups&id=" + RowId, function(html) {
			alert(html);
				var sInfo = html.split("<&sec&>");
				$('#did').val(sInfo[1]);
				$('#dgroupname').val(sInfo[2]);
				//myString.split
			});
		});
		
		$('.editrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=ginfo&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#eid').val(sInfo[1]);
				$('#elname').val($('<div/>').html(sInfo[2]).text());
				$('#efname').val($('<div/>').html(sInfo[3]).text());
				$('#esname').val($('<div/>').html(sInfo[4]).text());
				$('#ebirthdate').val(sInfo[5]);
				$('#esrank').val(sInfo[6]);
				//myString.split
			});
		});

		$('.deltrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=ginfo&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#did').val(sInfo[1]);
				$('#dlname').val($('<div/>').html(sInfo[2]).text());
				$('#dfname').val($('<div/>').html(sInfo[3]).text());
				$('#dsname').val($('<div/>').html(sInfo[4]).text());
				$('#dbirthdate').val(sInfo[5]);
				$('#dsrank').val(sInfo[6]);
				//myString.split
			});
		});

		$('#pbutton').click(function(event) {
			event.preventDefault();
			var searchIDs = $("#studtable input:checkbox:checked").map(function(){
				return $(this).val();
			}).get(); // <----
			if (searchIDs == "") {
				alert("{/literal}{$Dict.choose_students}{literal}");
			}
			else
			{
				$.get("ajax.php?act=printpasswd&ids=" + searchIDs, function(html) {
					$('#printarea').html(html);
					$('#printarea').show().printElement();
					$('#printarea').hide();
				});
			}
		});
		
		$('#delbutton').click(function(event) {
			event.preventDefault();
			var searchIDs = $("#studtable input:checkbox:checked").map(function(){
				return $(this).val();
			}).get(); // <----
			if (searchIDs == "") {
				alert("{/literal}{$Dict.choose_students}{literal}");
			}
			else
			{
				var alert_text = "{/literal}{$Dict.shure_delete_student}{literal}";
				if (confirm($('<div/>').html(alert_text).text()))
				{
					//alert(searchIDs);
					$.get("ajax.php?act=delstudent&ids=" + searchIDs, function(html) {
						location.reload();
					});
				}
			}
		});
		
		$('#archbutton').click(function(event) {
			event.preventDefault();
			var searchIDs = $("#studtable input:checkbox:checked").map(function(){
				return $(this).val();
			}).get(); // <----
			if (searchIDs == "") {
				alert("{/literal}{$Dict.choose_students}{literal}");
			}
			else
			{
				var alert_text = "{/literal}{$Dict.shure_arch_student}{literal}";
				if (confirm($('<div/>').html(alert_text).text()))
				{
					//alert(searchIDs);
					$.get("ajax.php?act=archstudent&ids=" + searchIDs, function(html) {
						location.reload();
					});
				}
			}
		});
		
		$('#backbutton').click(function(event) {
			event.preventDefault();
			var searchIDs = $("#studtable input:checkbox:checked").map(function(){
				return $(this).val();
			}).get(); // <----
			if (searchIDs == "") {
				alert("{/literal}{$Dict.choose_students}{literal}");
			}
			else
			{
				var alert_text = "{/literal}{$Dict.shure_back_student}{literal}";
				if (confirm($('<div/>').html(alert_text).text()))
				{
					//alert(searchIDs);
					$.get("ajax.php?act=backstudent&ids=" + searchIDs, function(html) {
						location.reload();
					});
				}
			}
		});
		
		function ClickHereToPrint() {
			try {
				var oIframe = document.getElementById('printframe');
				var oContent = document.getElementById('ex3').innerHTML;
				var oDoc = (oIframe.contentWindow || oIframe.contentDocument);
				if (oDoc.document) oDoc = oDoc.document;
				oDoc.write("<html><head><title>{/literal}{$Dict.students}{literal}</title>");
				oDoc.write("</head><body onload='this.focus(); this.print();'>");
				oDoc.write(oContent + "</body></html>");
				oDoc.close();
			} catch (e) {
				self.print();
			}
		}
		var RowCount = 0;
		$('#ChekAll').change(function() {
			var checkboxes = $(this).closest('table').find('td').find(':checkbox');
			if($(this).is(':checked')) {
					checkboxes.attr('checked', 'checked');
			} else {
					checkboxes.removeAttr('checked');
			}
		});
		
		{/literal}
		</script>
	{/if}
	
{$bottom}


















