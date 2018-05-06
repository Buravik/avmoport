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
			<td><a href="tests.php?act=directions&fid={$Faculty.id|crypt}" class="names faculties">{$Faculty.name}</a></td>
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
			<td><a href="tests.php?act=groups&did={$Direction.id|crypt}" class="names directions">{$Direction.name}</a></td>
		</tr>
		{/foreach}
	</table>
	{/if}
	
	{if $Action eq "groups"}
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.groups}</td>
		</tr>
		{foreach from=$Groups key=key item=Group}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="tests.php?act=controls&gid={$Group.id|crypt}" class="names groups">{$Group.name}</a></td>
		</tr>
		{/foreach}
	</table>
	{/if}
	{if $Action eq "controls"}
 <!-- Modal HTML embedded directly into document -->
  <div id="ex1" style="display:none;">
    <form method="post" action="">
		<div style="width: 550px">
				<h2 id="ex1h2">{$Dict.add_test_controls}</h2>
				<div class="forms">
				<label>{$Dict.subject}:</label>
				<div>
				<select name="subject" id="ex1subject">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Subjects key=key item=Subject}
						<option value="{$Subject.id}">{$Subject.name}</option>
						{/foreach}
					</select>
				</div>
				<label>{$Dict.test}:</label>
				<div>
				<select name="stestid" id="ex1stestid">
						<option value="0">{$Dict.select}</option>
					</select>
				</div>
				<label>{$Dict.control_collection}:</label>
				<div>
				<select name="cgroup" id="ex1cgroup">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Numbers key=key item=Number}
						<option value="{$Number.id}">{$Number.name}</option>
						{/foreach}
					</select>
				</div>
				<label>{$Dict.block}:</label>
				<div>
				<select name="block" id="ex1block">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Blocks key=key item=Block}
						<option value="{$Block.id}">{$Block.name}</option>
						{/foreach}
					</select>
				</div>
				<label>{$Dict.questions_count}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="qcount" id="ex1qcount" value="" size="40"></div>
				<label>{$Dict.total_time}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="ttime" id="ex1ttime" value="" size="40"></div>
				<label>{$Dict.points}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="point" id="ex1point" value="" size="40"></div>
				<label>{$Dict.test_status}:</label>
				<div>
				<select name="status" id="ex1status">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Statuses key=key item=Status}
						<option value="{$Status.id}">{$Status.name}</option>
						{/foreach}
					</select>
				</div>				
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="eid">
					<input type="hidden" value="0" name="acttype" id="acttype">
					<input type="submit" name="SubForm" id="SubForm" value="{$Dict.add}" class="myButton">
				</div>
		</div>
		</form>
  </div>
	{if $Access.del eq 1}
	<div id="ex3" style="display:none; background-color: red;">
   <form method="post" action="">
		<div style="width: 550px">
				<h2 id="ex1h2">{$Dict.del_test_controls}</h2>
				<div class="forms">
				<label>{$Dict.subject}:</label>
				<div>
				<select name="subject" id="ex3subject">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Subjects key=key item=Subject}
						<option value="{$Subject.id}">{$Subject.name}</option>
						{/foreach}
					</select>
				</div>
				<label>{$Dict.test}:</label>
				<div>
				<select name="stestid" id="ex3stestid">
						<option value="0">{$Dict.select}</option>
					</select>
				</div>
				<label>{$Dict.block}:</label>
				<div>
				<select name="block" id="ex3block">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Blocks key=key item=Block}
						<option value="{$Block.id}">{$Block.name}</option>
						{/foreach}
					</select>
				</div>
				
				<label>{$Dict.questions_count}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="qcount" id="ex3qcount" value="" size="40"></div>
				<label>{$Dict.total_time}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="ttime" id="ex3ttime" value="" size="40"></div>
				<label>{$Dict.points}:</label><div style="text-align: left;"><input style="margin-left: 12px;" type="text" name="point" id="ex3point" value="" size="40"></div>
				<label>{$Dict.control_collection}:</label>
				<div>
				<select name="cgroup" id="ex3cgroup">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Numbers key=key item=Number}
						<option value="{$Number.id}">{$Number.name}</option>
						{/foreach}
					</select>
				</div>
				<label>{$Dict.test_status}:</label>
				<div>
				<select name="status" id="ex3status">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Statuses key=key item=Status}
						<option value="{$Status.id}">{$Status.name}</option>
						{/foreach}
					</select>
				</div>				
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
		<a href="#ex1" rel="modal:open" class="myButton" id="AddButton">{$Dict.add_test_controls}</a>
		{/if}
	</div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.subject}</td>
			<td align="center">{$Dict.block}</td>
			<td align="center">{$Dict.teacher}</td>
			<td align="center">{$Dict.questions_count}</td>
			<td align="center">{$Dict.total_time}</td>
			<td align="center">{$Dict.points}</td>
			<td align="center">{$Dict.control_collection}</td>
			<td align="center">{$Dict.test_status}</td>
			{if $Access.edit eq 1}
			<td align="center">{$Dict.edit}</td>
			{/if}
			{if $Access.del eq 1}
			<td align="center">{$Dict.delete}</td>
			{/if}
		</tr>
		{foreach from=$Controls key=key item=Control}
		{assign var="ControlId" value=$Control.id}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td>{$Control.name}</td>
			<td align="center">{$Control.block}</td>
			<td>
				<a href="tests.php?act=teachers&id={$Control.id|crypt}">
					<img rel="{$Control.id|crypt}" class="editrow" src="images/edit.png" width="24">
				</a>
				{$TestTeachersList.$ControlId}
			</td>
			<td align="center">{$Control.qcount}</td>
			<td align="center">{$Control.ttime}</td>
			<td align="center">{$Control.point}</td>
			<td align="center">{$Control.cgroup}</td>
			<td align="center">{$Control.cstatus}</td>
			{if $Access.edit eq 1}
			<td align="center"><a href="#ex1" rel="modal:open"><img rel="{$Control.id|crypt}" class="editrow" src="images/edit.png" width="24"></a></td>
			{/if}
			{if $Access.del eq 1}
			<td align="center"><a href="#ex3" rel="modal:open"><img rel="{$Control.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a></td>
			{/if}
		</tr>
		{/foreach}
	</table>
	<script>
	
	var AddTestControlText = "{$Dict.add_test_controls}";
	var AddText = "{$Dict.add}";

	var UpdTestControlText = "{$Dict.upd_test_controls}";
	var UpdText = "{$Dict.edit}";

		{literal}
		$('#AddButton').click(function(event) {
				$('#ex1h2').html(AddTestControlText);
				$('#SubForm').val($('<div/>').html(AddText).text());
				$('#acttype').val(0);
				$('#eid').val("");
				$('#ex1subject').val(0);
				$('#ex1stestid').val(0);
				$('#ex1block').val(0);
				$('#ex1qcount').val("");
				$('#ex1ttime').val("");
				$('#ex1point').val("");
				$('#ex1cgroup').val(0);
				$('#ex1status').val(0);
		});
		$('.editrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$('#ex1h2').html(UpdTestControlText);
			$('#SubForm').val($('<div/>').html(UpdText).text());
			$('#acttype').val(1);
			$.get("ajax.php?act=gtestinfo&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#eid').val(sInfo[1]);
				$('#ex1subject').val(sInfo[3]);
				$('#ex1stestid').html(sInfo[4]);
				$('#ex1stestid').val(sInfo[11]);
				$('#ex1block').val(sInfo[5]);
				$('#ex1qcount').val(sInfo[6]);
				$('#ex1ttime').val(sInfo[7]);
				$('#ex1point').val(sInfo[8]);
				$('#ex1cgroup').val(sInfo[9]);
				$('#ex1status').val(sInfo[10]);
				//alert(sInfo[11]);
				//var sInfo = html.split("<&sec&>");
			});
		});

		$('.deltrow').click(function(event) {
		var RowId = $(this).attr("rel");
			$.get("ajax.php?act=gtestinfo&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#did').val(sInfo[1]);
				$('#ex3subject').val(sInfo[3]);
				$('#ex3stestid').html(sInfo[4]);
				$('#ex3block').val(sInfo[5]);
				$('#ex3qcount').val(sInfo[6]);
				$('#ex3ttime').val(sInfo[7]);
				$('#ex3point').val(sInfo[8]);
				$('#ex3cgroup').val(sInfo[9]);
				$('#ex3status').val(sInfo[10]);
				//alert(html);
				//var sInfo = html.split("<&sec&>");
			});
		});

		$('#ex1subject').click(function(event) {
		var SubjectId = $(this).val();
			$.get("ajax.php?act=gettest&sid=" + SubjectId, function(html) {
				$('#ex1stestid').html(html);
				
			});
		});

		$('#ex1block').change(function(event) {
		var GroupId = $('#ex1cgroup').val();
		var BlockNumber = $('#ex1block').val();
			if (BlockNumber > 0 && BlockNumber < 4)
			{
				$.get("ajax.php?act=getpoints&tnumber=" + GroupId+ "&tblock=" + BlockNumber, function(html) {
					var sInfo = html.split("<&sec&>");
					$('#ex1qcount').val(sInfo[2]);
					$('#ex1ttime').val(sInfo[2]);
					$('#ex1point').val(Math.round((sInfo[1]*sInfo[2]) * 100) / 100);
				});
			}
			else
			{
				$('#ex1qcount').val("");
				$('#ex1ttime').val("");
				$('#ex1point').val("");
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



{if $Action eq "teachers"}
	<div id="ex1" style="display:none;">
    <form method="post" action="">
		<div style="width: 550px">
				<h2>{$Dict.add_new_scale}</h2>
				<div class="forms">
				<label>{$Dict.teacher}:</label>
				<div>
					<select name="teacher" id="teacher">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Teachers key=skey item=Teacher}
							<option value="{$Teacher.id}">{$Teacher.name}</option>
						{/foreach}
					</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="{$Test.id|crypt}" name="testid" id="testid">
					<input type="hidden" value="{$Test.subject|crypt}" name="subjectid" id="subjectid">
					<input type="submit" name="SubTeacherAdd" value="{$Dict.save}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <div id="ex2" style="display:none;">
    <form method="post" action="">
		<div style="width: 550px">
				<h2>{$Dict.edit}</h2>
				<div class="forms">
				<label>{$Dict.teacher}:</label>
				<div>
					<select name="teacher" id="eteacher">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Teachers key=skey item=Teacher}
							<option value="{$Teacher.id}">{$Teacher.name}</option>
						{/foreach}
					</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="esid">
					<input type="hidden" value="{$Test.id|crypt}" name="testid" id="etestid">
					<input type="hidden" value="{$Test.subject|crypt}" name="subjectid" id="esubjectid">
					<input type="submit" name="SubTeacherUpd" value="{$Dict.edit}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <div id="ex3" style="display:none; background:#FF9999;">
        <form method="post" action="">
		<div style="width: 550px">
				<h2>{$Dict.delete}</h2>
				<div class="forms">
				<label>{$Dict.teacher}:</label>
				<div>
					<select name="teacher" id="dteacher">
						<option value="0">{$Dict.select}</option>
						{foreach from=$Teachers key=skey item=Teacher}
							<option value="{$Teacher.id}">{$Teacher.name}</option>
						{/foreach}
					</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="dsid">
					<input type="hidden" value="{$Test.id|crypt}" name="testid" id="dtestid">
					<input type="hidden" value="{$Test.subject|crypt}" name="subjectid" id="dsubjectid">
					<input type="submit" name="SubTeacherDel" value="{$Dict.delete}" class="myButton">
				</div>
		</div>
		</form>
  </div>
  
  <!-- Link to open the modal -->
	<div align="left">
			<a href="tests.php?act=controls&gid={$Test.groupid|crypt}" class="back">{$Dict.back_to_tests}</a>
	</div>  
  	<div>
  		<h2>{$Test.name}</h2>
  	</div>
  	<div class="actions">
		{if $Access.add eq 1}
		<a href="#ex1" rel="modal:open" class="myButton">{$Dict.attach_teacher}</a>
		{/if}
	</div>	
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.photo}</td>
			<td align="center">{$Dict.teacher}</td>
			{if $Access.edit eq 1}
			<td align="center">{$Dict.edit}</td>
			{/if}
			{if $Access.del eq 1}
			<td align="center">{$Dict.delete}</td>
			{/if}
		</tr>
		{foreach from=$TestTeachers key=key item=TTeacher}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td width="100" align="center"><img src="/pictures/{$TTeacher.photo}" height="100"></td>
			<td>{$TTeacher.name}</td>
			{if $Access.edit eq 1}
			<td align="center"><a href="#ex2" rel="modal:open"><img rel="{$TTeacher.id|crypt}" class="editrow" src="images/edit.png" width="24"></a></td>
			{/if}
			{if $Access.del eq 1}
			<td align="center"><a href="#ex3" rel="modal:open"><img rel="{$TTeacher.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a></td>
			{/if}
		</tr>
		{/foreach}
	</table>
	
<script>
	{literal}

		$('.editrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=test_teacher&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#esid').val(sInfo[1]);
				$('#etestid').val(sInfo[2]);
				$('#esubjectid').val(sInfo[3]);
				$('#eteacher').val(sInfo[4]);
			});
		});
		$('.deltrow').click(function(event) {
			var RowId = $(this).attr("rel");
			$.get("ajax.php?act=test_teacher&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#dsid').val(sInfo[1]);
				$('#dtestid').val(sInfo[2]);
				$('#dsubjectid').val(sInfo[3]);
				$('#dteacher').val(sInfo[4]);
			});
		});
	{/literal}
	</script>
	
	{/if}
	
{$bottom}


















