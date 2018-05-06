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
			<td><a href="results.php?act=directions&fid={$Faculty.id|crypt}" class="names faculties">{$Faculty.name}</a></td>
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
			<td><a href="results.php?act=groups&did={$Direction.id|crypt}" class="names directions">{$Direction.name}</a></td>
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
			<td><a href="results.php?act=controls&gid={$Group.id|crypt}" class="names groups">{$Group.name}</a></td>
		</tr>
		{/foreach}
	</table>
	{/if}
	{if $Action eq "controls"}
  <div id="ex1" style="display:none;">
    <form method="post" action="">
		<div>
				<h2>{$Dict.attach_responsibles}</h2>
				<div class="forms">
				{foreach from=$Respons key=key item=Resp}
				<div>
					{$key+1}.
					<select name="response[]" id="resp{$key+1}">
						<option value="0" class="arch">{$Dict.select}</option>
						{foreach from=$Responsibles key=key2 item=Responsible}
						<option value="{$Responsible.id}"{if $Responsible.arch eq 1}class="arch"{/if}>{$Responsible.name}{if $Responsible.rank neq ""} ({$Responsible.rank}){/if}</option>
						{/foreach}
					</select>
				</div>
				{/foreach}
				</div>
				<div class="btnbox">
					<input type="hidden" name="protocol" id="protocol" value="0">
					<input type="submit" name="SubResponse" value="{$Dict.save}" class="myButton">
				</div>
		</div>
		</form>
  </div>

	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
	{foreach from=$ControlArr key=key item=Controls}
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.subject}</td>
			<td align="center">{$Dict.block}</td>
			<td align="center">{$Dict.questions_count}</td>
			<td align="center">{$Dict.total_time}</td>
			<td align="center">{$Dict.points}</td>
    </tr>
    {foreach from=$Controls key=key2 item=Control}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key2+1}</td>
			<td>{$Control.name}</td>
			<td align="center">{$Control.block}</td>
			<td align="center">{$Control.qcount}</td>
			<td align="center">{$Control.ttime}</td>
			<td align="center">{$Control.point}</td>
		</tr>
    {/foreach}
    <tr bgcolor="yellow"><td>&nbsp;</td>
      <td>
				{if $Access.protocol eq 1}	
				<a href="results.php?act=results&gid={$GroupId|crypt}&tlist={$TestList.$key}"><b>{$Dict.total_protocol}</b></a>
				{/if}
			</td>
      <td colspan=2 align="center">
				{if $Access.appeal eq 1}	
				<a href="results.php?act=appeal&gid={$GroupId|crypt}&tlist={$TestList.$key}"><b>{$Dict.appeal}</b></a>
				{/if}
			</td>
      <td colspan="2" align="center">
				{if $Access.responsibles eq 1}	
				<a href="#ex1" rel="modal:open" class="response" list="{$TestList.$key}"><b>{$Dict.responsibles}</b></a>
				{/if}
			</td>
    </tr>
		<tr>
			<td colspan="6" bgcolor="white">&nbsp;</td>
		</tr>
	{/foreach}
	</table>
	<script>
		var GroupId = {$GroupId};
		{literal}
		$('.response').click(function(event) {
			var ContIds = $(this).attr("list");
			$.get("ajax.php?act=responsibles&gid=" + GroupId +"&cid="+ContIds, function(html) {
				var Response = html.split(",");
				$('#protocol').val(Response[0]);
				$('#resp1').val(Response[1]);
				$('#resp2').val(Response[2]);
				$('#resp3').val(Response[3]);
				$('#resp4').val(Response[4]);
				$('#resp5').val(Response[5]);
				$('#resp6').val(Response[6]);
				$('#resp7').val(Response[7]);
				$('#resp8').val(Response[8]);
			});
		});		
		{/literal}
	</script>
	
	{/if}
	
	
  {if $Action eq "results"}
	<div class="actions_left">
	<a id="pbutton" class="myButton">{$Dict.print}</a>
	</div>
	<div id="printarea">
	<link rel="stylesheet" href="css/print.css">
  <div class="headnamebox">
  <div class="headnames">{$Dict.test_type} : <span>{$FDGNames.dname}</span></div>
  <div class="headnames">{$Dict.corp} : <span>{$FDGNames.gname}</span></div>
  <div class="headnames"><span>{$ControlNames}</span></div>
  <div class="headnames">{$Dict.max_points} : <span>{$MaxPoints}</span> {$Dict.min_points} : <span>{$MinPoints}</span> </div>
  </div>
 
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.fullname}</td>
      <td align="center">{$Dict.truec}</td>
      <td align="center">{$Dict.falsec}</td>
      {foreach from=$ControlInfo key=kid item=Cname}
      <td colspan=2 align="center">{$Cname.name}</td>
      {/foreach}
      <td align="center">{$Dict.total_points_br}</td>
      <td align="center">%</td>
		</tr>
		{foreach from=$Results key=key item=Result}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td>{$Result.name}</td>
      {assign var=thisresult value=$Result.id}
      <td align="right">{$Result.true_answers}</td>
      <td align="right">{$Result.false_answers}</td>
      {foreach from=$ControlResults.$thisresult key=cid item=cval}
      <td align="center">{$cval.true_answers}</td>
      <td align="center">{$cval.points}</td>
      {/foreach}
      <td align="right"><b>{$Result.total_points}</b></td>
      <td align="right"><b>{$Result.total_points/$MaxPoints*100|round:1}</b></td>
		</tr>
		{/foreach}
	</table>
<br>
		<table align="center" border="0">
		{foreach from=$Marks key=key item=Mark}
		{assign var=themark value=$Mark.mark}
		<tr><td>«{$Mark.name}»</td><td>__<u>{$MarkCalc.$themark}</u>__</td></tr>
		{/foreach}
	</table>
<br>
<div class="headnamebox">
  <div class="headnames">{$Dict.rating}</div>
</div>
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.teacher}</td>
      <td align="center">{$Dict.subject}</td>
      <td align="center">{$Dict.scient_degree}</td>
      <td align="center">{$Dict.position}</td>
      <td align="center">{$Dict.rating}</td>
		</tr>
		{foreach from=$Teachers key=tkey item=Teacher}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$tkey+1}</td>
			<td>{$Teacher.name}</td>
			<td>{$Teacher.SUBJECT}</td>
			<td>{$Teacher.rank}</td>
			<td>{$Teacher.POSITION}</td>
			<td align="right">{$Teacher.rating/$Teacher.rates_count/10}</td>
		</tr>
		{/foreach}
	</table>
		<table align="center" cellspacing=10>
			<tr>
				<td><b>{$Dict.responsibles}</b></td><td style="width:100px;"></td><td></td>
			</tr>
			{foreach from=$Responsibles key=rkey item=rval}
			<tr>
				<td>{$rval.rname} <b>{$rval.name}</b></td>
				<td></td>
				<td>______________________</td>
			</tr>
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

{/if}

{if $Action eq "appeal"}
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30">#</td>
			<td align="center">{$Dict.fullname}</td>
		</tr>
		{foreach from=$StudentResults key=key item=Result}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="results.php?act=answers&rid={$Result.id|crypt}&sid={$Result.userid|crypt}">{$Result.name}</a></td>
		</tr>
		{/foreach}
	</table>
{/if}

{if $Action eq "answers"}
<div align="center"><h2>{$Result.name}</h2></div>
<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		{assign var=thiscid value=0}
		{foreach from=$Answers key=key item=Answer}
		{if $thiscid neq $Answer.controlid}
		<tr class="titleth"> 
			<td align="center" colspan="4">{$Answer.cname}</td>
		</tr>
		{assign var=thiscid value=$Answer.controlid}
		{/if}
		<tr bgcolor="FFFFFF">
			<td rowspan=2 valign="top">{$key+1}</td>
			<td>{$Dict.question}:</td>
			<td colspan=2>{$Answer.question}</td>
		</tr>
		<tr bgcolor="E4EAF2">
			<td>{$Dict.answer}:</td>
			<td>{$Answer.answer}:</td>
			{if $Answer.istrue eq 1}
			<td class="true_answer"><img src="images/true.png" width="32"></td>
			{else}
			<td class="false_answer"><img src="images/false.png" width="32"></td>
			{/if}
		</tr>
		
		{/foreach}
		{foreach from=$StudentResults key=key item=Result}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td><a href="results.php?act=answers&rid={$Result.id|crypt}&sid={$Result.userid|crypt}">{$Result.name}</a></td>
		</tr>
		{/foreach}
	</table>
{/if}
{$bottom}


















