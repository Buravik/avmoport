{include file=base.tpl}
	<div align="left">
		{$HeadLinks}
	</div> 
	{if $Action eq "view"}

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30" rowspan="2">#</td>
			<td align="center" rowspan="2">{$Dict.xtb}</td>
			<td align="center" colspan="2">{$Dict.staff}</td>
		</tr>
		<tr class="titleth">
			<td align="center">{$Dict.today}</td>
			<td align="center">{$Dict.total}</td>
		</tr>
		{foreach from=$Departments key=key item=Department}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staff.php?act=departments&rid={$Department.region|crypt}" class="names faculties">{$Department.name}</a></td>
			<td align="right">{$Department.scount}</td>
			<td align="right">{$Department.scount_all}</td>
		</tr>
		{/foreach}
	</table>

	{/if}

	{if $Action eq "departments"}
	<h2>{$HeadDepartment.dname}</h2>
	<div class="actions">
		<a href="staff.php?act=stafflist&rid={$RegionId|crypt}" target="studlist" class="myButton">Xudud bo'yicha ro'yxatni yuklab olish</a>
	</div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30" rowspan="2">#</td>
			<td align="center" rowspan="2">{$Dict.xtb}</td>
			<td align="center" colspan="2">{$Dict.staff}</td>
		</tr>
		<tr class="titleth">
			<td align="center">{$Dict.today}</td>
			<td align="center">{$Dict.total}</td>
		</tr>
		{foreach from=$Departments key=key item=Department}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staff.php?act=schools&dcid={$Department.distcity|crypt}" class="names faculties">{$Department.name} </a></td>
			<td align="right">{$Department.scount}</td>
			<td align="right">{$Department.scount_all}</td>
		</tr>
		{/foreach}
	</table>
	<iframe id="studlist" name="studlist" width="100" height="50" style="display: none;">
		
	</iframe>
	{/if}
	
	{if $Action eq "schools"}
	<h2>{$HeadDepartment.name}</h2>
	<div class="actions">
		<a href="staff.php?act=stafflist&rid={$HeadDepartment.region|crypt}&dsid={$HeadDepartment.id|crypt}" target="studlist" class="myButton">XTB bo'yicha ro'yxatni yuklab olish</a>
	</div>
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.school}</td>
			<td align="center">{$Dict.staff}</td>
		</tr>
		{foreach from=$Schools key=key item=School}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="staff.php?act=staff&did={$School.id|crypt}" class="names faculties">{$School.school_number}-{$School.stype}</a></td>
			<td align="right">{$School.scount}</td>
		</tr>
		{/foreach}
	</table>
	<iframe id="studlist" name="studlist" width="100" height="50" style="display: none;">
		
	</iframe>
	{/if}
	
	{if $Action eq "staff"}
	<h2>{$HeadDepartment.school_number}-{$HeadDepartment.stypename}</h2>
	<div id="ex2" style="display:none;">
		<h2 id="form_title">{$Dict.add_staff}</h2>

    <form method="post" action="ajax.php?act=save_staff" name="StaffForm" id="StaffForm">
			<ul class="tabs-nav">
		    	<li class=""><a href="#tab-1" id="staftab1" rel="nofollow">{$Dict.personal_info}</a>
			    </li>
		    	<li class="tab-active"><a href="#tab-2" id="staftab2" rel="nofollow">{$Dict.proffession_info}</a>
		    	</li>
		    	<li class="tab-active"><a href="#tab-3"  id="staftab3" rel="nofollow">{$Dict.mo_qt_info}</a>
		    	</li>
			</ul>
			<div class="tabs-stage">
			    <div id="tab-1">
					<ul class="form-style-1">
					    <li>
					    	<label>{$Dict.s_lname}:<span class="required">*</span></label>
					    	<input type="text" name="lastname" id="lastname" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.s_fname}: <span class="required">*</span></label>
					    	<input type="text" name="firstname" id="firstname" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.s_sname}: <span class="required">*</span></label>
					    	<input type="text" name="surname" id="surname" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.birthdate}: <span class="required">*</span></label>
					    	<input type="text" name="birthdate" id="birthdate" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.nation}: <span class="required">*</span></label>
					        <select name="nation" id="nation" class="field-divided">
						        <option value="0">{$Dict.select}</option>
						        {foreach from=$Nations item=Nation key=nkey}
						        <option value="{$Nation.id}">{$Nation.name}</option>
					        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.gender}: <span class="required">*</span></label>
					        <select name="gender" id="gender" class="field-divided">
						        <option value="0">{$Dict.select}</option>
						        {foreach from=$Genders item=Gender key=nkey}
						        <option value="{$Gender.id}">{$Gender.name}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.passport_cer}: <span class="required">*</span></label>
					    	<input type="text" name="passport_cer" id="passport_cer" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.passport_num}: <span class="required">*</span></label>
					    	<input type="text" name="passport_num" id="passport_num" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.region}: <span class="required">*</span></label>
					        <select name="region" id="region" class="field-divided">
						        <option value="0">{$Dict.select}</option>
						        {foreach from=$Regions item=Region key=nkey}
						        <option value="{$Region.id}">{$Region.name}</option>
						        {/foreach}
					        </select>
					    </li>

					    <li>
					    	<label>{$Dict.distcity}: <span class="required">*</span></label>
					        <select name="distcity" id="distcity" class="field-divided">
						        <option value="0">{$Dict.select}</option>
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.email}:</label>
					    	<input type="text" name="email" id="email" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.phone}: <span class="required">*</span></label>
					    	<input type="text" name="phone" id="phone" class="field-divided" />
					    </li>

					    <li>
					        <input type="button" class="myButton" id="SubNext1" value="{$Dict.next}" />
					    </li>
					</ul>
			    </div>
			    <div id="tab-2" style="display: block;">
			        <ul class="form-style-1">
					    <li>
					    	<label>{$Dict.grad_univer}: <span class="required">*</span></label>
					        <select name="grad_univer" id="grad_univer" class="field-divided">
					        	<option value="0">{$Dict.select}</option>
						        {foreach from=$Univers item=Univer key=ukey}
						        <option value="{$Univer.id}">{$Univer.name}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.grad_univer_year}: <span class="required">*</span></label>
					    	<input type="text" name="grad_univer_year" id="grad_univer_year" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.dip_expertise}: <span class="required">*</span></label>
					    	<input type="text" name="dip_expertise" id="dip_expertise" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.dip_speciality}: <span class="required">*</span></label>
					    	<input type="text" name="dip_speciality" id="dip_speciality" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.dip_series}: <span class="required">*</span></label>
					    	<input type="text" name="dip_series" id="dip_series" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.dip_number}: <span class="required">*</span></label>
					    	<input type="text" name="dip_number" id="dip_number" class="field-divided" />
					    </li>
					    {*<li>
					    	<label>{$Dict.work_place_edu}: <span class="required">*</span></label>
					        <select name="work_place_edu" id="work_place_edu" class="field-divided">
					        <option value="Advertise">Advertise</option>
					        </select>
					    </li>*}
					    <li>
					    	<label>{$Dict.work_place_school}: <span class="required">*</span></label>
					        <select name="work_place_school" id="work_place_school" class="field-divided">
					        <option value="0">{$Dict.select}</option>
						        {foreach from=$Schools item=TheSchool key=ukey}
						        <option value="{$TheSchool.id}"{if $TheSchool.id eq $HeadDepartment.id} selected{/if}>{$TheSchool.school_number}-{$TheSchool.school_type}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.position}: <span class="required">*</span></label>
					        <select name="position" id="position" class="field-divided">
					        	<option value="0">{$Dict.select}</option>
						        {foreach from=$Positions item=Positions key=ukey}
						        <option value="{$Positions.id}">{$Positions.name}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.position_year}: <span class="required">*</span></label>
					    	<input type="text" name="position_year" id="position_year" class="field-divided" />
					    </li>
					    <li>
					        <input type="button" class="myButton" id="SubNext2"  value="{$Dict.next}" />
					    </li>
					</ul>
			    </div>
			    <div id="tab-3" style="display: block;">
			        <ul class="form-style-1">
					    <li>
					    	<label>{$Dict.last_qual_place}: </label>
					        <select name="last_qual_place" id="last_qual_place" class="field-divided">
					        	<option value="0">{$Dict.select}</option>
						        {foreach from=$QualCenters item=QualCenter key=ukey}
						        <option value="{$QualCenter.id}">{$QualCenter.name}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.last_qual_year}: </label>
					    	<input type="text" name="last_qual_year" id="last_qual_year" class="field-divided" />
					    </li>

					    <li>
					    	<label>{$Dict.mo_certificat_no}: </label>
					    	<input type="text" name="mo_certificat_no" id="mo_certificat_no" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.attestation_year}: </label>
					    	<input type="text" name="attestation_year" id="attestation_year" class="field-divided" />
					    </li>

					    <li>
					    	<label>{$Dict.attestation_result}: </label>
					    	<input type="text" name="attestation_result" id="attestation_result" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.attestation_category}: </label>
					        <select name="attestation_category" id="attestation_category" class="field-divided">
					        	<option value="0">{$Dict.select}</option>
						        {foreach from=$Classifications item=Classification key=ckey}
						        <option value="{$Classification.id}">{$Classification.name}</option>
						        {/foreach}
					        </select>
					    </li>

					    <li>
					    	<label>{$Dict.retraining_vuz}: </label>
					        <select name="retraining_vuz" id="retraining_vuz" class="field-divided">
					        	<option value="0">{$Dict.select}</option>
						        {foreach from=$Univers item=Univer key=ukey}
						        <option value="{$Univer.id}">{$Univer.name}</option>
						        {/foreach}
					        </select>
					    </li>
					    <li>
					    	<label>{$Dict.retraining_year}: </label>
					    	<input type="text" name="retraining_year" id="retraining_year" class="field-divided" />
					    </li>
					    <li>
					    	<label>{$Dict.retraining_dip_no}:</label>
					    	<input type="text" name="retraining_dip_no" id="retraining_dip_no" class="field-divided" />
					    </li>
					    <li>
							<input type="hidden" value="" name="staffid" id="staffid">
							<input type="hidden" value="" name="formaction" id="formaction">
					        <input type="button" class="myButton" id="SubStaff"  value="{$Dict.save}" />
					        
					    </li>
					</ul>

			    </div>
			</div>
		</form>




  </div>
  <div id="ex4" style="display:none; background-color: red;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.del_staff_info}</h2>
				<div class="forms">
				<div><b>{$Dict.fullname}:</b><input type="text" name="name" id="dname" value="" size="45"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="staffid" id="did">
					<input type="submit" name="SubDel" id="SubDel" value="{$Dict.delete}" class="myButton">
				</div>
		</div>
		</form>
  </div>

  <!-- Link to open the modal -->
	{if $SysMessage neq ""}
	  <div class="alert-box {$MessType}"><span>{$SysMessage}</span></div>
	{/if}

  	<div class="actions">
		<a href="#ex2" rel="modal:open" class="myButton" id="AddButton">{$Dict.add_staff}</a>
	</div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.thestaff}</td>
			<td align="center">{$Dict.position}</td>
			<td align="center">{$Dict.birthdate}</td>
			<td align="center">{$Dict.grad_univer}</td>
			<td align="center">{$Dict.dip_expertise}</td>
			<td align="center">{$Dict.dip_speciality}</td>
			<td align="center">{$Dict.last_qual_place}</td>
			<td align="center">{$Dict.last_qual_year}</td>
			<td align="center">{$Dict.mo_certificat_no}</td>
			<td align="center"><img src="images/edit.png" width="24"></td>
			<td align="center"><img src="images/delete.png" width="24"></td>
		</tr>
		{foreach from=$Students key=key item=Student}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td class="rank {$Student.rank_class}{if $Student.status eq 2} archived{/if}">
				{$Student.lastname} {$Student.firstname} {$Student.middlename}
			</td>
			<td>{$Student.position}</td>
			<td align="center">{$Student.birthdate}</td>
			<td>{$Student.grad_univer}</td>
			<td>{$Student.dip_expertise}</td>
			<td>{$Student.dip_speciality}</td>
			<td>{$Student.qual_center}</td>
			<td>{$Student.last_qual_year}</td>
			<td>{$Student.mo_certificat_no}</td>

			<td align="center">
				{if $Access.edit eq "1"}
				<a href="#ex2" rel="modal:open"><img rel="{$Student.id|crypt}" class="editrow" src="images/edit.png" width="24"></a>
				{else}
				<img src="images/edit.png" width="24" class="grayscale">
				{/if}
			</td>

			<td align="center">
				{if $Access.del eq "1"}
				<a href="#ex4" rel="modal:open"><img rel="{$Student.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a>
				{else}
				<img src="images/delete.png" width="24" class="grayscale">
				{/if}
			</td>
		</tr>
		{/foreach}
	</table>
	
	<div class="actions_left">

	</div>
	{if $Access.print eq 1}	
	<div id="printarea">
	</div>
	{/if}
	
	<script src="js/staff.js"></script>
	<script>
		{literal}
		
		// From http://learn.shayhowe.com/advanced-html-css/jquery

		// Change tab class and display content
		$('.tabs-nav a').on('click', function (event) {
		    event.preventDefault();
		    
		    $('.tab-active').removeClass('tab-active');
		    $(this).parent().addClass('tab-active');
		    $('.tabs-stage>div').hide();
		    $($(this).attr('href')).show();
		});

		$('#SubNext1').on('click', function (event) {
		   $('#staftab2').click();
		});
		$('#SubNext2').on('click', function (event) {
		   $('#staftab3').click();
		});

		/*function CheckNames(thisval)
		{
			return thisval.replace(/[^A-Z -']/, "");
		}

		$('#lastname, #firstname, #surname').bind('keyup',function(){
			$(this).val(CheckNames($(this).val()));
		});

		$('#passport_cer').bind('keyup',function(){
			$(this).val($(this).val().replace(/[^A-Z]/, ""));
		});

		$('#passport_num').bind('keyup',function(){
			$(this).val($(this).val().replace(/[^0-9]/, ""));
		});*/


(function($)
{
	//$('#lastname, #firstname, #surname').keyfilter(/[A-Za-z -]/);
	$('#lastname, #firstname, #surname').keyfilter(/[A-Z` -]/);
	$('#passport_cer').keyfilter(/[A-Z]/);
	$('#passport_num').keyfilter(/[0-9]/);
})(jQuery);

		//var InputFields    = $(':input');
		/*$(':input').on('paste', function() {
			alert($(this).val());
        },100);*/

		$(document).ready(function(){
		   $(':input').on("paste",function(e) {
		      e.preventDefault();
		   });
		});

		$("#birthdate").mask("99.99.9999");
		$("#phone").mask("+(99999)-9999999");
		$("#grad_univer_year").mask("9999");
		$("#position_year").mask("9999");
		$("#last_qual_year").mask("9999");
		$("#attestation_year").mask("9999");
		$("#retraining_year").mask("9999");

		$('.tabs-nav a:first').trigger('click'); // Default


		$("#region").change(function() {
			var RowId = $(this).val();
		    $.get("ajax.php?act=get_district&rid=" + RowId, function(html) {
		        $('#distcity').html(html);
		    });
		});	

		var RowCount = 0;
		$('#ChekAll').change(function() {
			var checkboxes = $(this).closest('table').find('td').find(':checkbox');
			if($(this).is(':checked')) {
					checkboxes.attr('checked', 'checked');
			} else {
					checkboxes.removeAttr('checked');
			}
		});
	
		$('#AddButton').click(function(event) {
			document.getElementById("StaffForm").reset();
			$('#SubStaff').val("{/literal}{$Dict.save}{literal}");
			$('#form_title').html("{/literal}{$Dict.add_staff}{literal}");
			$('#formaction').val("add");
		});

		$('.editrow').click(function(event) {
			var StudId = $(this).attr("rel");
			document.getElementById("StaffForm").reset();
			$('#SubStaff').val("{/literal}{$Dict.edit}{literal}");
			$('#form_title').html("{/literal}{$Dict.edit_staff}{literal}");
			$('#formaction').val("edit");

			$.get("ajax.php?act=staff_info&sid=" + StudId, function(html) {
				var sInfo = html.split("<&sec&>");
				$('#staffid').val(sInfo[30]);
				$('#lastname').val(sInfo[1]);
				$('#firstname').val(sInfo[2]);
				$('#surname').val(sInfo[3]);
				$('#birthdate').val(sInfo[4]);
				$('#nation').val(sInfo[5]);
				$('#gender').val(sInfo[6]);
				$('#passport_cer').val(sInfo[7]);
				$('#passport_num').val(sInfo[8]);
				$('#region').val(sInfo[9]);
				$('#distcity').html(sInfo[31]);

				$('#distcity').val(sInfo[10]);
				$('#email').val(sInfo[11]);
				$('#phone').val(sInfo[12]);
				$('#grad_univer').val(sInfo[13]);
				$('#grad_univer_year').val(sInfo[14]);
				$('#dip_expertise').val(sInfo[15]);
				$('#dip_speciality').val(sInfo[16]);
				$('#dip_series').val(sInfo[17]);
				$('#dip_number').val(sInfo[18]);
				$('#work_place_school').val(sInfo[19]);
				$('#position').val(sInfo[20]);
				$('#position_year').val(sInfo[21]);
				$('#last_qual_place').val(sInfo[22]);
				$('#last_qual_year').val(sInfo[23]);
				$('#mo_certificat_no').val(sInfo[24]);
				if (sInfo[25] != 0)
				{
					$('#attestation_year').val(sInfo[25]);
					$('#attestation_result').val(sInfo[26]);
					$('#attestation_category').val(sInfo[32]);
				}
				$('#retraining_vuz').val(sInfo[27]);
				
				if (sInfo[28] != 0)
				{
					$('#retraining_year').val(sInfo[28]);
					$('#retraining_dip_no').val(sInfo[29]);
				}
			});
		});
		$('.deltrow').click(function(event) {
			var StudId = $(this).attr("rel");
			$.get("ajax.php?act=staff_short_info&sid=" + StudId, function(html) {
				var sInfo = html.split("<&sec&>");

				$('#did').val(sInfo[1]);
				$('#dname').val($('<div/>').html(sInfo[2]).text());
			});
		});		

		{/literal}
		</script>
	{/if}

{if $Action eq "student"}
 <!-- Link to open the modal -->
  	<div align="left">
		<a href="groups.php?mid=DdFj" class="back">Sinflarga qaytish</a>
		<a href="students.php?act=students&gid={$smarty.get.gid}" class="back">O'quvchilar ro'yxati</a>
	</div> 
	<h4>{$Group.name}</h4>
	{if $SysMessage neq ""}
	  <div class="alert-box {$MessType}"><span>{$SysMessage}</span></div>
	{/if}

  	<div class="actions">
		<a href="" class="myButton">Yangilash</a>
	</div>

	<div align="center">
		<h2>{$Student}</h2>
	</div>

	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
					<tr class="titleth"> 
						<td align="center" width="30">#</td>
						<td align="center">O'tish vaqti</td>
						<td align="center">Kirish/chiqish</td>
						<td align="center">SMS</td>
					</tr>
					{foreach from=$EnExArr key=ekey item=EnEx}
					<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
						<td align="center">{$ekey+1}</td>
						<td align="center">{$EnEx.enex_date}</td>
						<td align="center" width="30"><img src="images/enex{$EnEx.enex_type}.png" width="24"></td>
						<td>{$EnEx.status}</td>
					</tr>
					{/foreach}
				</table>
			</td>
			<td width="50%" valign="top">
				<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
					<tr class="titleth"> 
						<td align="center" width="30">#</td>
						<td align="center">O'tish vaqti</td>
						<td align="center">Kirish/chiqish</td>
						<td align="center">SMS vaqti</td>
						<td align="center">Telefon</td>
						<td align="center">Status</td>
					</tr>
					{foreach from=$SmsLog key=skey item=Log}
					<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
						<td align="center">{$skey+1}</td>
						<td align="center">{$Log.enex_date}</td>
						<td align="center" width="30"><img src="images/enex{$Log.enex_type}.png" width="24"></td>
						<td align="center">{$Log.send_date}</td>
						<td align="center">{$Log.parent_phone}</td>
						<td>{$Log.status}</td>
					</tr>
					{/foreach}
				</table>
			</td>
		</tr>
	</table>
{/if}

		
{if $Action eq "search"}
	<div id="ex2" style="display:none;">
    <form method="post" action="" name="addform">
		<div>
				<h2>{$Dict.search_staff}</h2>
				<div class="forms">
				<label>{$Dict.lastname}:</label><div><input type="text" name="lastname" id="lname" value="" size="20"></div>
				<label>{$Dict.firstname}:</label><div><input type="text" name="firstname" id="fname" value="" size="20"></div>
				<label>{$Dict.surname}:</label><div><input type="text" name="surname" id="sname" value="" size="20"></div>
				<label>{$Dict.passport_cer}:</label><div><input type="text" name="passport_cer" maxlength="10" id="passport_cer" value="" size="20"></div>
				<label>{$Dict.passport_num}:</label><div><input type="text" name="passport_num" id="passport_num" value="" size="20"></div>
				</div>
				<div class="btnbox">
					<input type="submit" name="SubSearch" value="Izla" class="myButton">
				</div>
		</div>
		</form>
  </div>
 
  <!-- Link to open the modal -->
  {if $SysMessage neq ""}
  <div class="alert-box {$MessType}"><span>{$SysMessage}</span></div>
  {/if}

  <div class="actions">
		<a href="#ex2" rel="modal:open" class="myButton" id="AddButton">Izlash</a>
	</div>
	<!-- <div class="info_type">
		{assign var=keyword value=bybase$StaffSett}
		{$Dict.$keyword}
	</div> -->
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.thestaff}</td>
			<td align="center">{$Dict.position}</td>
			<td align="center">{$Dict.birthdate}</td>
			<td align="center">{$Dict.grad_univer}</td>
			<td align="center">{$Dict.dip_expertise}</td>
			<td align="center">{$Dict.dip_speciality}</td>
			<td align="center">{$Dict.last_qual_place}</td>
			<td align="center">{$Dict.last_qual_year}</td>
			<td align="center">{$Dict.mo_certificat_no}</td>
		</tr>
		{foreach from=$Students key=key item=Student}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td class="rank {$Student.rank_class}{if $Student.status eq 2} archived{/if}">
				<a href="staff.php?act=staff&did={$Student.work_place_school|crypt}">{$Student.lastname} {$Student.firstname} {$Student.middlename}</a>
			</td>
			<td>{$Student.position}</td>
			<td align="center">{$Student.birthdate}</td>
			<td>{$Student.grad_univer}</td>
			<td>{$Student.dip_expertise}</td>
			<td>{$Student.dip_speciality}</td>
			<td>{$Student.qual_center}</td>
			<td>{$Student.last_qual_year}</td>
			<td>{$Student.mo_certificat_no}</td>
		</tr>
		{/foreach}
	</table>
	
	{/if}	


	{if $Action eq "import"}
  <div align="left">
			<a href="tests.php?act=groups" class="back">Ñèíîâëàðãà êàéòèø</a>
			<a href="staff.php?act=students&gid={$GroupId}" class="back">Õîäèìëàð ðóéõàòè</a>
	</div> 
		{if $smarty.get.step eq ""}
		<form action="staff.php?act=import&gid={$GroupId}&step=2" method="post">
			<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
				<tbody><tr>
					<td colspan="2" align="center" bgcolor="#f9f9f9"><b>Õîäèìëàðíè èìïîðò êèëèø</b></td>
				</tr>
				<tr>
					<td><br>
					</td>
				</tr>
				<tr>
					<td>
					<table cellpadding="2" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
					{assign var=OddRow value=D3E5B8}
					{assign var=EvnRow value=FFFFFF}
					
					{assign var=MenName value=erkak}
					{assign var=WomanName value=ayol}
					
					{assign var=RowColor value=""}
					{foreach from=$FileContent key=key item=Content}
							{if $Content.0 eq 'ID_MAP'}
							<tr bgcolor="FFFFFF">
								<td width="15">
								<input type="hidden" name="" value="4">
								<input type="checkbox" name="">
								</td>
								<td width="30" align="right"><b>0.</b></td>
									<td>ID_MAP</td>
									<td>ID_ POSITION</td>
									<td>ID_ RANG</td>
									<td>ID_ NATION</td>
									<td>ID_ FAMILY</td>
									<td>ID_ EDUCATION</td>
									<td>ID_ STATUS</td>
									<td>YEAR BIRTH</td>
									<td>IN_ ORGAN</td>
									<td>Ô.È.Ø.</td>
									<td>Æèíñè</td>
								</tr>
							{else}
							<tr bgcolor="{cycle values=$EvnRow,$OddRow}">
								<td width="15">
								<input type="hidden" name="id_map[{$key}]" value="{$Content.0}">
								<input type="checkbox" name="ColCb[{$key}]" checked>
								</td>

								<td width="30" align="right"><b>{$key}.</b></td>
								<td width="30" align="right"><b>{$Content.0}</b></td>
								<td>
								<select name="position_id[{$key}]" style="width: 130px;">
									{foreach from=$Positions item=Position key=pkey}
										<option value="{$Position.id}"{if $Content.1 eq $Position.id} selected{/if}>{$Position.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="rang_id[{$key}]" style="width: 80px;">
									{foreach from=$Ranks item=Rank key=rkey}
										<option value="{$Rank.id}"{if $Content.2 eq $Rank.id} selected{/if}>{$Rank.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="nation_id[{$key}]" style="width: 50px;">
									{foreach from=$Nations item=Nation key=rkey}
										<option value="{$Nation.id}"{if $Content.3 eq $Nation.id} selected{/if}>{$Nation.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="family_status_id[{$key}]" style="width: 80px;">
									{foreach from=$FamilyStatuses item=Fstatus key=rkey}
										<option value="{$Fstatus.id}"{if $Content.4 eq $Fstatus.id} selected{/if}>{$Fstatus.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="education_id[{$key}]" style="width: 80px;">
									{foreach from=$Educations item=Education key=rkey}
										<option value="{$Education.id}"{if $Content.5 eq $Education.id} selected{/if}>{$Education.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="status_id[{$key}]" style="width: 80px;">
									{foreach from=$Statuses item=Status key=rkey}
										<option value="{$Status.id}"{if $Content.6 eq $Status.id} selected{/if}>{$Status.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<textarea class="Area{$Content.odd_even}" rows="1" name="birth_year[{$key}]" cols="4">{$Content.7}</textarea>
								</td>
								<td>
								<textarea class="Area{$Content.odd_even}" rows="1" name="in_year[{$key}]" cols="4">{$Content.8}</textarea>
								</td>
								<td>
								<textarea class="Area{$Content.odd_even}" rows="1" name="name[{$key}]" cols="25">{$Content.9}</textarea>
								</td>
								<td>
								<select name="gender[{$key}]" style="width: 80px;">
									{foreach from=$Genders item=Gender key=rkey}
										<option value="{$Gender.id}"{if $Content.10 eq $Gender.id} selected{/if}>{$Gender.name}</option>
									{/foreach}
								</select>
								</td>
							</tr>
							{/if}
						{/foreach}
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input value="Êåéèíãè" name="insert_faculty" class="ButtonYellow" type="submit"><br><br></td>
				</tr>						
			</tbody>
		</table>
		</form>
		{else}
		<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
						<tbody><tr>
							<td colspan="2" align="center" bgcolor="#f9f9f9"><b>KOLLEDJ XAQIDAGI MA"LUMOTLARNI IMPORT QILISH</b></td>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						<tr>
							<td>
							<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
							{assign var=OddRow value=D3E5B8}
							{assign var=EvnRow value=FFFFFF}
							{assign var=RowColor value=""}
							{foreach from=$ContentArr key=key item=Content}
								<tr bgcolor="{cycle values=$EvnRow,$OddRow}">
									<td width="30" align="right"><b>{$key+1}.</b></td>
									<td>
									{$Content.0}
									</td>
									<td width="15"><b>{$Content.2}</b></td>
								</tr>
								{/foreach}
							</table>
							</td>
						</tr>
					</tbody></table>
		{/if}				
	{/if}

	<!-- ______________________IMPOST-STAFF______________________ -->
	{if $Action eq "import_staff"}
  <div align="left">
			<a href="tests.php?act=groups" class="back">Ñèíîâëàðãà êàéòèø</a>
			<a href="staff.php?act=students&gid={$GroupId}" class="back">Õîäèìëàð ðóéõàòè</a>
	</div> 
		{if $smarty.get.step eq ""}
		<form action="staff.php?act=import_staff&gid={$GroupId}&step=2" method="post">
			<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
				<tbody><tr>
					<td colspan="2" align="center" bgcolor="#f9f9f9"><b>Õîäèìëàðíè òàõðèðëàø</b></td>
				</tr>
				<tr>
					<td><br>
					</td>
				</tr>
				<tr>
					<td>
					<table cellpadding="2" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
					{assign var=OddRow value=D3E5B8}
					{assign var=EvnRow value=FFFFFF}
					
					{assign var=MenName value=erkak}
					{assign var=WomanName value=ayol}
					
					{assign var=RowColor value=""}
					{foreach from=$FileContent key=key item=Content}
							{if $Content.0 eq 'ID_MAP'}
							<tr bgcolor="FFFFFF">
								<td width="15">
								<input type="hidden" name="" value="4">
								<input type="checkbox" name="">
								</td>
								<td width="30" align="right"><b>0.</b></td>
									<td>ID_MAP</td>
									<td>ID_ POSITION</td>
									<td>ID_ RANG</td>
									<td>ID_ NATION</td>
									<td>ID_ FAMILY</td>
									<td>ID_ EDUCATION</td>
									<td>ID_ STATUS</td>
									<td>YEAR BIRTH</td>
									<td>IN_ ORGAN</td>
									<td>Ô.È.Ø.</td>
									<td>Æèíñè</td>
								</tr>
							{else}
							<tr {if $StaffExit.$key neq 1}bgcolor="red"{else}bgcolor="{cycle values=$EvnRow,$OddRow}"{/if}>
								<td width="15">
								<input type="hidden" name="id_map[{$key}]" value="{$Content.0}">
								<input type="checkbox" name="ColCb[{$key}]" {if $StaffExit.$key eq 1} checked{/if}>
								</td>

								<td width="30" align="right"><b>{$key}.</b></td>
								<td width="30" align="right"><b>{$Content.0}</b></td>
								<td>
								<select name="position_id[{$key}]" style="width: 130px;">
									{foreach from=$Positions item=Position key=pkey}
										<option value="{$Position.id}"{if $Content.1 eq $Position.id} selected{/if}>{$Position.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="rang_id[{$key}]" style="width: 80px;">
									{foreach from=$Ranks item=Rank key=rkey}
										<option value="{$Rank.id}"{if $Content.2 eq $Rank.id} selected{/if}>{$Rank.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="nation_id[{$key}]" style="width: 50px;">
									{foreach from=$Nations item=Nation key=rkey}
										<option value="{$Nation.id}"{if $Content.3 eq $Nation.id} selected{/if}>{$Nation.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="family_status_id[{$key}]" style="width: 80px;">
									{foreach from=$FamilyStatuses item=Fstatus key=rkey}
										<option value="{$Fstatus.id}"{if $Content.4 eq $Fstatus.id} selected{/if}>{$Fstatus.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="education_id[{$key}]" style="width: 80px;">
									{foreach from=$Educations item=Education key=rkey}
										<option value="{$Education.id}"{if $Content.5 eq $Education.id} selected{/if}>{$Education.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<select name="status_id[{$key}]" style="width: 80px;">
									{foreach from=$Statuses item=Status key=rkey}
										<option value="{$Status.id}"{if $Content.6 eq $Status.id} selected{/if}>{$Status.name}</option>
									{/foreach}
								</select>
								</td>
								<td>
								<textarea class="Area{$Content.odd_even}" rows="1" name="birth_year[{$key}]" cols="4">{$Content.7}</textarea>
								</td>
								<td>
								<textarea class="Area{$Content.odd_even}" rows="1" name="in_year[{$key}]" cols="4">{$Content.8}</textarea>
								</td>
								<td>&nbsp;<span style="font-size: 12px; padding-left: 1px;">{$Content.9}</span>
								{if $StaffExit.$key eq 1}
								<select name="staff[{$key}]" style="width: 250px;">
									{foreach from=$StaffOption.$key item=Sttff key=fkey}
										<option value="{$Sttff.id}">{$Sttff.name}</option>
									{/foreach}
								</select>
								{else}
								<select name="staff[{$key}]" style="width: 250px;">
									{foreach from=$StaffOptionLow.$key item=Sttff key=fkey}
										<option value="{$Sttff.id}">{$Sttff.name}</option>
									{/foreach}
								</select>
								{/if}
								<textarea class="Area{$Content.odd_even}" rows="1" name="staff_name[{$key}]" cols="4">{$Content.9}</textarea>
								</td>
								<td>
								<select name="gender[{$key}]" style="width: 80px;">
									{foreach from=$Genders item=Gender key=rkey}
										<option value="{$Gender.id}"{if $Content.10 eq $Gender.id} selected{/if}>{$Gender.name}</option>
									{/foreach}
								</select>
								</td>
							</tr>
							{/if}
						{/foreach}
					</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input value="Êåéèíãè" name="insert_faculty" class="ButtonYellow" type="submit"><br><br></td>
				</tr>						
			</tbody>
		</table>
		</form>
		{else}
		<table align="center" bgcolor="#f9f9f9" border="0" width="800" cellpadding="3" cellspacing="0">
						<tbody><tr>
							<td colspan="2" align="center" bgcolor="#f9f9f9"><b>KOLLEDJ XAQIDAGI MA"LUMOTLARNI IMPORT QILISH</b></td>
						</tr>
						<tr>
							<td><br>
							</td>
						</tr>
						<tr>
							<td>
							<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="74BA08">
							{assign var=OddRow value=D3E5B8}
							{assign var=EvnRow value=FFFFFF}
							{assign var=RowColor value=""}
							{foreach from=$ContentArr key=key item=Content}
								<tr bgcolor="{cycle values=$EvnRow,$OddRow}">
									<td width="30" align="right"><b>{$key+1}.</b></td>
									<td>
									{$Content.0}
									</td>
									<td width="15"><b>{$Content.2}</b></td>
								</tr>
								{/foreach}
							</table>
							</td>
						</tr>
					</tbody></table>
		{/if}				
	{/if}
	<!-- ______________________IMPOST-STAFF______________________ -->

{$bottom}