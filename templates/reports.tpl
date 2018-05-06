{include file=base.tpl}
  <div id="ex1" style="display:none;">
    <form method="post" action="" name="FormParam">
		<div>
				<h2>{$Dict.change_report_params}</h2>
				<div class="forms">
				<div>
						{$Dict.begin}: <input type=text value="{$ReportParams.bdate2}" name=bdate maxlength=10 size=10 id='bdate'>&nbsp;
						{literal}
						<script>new tcal ({'formname': 'FormParam','controlname': 'bdate'});</script>
						{/literal}
						{$Dict.begin}: <input type=text value="{$ReportParams.edate2}" name=edate maxlength=10 size=10 id='edate'>&nbsp;
						{literal}
						<script>new tcal ({'formname': 'FormParam','controlname': 'edate'});</script>
						{/literal}
				</div>
				<div>
						{$Dict.subject} 1:
						<select name="subject1">
								<option value=0>{$Dict.select}</option>
								{foreach from=$Subjects key=key item=Subject}
								<option value="{$Subject.id}"{if $ReportParams.subject1 eq $Subject.id} selected{/if}>{$Subject.sname}</option>
								{/foreach}
						</select>
				</div>
				<div>
						{$Dict.subject} 2:
						<select name="subject2">
								<option value=0>{$Dict.select}</option>
								{foreach from=$Subjects key=key item=Subject}
								<option value="{$Subject.id}"{if $ReportParams.subject2 eq $Subject.id} selected{/if}>{$Subject.sname}</option>
								{/foreach}
						</select>
				</div>
				<div>
						{$Dict.subject} 3:
						<select name="subject3">
								<option value=0>{$Dict.select}</option>
								{foreach from=$Subjects key=key item=Subject}
								<option value="{$Subject.id}"{if $ReportParams.subject3 eq $Subject.id} selected{/if}>{$Subject.sname}</option>
								{/foreach}
						</select>
				</div>
				</div>
				<div class="btnbox">
					<input type="submit" name="SubForm" value="{$Dict.save}" class="myButton">
				</div>
		</div>
		</form>
  </div>

	<div class="actions_left" style="display: none">
	<a id="pbutton" class="myButton">{$Dict.print}</a>
	<a href="#ex1" rel="modal:open" class="myButton">{$Dict.params}</a>
	</div>
	<div id="printarea">

  <div class="headnamebox">
  <div class="headnames">Umimiy ma'lumot</div>
  </div>
 
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td colspan="2">&nbsp;</td>
	      	{foreach from=$SchoolTypes item=sType key=skey}
		      	<td align="center" colspan="8">{$sType.sname}</td>
	      	{/foreach}
			<td align="center" colspan="2">Jami</td>
      	</tr>
      	<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center" class="border-green">Xudud</td>
      		{foreach from=$SchoolTypes item=sType key=skey}
	      	{foreach from=$Positions item=Position key=pkey}
		      	<th class="rotate"><div><span>{$Position.sname}</span></div></th>
	      	{/foreach}
	      	<th class="rotate border-purple"><div><span>Maktablar</span></div></th>
	      	<th class="rotate border-red"><div><span>Xodimlar</span></div></th>
	      	{/foreach}
	      	<th class="rotate"><div><span>Maktablar</span></div></th>
	      	<th class="rotate"><div><span>Xodimlar</span></div></th>
      	</tr>
      	{assign var="TotalSchools" value=0}	
      	{assign var="TotalStaff" value=0}	
      	{foreach from=$Results1 item=Result1 key=key1}
      	<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td>{$key1}</td>	
			{if $Action eq 'rep1'}
			<td class="border-green"><a href="reports.php?act=rep2&rid={$key1}&mid=HssItt">{$Result1.0}</a></td>
			{else}
			<td class="border-green"><a href="staff.php?act=schools&dcid={$key1|crypt}">{$Result1.0}</a></td>
			{/if}
			{foreach from=$SchoolTypes item=sType key=skey}
				{assign var="stype" value=$sType.id}
		      	{foreach from=$Positions item=Position key=pkey}
					{assign var="ptype" value=$Position.id}
			      	<td class="scounts">
			      		{$Results3.$key1.$stype.$ptype}
			      	</td>
		      	{/foreach}
		      	<td class="scounts black border-purple">
		      		{$Schools.$key1.$stype}
		      	</td>
		      	<td class="scounts black  border-red">
		      		{$Results2.$key1.$stype}
		      	</td>
			    {assign var="TotalSchools" value=$TotalSchools+$Schools.$key1.$stype}	
		      	{assign var="TotalStaff" value=$TotalStaff+$Results2.$key1.$stype}	
	      	{/foreach}	
	      	<td class="scounts black">{$Result1.2}</td>
	      	<td class="scounts black">{$Result1.1}</td>
      	</tr>

      	{/foreach}
      	<tr class="titleth"> 
			<td align="center" colspan="2" class="scounts black border-green">Jami:</td>
	      	{foreach from=$SchoolTypes item=sType key=skey}
				{assign var="stype" value=$sType.id}
		      	{foreach from=$Positions item=Position key=pkey}
					{assign var="ptype" value=$Position.id}
			      	<td class="scounts">
			      		{$StaffTotal.$stype.$ptype}
			      	</td>
		      	{/foreach}
		      	<td class="scounts black border-purple">
		      		{$SchoolTotal.$stype.0}
		      	</td>
		      	<td class="scounts black border-red">
		      		{$SchoolTotal.$stype.1}
		      	</td>
	      	{/foreach}
			<td align="center" class="scounts">{$TotalSchools}</td>
      		<td align="center" class="scounts">{$TotalStaff}</td>
      	</tr>
	</table>
<br>
		<table align="center" border="0">
		{foreach from=$Marks key=key item=Mark}
		{assign var=themark value=$Mark.mark}
		<tr><td>«{$Mark.name}»</td><td>__<u>{$MarkCalc.$themark}</u>__</td></tr>
		{/foreach}
	</table>
		
	</div>
	<script>
			{literal}
		$('#pbutton').click(function(event) {
			
					$('#printarea').printElement();
					
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
		{/literal}
	</script>
	
{$bottom}


















