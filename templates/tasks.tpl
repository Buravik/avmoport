{include file=base.tpl}

	<div class="headlinks">{$HeadLinks}</div>
{if $Action eq "view"}

 <!-- Modal HTML embedded directly into document -->
  <div id="ex1" style="display:none;">
    <form method="post" action="tasks.php?act=import">
		<div>
				<h2>{$Dict.add_test_questions}</h2>
				<div class="forms">
					<div>
					<textarea name="theText" rows=20 cols=96></textarea>
					<input type="hidden" value="" name="testid" id="testid">
					</div>
					<label>{$Dict.question_lang}:</label>
					<div>
						<select name="qlang" id="qlang">
							{foreach from=$Languages key=key item=Language}
							<option value="{$Language.id}">{$Language.name}</option>
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

	<div id="ex2" style="display:none;">
    <form method="post" action="">
		<div style="width: 550px">
				<h2>{$Dict.add_new_tasks}</h2>
				<div class="forms">
					<label>{$Dict.subject}:</label>
					<div>
						<select name="subject" id="subject">
							<option value="0">{$Dict.select}</option>
							{foreach from=$Subjects key=key item=Subject}
							<option value="{$Subject.id}">{$Subject.name}</option>
							{/foreach}
						</select>
					</div>
					<label>{$Dict.comment}:</label><div><input type="text" name="comment" id="comment" value="" size="47"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="sid">
					<input type="submit" name="SubAdd" value="{$Dict.add}" class="myButton">
				</div>
		</div>
		</form>
  </div>

	<div id="ex3" style="display:none;">
    <form method="post" action="">
		<div style="width: 550px">
				<h2>{$Dict.edit_test_tasks}</h2>
				<div class="forms">
					<label>{$Dict.subject}:</label>
					<div>
						<select name="subject" id="esubject">
							<option value="0">{$Dict.select}</option>
							{foreach from=$Subjects key=key item=Subject}
							<option value="{$Subject.id}">{$Subject.name}</option>
							{/foreach}
						</select>
					</div>
					<label>{$Dict.comment}:</label><div><input type="text" name="comment" id="ecomment" value="" size="47"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="eid">
					<input type="submit" name="SubEdit" value="{$Dict.edit}" class="myButton">
				</div>
		</div>
		</form>
  </div>

	<div id="ex4" style="display:none; background: red;">
		<div id="messagebox" style="background: #fff;">
			<div class="message_error">
				{$Dict.cant_delete_task}
			</div>
		</div>
		<div id="formbox">
    <form method="post" action="">
		<div style="width: 550px;">
				<h2>{$Dict.delete_test_tasks}</h2>
				<div class="forms">
					<label>{$Dict.subject}:</label>
					<div>
						<select name="subject" id="dsubject">
							<option value="0">{$Dict.select}</option>
							{foreach from=$Subjects key=key item=Subject}
							<option value="{$Subject.id}">{$Subject.name}</option>
							{/foreach}
						</select>
					</div>
					<label>{$Dict.comment}:</label><div><input type="text" name="comment" id="dcomment" value="" size="47"></div>
				</div>
				<div class="btnbox">
					<input type="hidden" value="" name="sid" id="did">
					<input type="submit" name="SubDelete" value="{$Dict.delete}" class="myButton">
				</div>
		</div>
		</form>
		</div>
  </div>
  <!-- Link to open the modal -->
  <div class="actions">
		{if $Access.add eq 1}
		<a href="#ex2" rel="modal:open" class="myButton">{$Dict.add_new_tasks}</a>
		{/if}
	</div>	
	<table align="center" border="0" width="100%" cellpadding="5" cellspacing="1" bgcolor="BCC7DD" id="studtable">
		<tr class="titleth"> 
			<td align="center" width="30" rowspan="2">#</td>
			<td align="center" rowspan="2" width="40%">{$Dict.subject_name}</td>
			<td align="center" rowspan="2" width="20%">{$Dict.comment}</td>
			<td colspan="2" align="center">{$Dict.questions_count}</td>
			<td colspan="2" align="center">{$Dict.questions_asnwers}</td>
			<td align="center" rowspan="2">{$Dict.edit}</td>
			<td align="center" rowspan="2">{$Dict.delete}</td>
		</tr>
		<tr class="titleth">
			{foreach from=$Languages key=lkey item=Language}
			<td align="center">{$Language.name}</td>
			{/foreach}
			<td align="center">{$Dict.add}</td>
			<td align="center">{$Dict.edit}</td>
		</tr>
		{foreach from=$Tests key=key item=Test}
		<tr bgcolor="{cycle values="#FFFFFF,#E4EAF2"}"> 
			<td align="center">{$key+1}</td>
			<td>{$Test.sname}</td>
			<td>{$Test.tname}</td>
			<td align="center">{$Test.qcount1}</td>
			<td align="center">{$Test.qcount2}</td>
			<td align="center"><a href="#ex1" rel="modal:open"><img rel="{$Test.id|crypt}" class="addrow" src="images/quiz_add.png" width="32"></a></td>
			<td align="center"><a href="tasks.php?act=update&id={$Test.id|crypt}"><img rel="{$Test.id|crypt}" class="editrow" src="images/quiz_edit.png" width="32"></a></td>
			{if $Access.edit eq 1}
			<td align="center"><a href="#ex3" rel="modal:open"><img rel="{$Test.id|crypt}" class="editrow" src="images/edit.png" width="24"></a></td>
			{/if}
			{if $Access.del eq 1}
			<td align="center"><a href="#ex4" rel="modal:open"><img rel="{$Test.id|crypt}" class="deltrow" src="images/delete.png" width="24"></a></td>
			{/if}
		</tr>
		{/foreach}
	</table>
<!--	<div class="actions_left">
	<a id="pbutton" class="myButton">{$Dict.print}</a>
	</div>
	<div id="printarea">
	</div>
-->	<script>
		{literal}
		
		$('.addrow').click(function(event) {
			var RowId = $(this).attr("rel");
				$('#testid').val(RowId);
		});

		$('.editrow').click(function(event) {
			var RowId = $(this).attr("rel");
			//alert("ajax.php?act=task_info&id=" + RowId);
			$.get("ajax.php?act=task_info&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				//alert(html);
				$('#eid').val(sInfo[1]);
				$('#esubject').val(sInfo[2]);
				$('#ecomment').val(sInfo[3]);
				//myString.split
			});
		});

		$('.deltrow').click(function(event) {
			var RowId = $(this).attr("rel");
			//alert("ajax.php?act=task_info&id=" + RowId);
			$.get("ajax.php?act=task_info&id=" + RowId, function(html) {
				var sInfo = html.split("<&sec&>");
				if (sInfo[4] == 0)
				{
					$('#formbox').show();
					$('#messagebox').hide();
					$('#did').val(sInfo[1]);
					$('#dsubject').val(sInfo[2]);
					$('#dcomment').val(sInfo[3]);
        }
				else
				{
					$('#formbox').hide();
					$('#messagebox').show();
				}
			});
		});

		$('#pbutton').click(function(event) {
			event.preventDefault();
			var searchIDs = $("#studtable input:checkbox:checked").map(function(){
				return $(this).val();
			}).get(); // <----
			if (searchIDs == "") {
				alert("asdasd");
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
	
	
	{if $Action eq "edit"}
	<div align="left">
		<a href="tasks.php" class="back">{$Dict.back_to_collection}</a>
		<a href="tasks.php?act=update&id={$RowId|crypt}" class="back">{$Dict.back_to_questions}</a>
	</div>
	<h2>{$Subject.name}</h2>

<form method="POST" action="">
<table cellpadding="0" cellspacing="1" align="center" width="100%" style="border:1px solid #74AEE8;">
	<tr class="str_type1">
		<td valign="middle" style="width:99%">
			<div>
				<textarea name="QuestionText" id="qtext"  style="width:100%;">{$Question.question}</textarea>
			</div>
			<div align="right">
					<span id='question_pic'>
						{if $Question.pic_path neq ""}
						<img src='../pictures/{$Question.pic_path}' border=0 style='maxlength:400px !important;'><br>
						<input type=text name='question_pic' value='{$Question.pic_path}' class=flatFields>
						<input type='button' value='{$Dict.delete_pic}' onclick=DeleteUploadedPic('question_pic',1,'{$Question.id|crypt}');>
						{else}
						<input type=button value='{$Dict.choose_pic}' onclick=ChooseFile('question_pic','');>
						{/if}
					</span>
			</div>
		</td>
	</tr>
	{foreach from=$Answers key=key item=Answer}
	<tr class="str_type2">
		<td valign="middle" style="width:99%">
			<div>
				<textarea name="answer[{$Answer.id}]" id="qtext"  style="width:100%;">{$Answer.answer}</textarea>
			</div>
			<div align="right">
				<span id='answerpic_{$Answer.id}'>
				{if $Answer.pic_path neq ""}
				<img src='../pictures/{$Answer.pic_path}' border=0 style='maxlength:400px !important;'><br>
				<input type=text name='answerpic_{$Answer.id}' value='{$Answer.pic_path}' class=flatFields>
				<input type='button' value='{$Dict.delete_pic}' onclick=DeleteUploadedPic('answerpic_{$Answer.id}',2,'{$Answer.id|crypt}');>
				{else}
				<input type=button value='{$Dict.choose_pic}' onclick=ChooseFile('answerpic_{$Answer.id}','');>
				{/if}
				</span>
			</div>
		</td>
	</tr>
	{/foreach}
	<tr>
		<td>
			<div class="forms">
				<label>{$Dict.question_lang}:</label>
					<div>
						<select name="qlang" id="qlang">
							{foreach from=$Languages key=key item=Language}
							<option value="{$Language.id}"{if $Question.language eq $Language.id} selected{/if}>{$Language.name}</option>
							{/foreach}
						</select>
					</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="forms">
				<label>{$Dict.theme}:</label>
					<div>
						<select name="qtheme" id="qtheme">
							{foreach from=$Themes key=key item=Theme}
							<option value="{$Theme.id}"{if $Question.theme eq $Theme.id} selected{/if}>{$Theme.name}</option>
							{/foreach}
						</select>
					</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="forms">
				<label>{$Dict.difficulty_level}:</label>
					<div>
						<select name="qlevel" id="qlevel">
							{foreach from=$Levels key=key item=Level}
							<option value="{$Level.id}"{if $Question.degree eq $Level.id} selected{/if}>{$Level.name}</option>
							{/foreach}
						</select>
					</div>
			</div>
		</td>
	</tr>
</table>	
<script>
{literal}
function BackFileForm1(thisField)
	{
		document.getElementById(thisField).innerHTML = "<input value='Расмни танлаш' type=button onclick=ChooseFile('"+thisField+"','');>";
	}
function DeleteUploadedPic(thisField,type,id)
	{
		var ActType = "delanswerpic";
		if (type == 1) {
			ActType = "delquestpic";
		}
		if (confirm("Сиз ростдан хам ушбу расмни учирмокчимиз?"))
		{
			$.get("ajax.php?act="+ActType+"&qid=" + id, function(html) {
				document.getElementById(thisField).innerHTML = "<input value='Расмни танлаш' type=button onclick=ChooseFile('"+thisField+"','');>";
			});
		}
	}

function ChooseFile(id,type) {
	$('<div/>').dialogelfinder({
		url : 'elfinder/php/connector.php', // connector URL (REQUIRED)
		// lang: 'ru', // elFinder language (OPTIONAL)
		commandsOptions: {
			getfile: {
				oncomplete: 'destroy' // destroy elFinder after file selection
			}
		},
		getFileCallback: function(url) {
		var thisUrl = url.replace("../pictures/", "");
		document.getElementById(id+type).innerHTML = "<img src='../pictures/"+thisUrl+"' border=0 style='maxlength:400px !important;'><br><input type=text name='"+id+"' value='"+thisUrl+"' class=flatFields><input type='button' value='Cancel' onclick=BackFileForm1('"+id+"');>";
			}
		});
	}					

{/literal}
</script>
</table><br>

<input type="hidden" name="questionid" value="{$Question.id|crypt}">
<input type="submit" name="UpdateTestFromText" class="myButton" value="Са&#1179;лаш">
<br><br>
</form>
{/if}

{if $Action eq "update"}
<div align="left"><a href="tasks.php" class="back">{$Dict.back_to_collection}</a></div>
	<h2>{$Subject.name}</h2>
	{if $TestsCount gt 0}
	<input type="button" id="DelAllQuestions" name="DelAllQuestions" class="myButton" value="{$Dict.dellall}">
	{/if}
<div>
	<div class="langbox">
	{foreach from=$Languages key=key item=Language}
	{if $key neq 0}, {/if}
	{if $QuestionLang eq $Language.id}
		<b>{$Language.lname} ({$Language.qcount})</b>
	{else}
		<a href="tasks.php?act=update&id={$RowId|crypt}&qlang={$Language.id}">{$Language.lname} ({$Language.qcount})</a>
	{/if}
	{/foreach}
	</div>
</div>
<form method="POST" action="">
<table cellpadding="0" cellspacing="1" align="center" width="100%" style="border:1px solid #74AEE8;">
	{foreach from=$Tests key=key item=Test}
	<tr id="Row{$key}" class="str_type{$Test.str_is}">
		<td width="15" align="center" style="width:15px;">
			<span id='TrueAnswer{$key}'>{if $Test.str_is eq 2} <input type="radio" value="{$Test.ValueName}" name="TrueAnswer[{$Test.KeyName}]"{if $Test.is_true eq 1} checked{/if}>{else}{$Test.questionNumber}{/if}</span>
			<input type="hidden" value="{$Test.KeyName}!{$Test.str_is}!{$Test.ValueName}" name="StringType[{$key}]" size="1" id="StringType{$key}">
		</td>
		<td align="center" valign="middle" style="width:99%" id="Cell{$key}" {if $Test.str_is neq 1} colspan="3"{/if}>
		    <textarea name="TestVals[{$key}]" id="Input{$key}"  style="width:100%;">{$Test.str}</textarea>
			<!--<input type="text" name="TestVals[{$key}]" value="{$Test.str}" id="Input{$key}">-->
			<span id='LessBox{$key}'></span>
		</td>
		{if $Test.str_is eq 1}
		<td width="30" class="TestRows" align="center">
			<a href="tasks.php?act=edit&testid={$Test.testid|crypt}&question={$Test.idfield|crypt}" class="edit_quest" rel="{$Test.idfield|crypt}"><img src="images/edit.png" alt="Тахрирлаш" width="32" border="0"></a>
		</td>
		<td width="30" class="TestRows" align="center">
			<a class="del_quest" rel="{$Test.idfield|crypt}"><img src="images/delete.png" alt="Учириш" width="32" border="0"></a>
		</td>
			{/if}
	</tr>
	{/foreach}
</table><br>

<input type="hidden" name="testid" value="{$smarty.post.testid}">
<input type="submit" name="UpdateTestFromText" class="myButton" value="Са&#1179;лаш">
<br><br>
</form>
	{literal}

<script>
 
 	$('.del_quest').click(function(event) {
			var RowId = $(this).attr("rel");
			if (confirm("Сиз ростдан хам ушбу саволни учирмокчимиз?"))
			{
				$.get("ajax.php?act=delquest&qid=" + RowId, function(html) {
				 location.reload();
				});
			}
	});
	 
 	$('#DelAllQuestions').click(function(event) {
			if (confirm("Сиз ростдан хам ушбу жамланма савол жавобларини учирмокчимиз?"))
			{
				$.get("ajax.php?act=delcontrolqa&cid={/literal}{$smarty.get.id}{literal}", function(html) {
				 location.reload();
				});
			}
	});
	
 function ChangeClass(type,id)
 {
 	if (type == 3)
 	{
 		if (document.getElementById("LessBox"+id).innerHTML == '')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "<select name='LessonId["+id+"]' id='Lesson"+id+"' style='width:600px;'>"+document.getElementById("LessonsSB").innerHTML+"</select>";
 			document.getElementById("Input"+id).style.display = "none";
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 	}
 	if (type==4)
 	{
 		document.getElementById("Input"+id).style.display = "none";
 		document.getElementById("TrueAnswer"+id).innerHTML = "";
 	}
 	if (type==1 || type==2)
 	{
 		if (type == 1)
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 		else
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = '<input type="radio" name="TrueAnswer['+id+']">';
 		}
 		if (document.getElementById("Input"+id).style.display == "none")
 		{
 			document.getElementById("Input"+id).style.display = "";
 		}
 		if (document.getElementById("LessBox"+id) != 'undefined')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "";
 		}
 		document.getElementById("Input"+id).style.display = "";
 	}

 	document.getElementById("Row"+id).className = "str_type"+type;
 	document.getElementById("StringType"+id).value = type;
 }

 
 </script>  	

	{/literal}		
	{/if}
	
	{if $Action eq "update_old"}
	<div align="left"><a href="tasks.php" class="back">{$Dict.back_to_collection}</a></div>
	<h2>{$Subject.name}</h2>
	{if $TestsCount gt 0}
	<input type="button" id="DelAllQuestions" name="DelAllQuestions" class="myButton" value="{$Dict.dellall}">
	{/if}

<form method="POST" action="">
<table cellpadding="0" cellspacing="1" align="center" width="100%" style="border:1px solid #74AEE8;">
	{foreach from=$Tests key=key item=Test}
	<tr id="Row{$key}" class="str_type{$Test.str_is}">
		<td width="15" align="center" style="width:15px;">
			<span id='TrueAnswer{$key}'>{if $Test.str_is eq 2} <input type="radio" value="{$Test.ValueName}" name="TrueAnswer[{$Test.KeyName}]"{if $Test.is_true eq 1} checked{/if}>{else}{$Test.questionNumber}{/if}</span>
			<input type="hidden" value="{$Test.KeyName}!{$Test.str_is}!{$Test.ValueName}" name="StringType[{$key}]" size="1" id="StringType{$key}">
		</td>
		<td align="center" valign="middle" style="width:99%" id="Cell{$key}">
		    <textarea name="TestVals[{$key}]" id="Input{$key}"  style="width:100%;">{$Test.str}</textarea>
			<!--<input type="text" name="TestVals[{$key}]" value="{$Test.str}" id="Input{$key}">-->
			<span id='LessBox{$key}'></span>
		</td>
		<td width="30" class="TestRows" align="center">
			{if $Test.str_is eq 1}
			<a class="del_quest" rel="{$Test.idfield|crypt}"><img src="images/delete.png" alt="Учириш" width="32" border="0"></a>
			{/if}
		</td>
	</tr>
	{/foreach}
</table><br>

<input type="hidden" name="testid" value="{$smarty.post.testid}">
<input type="submit" name="UpdateTestFromText" class="myButton" value="Са&#1179;лаш">
<br><br>
</form>
	{literal}

<script>
 
 	$('.del_quest').click(function(event) {
			var RowId = $(this).attr("rel");
			if (confirm("Сиз ростдан хам ушбу саволни учирмокчимиз?"))
			{
				$.get("ajax.php?act=delquest&qid=" + RowId, function(html) {
				 location.reload();
				});
			}
	});
	 
 	$('#DelAllQuestions').click(function(event) {
			if (confirm("Сиз ростдан хам ушбу жамланма савол жавобларини учирмокчимиз?"))
			{
				$.get("ajax.php?act=delcontrolqa&cid={/literal}{$smarty.get.id}{literal}", function(html) {
				 location.reload();
				});
			}
	});
	
 function ChangeClass(type,id)
 {
 	if (type == 3)
 	{
 		if (document.getElementById("LessBox"+id).innerHTML == '')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "<select name='LessonId["+id+"]' id='Lesson"+id+"' style='width:600px;'>"+document.getElementById("LessonsSB").innerHTML+"</select>";
 			document.getElementById("Input"+id).style.display = "none";
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 	}
 	if (type==4)
 	{
 		document.getElementById("Input"+id).style.display = "none";
 		document.getElementById("TrueAnswer"+id).innerHTML = "";
 	}
 	if (type==1 || type==2)
 	{
 		if (type == 1)
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 		else
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = '<input type="radio" name="TrueAnswer['+id+']">';
 		}
 		if (document.getElementById("Input"+id).style.display == "none")
 		{
 			document.getElementById("Input"+id).style.display = "";
 		}
 		if (document.getElementById("LessBox"+id) != 'undefined')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "";
 		}
 		document.getElementById("Input"+id).style.display = "";
 	}

 	document.getElementById("Row"+id).className = "str_type"+type;
 	document.getElementById("StringType"+id).value = type;
 }

 
 </script>  	

	{/literal}		
	{/if}
	
	{if $Action eq "import"}
<form method="POST" action="">
<table cellpadding="0" cellspacing="1" align="center" width="100%" style="border:1px solid #74AEE8;">
	{foreach from=$Tests key=key item=Test}
	<tr id="Row{$key}" class="str_type{$Test.str_is}">
		<td width="15" align="center">
			<span id='TrueAnswer{$key}'>{if $Test.str_is eq 2} <input type="radio" value="{$Test.ValueName}" name="TrueAnswer[{$Test.KeyName}]"{if $Test.is_true eq 1} checked{/if}>{/if}</span>
			<input type="hidden" value="{$Test.str_is}" name="StringType[{$key}]" size="1" id="StringType{$key}">
		</td>
		<td align="center" valign="middle" width="640px;" id="Cell{$key}">
		    <textarea name="TestVals[{$key}]" id="Input{$key}"  style="width:100%;">{$Test.str}</textarea>
			<!--<input type="text" name="TestVals[{$key}]" value="{$Test.str}" id="Input{$key}">-->
			<span id='LessBox{$key}'></span>
		</td>
		<td width="30" class="TestRows" align="center">
			<a id="#NameHref{$key}" onclick="ChangeClass(1,{$key})"><img src="images/type1.png" width="32" alt="Савол" border="0"></a>
		</td>
		<td width="30" class="TestRows" align="center">
			<a id="#NameHref{$key}" onclick="ChangeClass(2,{$key})"><img src="images/type2.png" width="32" alt="Жавоб" border="0"></a>
		</td>
<!--		<td width="30" class="TestRows" align="center">
			<a id="#NameHref{$key}" onclick="ChangeClass(3,{$key})"><img src="images/type3.gif" width="18" alt="Мавзу" border="0"></a>
		</td>
-->		<td width="30" class="TestRows" align="center">
			<a id="#NameHref{$key}" onclick="ChangeClass(4,{$key})"><img src="images/type4.png" alt="Кераксиз текст" width="32" border="0"></a>
		</td>
	</tr>
	{/foreach}
</table><br>

<div class="forms">
	<div class="langbox">
	{$Dict.question_lang}:
						<select name="qlang" id="qlang">
							{foreach from=$Languages key=key item=Language}
								<option value="{$Language.id}"{if $QuestionLang eq $Language.id} selected{/if}>{$Language.name}</option>
							{/foreach}
						</select>
	</div>					
</div>
<input type="hidden" name="testid" value="{$smarty.post.testid}">
<input type="submit" name="SubTestFromText" class="myButton" value="Са&#1179;лаш">
<br><br>
</form>
	{literal}

<script>
 
 function ChangeClass(type,id)
 {
 	if (type == 3)
 	{
 		if (document.getElementById("LessBox"+id).innerHTML == '')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "<select name='LessonId["+id+"]' id='Lesson"+id+"' style='width:600px;'>"+document.getElementById("LessonsSB").innerHTML+"</select>";
 			document.getElementById("Input"+id).style.display = "none";
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 	}
 	if (type==4)
 	{
 		document.getElementById("Input"+id).style.display = "none";
 		document.getElementById("TrueAnswer"+id).innerHTML = "";
 	}
 	if (type==1 || type==2)
 	{
 		if (type == 1)
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = "";
 		}
 		else
 		{
 			document.getElementById("TrueAnswer"+id).innerHTML = '<input type="checkbox" name="TrueAnswer['+id+']">';
 		}
 		if (document.getElementById("Input"+id).style.display == "none")
 		{
 			document.getElementById("Input"+id).style.display = "";
 		}
 		if (document.getElementById("LessBox"+id) != 'undefined')
 		{
 			document.getElementById("LessBox"+id).innerHTML = "";
 		}
 		document.getElementById("Input"+id).style.display = "";
 	}

 	document.getElementById("Row"+id).className = "str_type"+type;
 	document.getElementById("StringType"+id).value = type;
 }

 
 </script>  	

	{/literal}
	{/if}
{$bottom}


















