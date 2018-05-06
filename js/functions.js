var NewsId = 0;
var Logged = 0;
var xPos = 0;
var yPos = 0;
var Browser = 0;
NewsCur = 0;
OldOver = new Array();
OldOut = new Array();

if (navigator.appName.indexOf("Netscape") >= 0)
{
	Browser = 1;
	window.captureEvents(Event.MOUSEUP);
	window.onmouseup = GetCoords;
}
else if (navigator.appName.indexOf("Microsoft") >= 0)
{
	Browser = 2;
}

else if (navigator.appName.indexOf("Opera") >= 0)
{
	Browser = 3;
}
// ###########################################
function GetEl(id)
{
	return document.getElementById(id);
}

function reload_news()
{
	setTimeout('xajax_reload_news();', 120000); //vremea ravnoe 5 minutam ravno 300000
	return;
}

function TabSwitch(Mode)
{
	Obj1 = GetEl('tab1');
	Obj2 = GetEl('tab2');
	Obj3 = GetEl('tab_content1');
	Obj4 = GetEl('tab_content2');

	if (Mode == 1)
	{
		Obj1.style.display = 'block';
		Obj2.style.display = 'none';
		Obj3.style.display = 'block';
		Obj4.style.display = 'none';
	}
	else
	{
		Obj1.style.display = 'none';
		Obj2.style.display = 'block';
		Obj3.style.display = 'none';
		Obj4.style.display = 'block';
	}

	return false;
}

function TabRightSwitch(Mode)
{
	Obj1r = GetEl('RightTabs1');
	Obj2r = GetEl('RightTabs2');

	Obj1c = GetEl('TabContent1');
	Obj2c = GetEl('TabContent2');
	if (Mode == 1)
	{
		Obj1r.style.display = 'block';
		Obj2r.style.display = 'none';

		Obj1c.style.display = 'block';
		Obj2c.style.display = 'none';
	}
	else if (Mode == 2)
	{
		Obj1r.style.display = 'none';
		Obj2r.style.display = 'block';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'block';
	}
	return false;
}
function ShowForm()
{
	ObjEl1 = GetEl('OCImage');
	ObjEl2 = GetEl('AddQuestion');
	if (ObjEl2.style.display == 'none')
	{
		ObjEl2.style.display = 'inline';
		ObjEl1.src = 'images/close_qform.gif';
		AddQuestionResult.style.display = 'none';
	}
	else
	{
		ObjEl2.style.display = 'none';
		ObjEl1.src = 'images/open_qform.gif';
		AddQuestionResult.style.display = 'none';
	}
}

function ShowFormE(number,question,answer,action,empname,faqfile)
{
	ObjEl1 = GetEl('DelQuestion');
	ObjEl2 = GetEl('AddQuestion');
	ObjEl1.style.display = 'none';
	ObjEl2.style.display = 'inline';
	AddQuestionResult.style.display = 'none';
	AskedQuestion.innerHTML = number+'. '+question;
	FaqQuestion.value = answer;
	FaqQuestion.focus();
	QuestionIndex.value = number;
	QuestionAction.value = action;
	EmpName.value = empname;
	QuestionFaqFile.value = faqfile;
}

function ShowFormEM(number,question,answer,action)
{
	ObjEl1 = GetEl('AddQuestion');
	ObjEl2 = GetEl('DelQuestion');
	ObjEl1.style.display = 'none';
	ObjEl2.style.display = 'inline';
	AddQuestionResult.style.display = 'none';
	AskedQuestion1.innerHTML = number+'. '+question;
	QuestionAction1.value = action;
	noButton.focus();
	QuestionIndex1.value = number;
}

function CloseQForm()
{
	ObjEl2 = GetEl('AddQuestion');
	ObjEl2.style.display = 'none';
}

function CloseDForm()
{
	ObjEl2 = GetEl('DelQuestion');
	ObjEl2.style.display = 'none';
}

function TabRightSwitchE(Mode)
{
	Obj1r = GetEl('RightTabs1');
	Obj2r = GetEl('RightTabs2');
	Obj3r = GetEl('RightTabs3');

	Obj1c = GetEl('TabContent1');
	Obj2c = GetEl('TabContent2');
	Obj3c = GetEl('TabContent3');
	if (Mode == 1)
	{
		Obj1r.style.display = 'block';
		Obj2r.style.display = 'none';
		Obj3r.style.display = 'none';

		Obj1c.style.display = 'block';
		Obj2c.style.display = 'none';
		Obj3c.style.display = 'none';
	}
	else if (Mode == 2)
	{
		Obj1r.style.display = 'none';
		Obj2r.style.display = 'block';
		Obj3r.style.display = 'none';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'block';
		Obj3c.style.display = 'none';
	}
	else if (Mode == 3)
	{

		Obj1r.style.display = 'none';
		Obj2r.style.display = 'none';
		Obj3r.style.display = 'block';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'none';
		Obj3c.style.display = 'block';
	}
	return false;
}
function TabRightSwitch4(Mode)
{
	Obj1r = GetEl('RightTabs1');
	Obj2r = GetEl('RightTabs2');
	Obj3r = GetEl('RightTabs3');
	Obj4r = GetEl('RightTabs4');

	Obj1c = GetEl('TabContent1');
	Obj2c = GetEl('TabContent2');
	Obj3c = GetEl('TabContent3');
	Obj4c = GetEl('TabContent4');
	if (Mode == 1)
	{
		Obj1r.style.display = 'block';
		Obj2r.style.display = 'none';
		Obj3r.style.display = 'none';
		Obj4r.style.display = 'none';

		Obj1c.style.display = 'block';
		Obj2c.style.display = 'none';
		Obj3c.style.display = 'none';
		Obj4c.style.display = 'none';
	}
	else if (Mode == 2)
	{
		Obj1r.style.display = 'none';
		Obj2r.style.display = 'block';
		Obj3r.style.display = 'none';
		Obj4r.style.display = 'none';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'block';
		Obj3c.style.display = 'none';
		Obj4c.style.display = 'none';
	}
	else if (Mode == 3)
	{

		Obj1r.style.display = 'none';
		Obj2r.style.display = 'none';
		Obj3r.style.display = 'block';
		Obj4r.style.display = 'none';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'none';
		Obj3c.style.display = 'block';
		Obj4c.style.display = 'none';
	}
	else if (Mode == 4)
	{

		Obj1r.style.display = 'none';
		Obj2r.style.display = 'none';
		Obj3r.style.display = 'none';
		Obj4r.style.display = 'block';

		Obj1c.style.display = 'none';
		Obj2c.style.display = 'none';
		Obj3c.style.display = 'none';
		Obj4c.style.display = 'block';
	}
	if (Mode != 1)
	{
		if (el = document.getElementById("MessageSpan"))
		{
			el.innerHTML = "";
		}
	}
	return false;
}
//################## Функция вывода сообщения ######################################
function GetCoords(e)
{
	if (Browser == 2 || Browser == 3)
	{
		xPos = event.clientX;
		yPos = event.clientY + document.documentElement.scrollTop;//event.screenY;
		//alert (yPos + '=' + event.clientY + '+' + document.documentElement.scrollTop);
	}
	else if (Browser == 1 && e)
	{
		xPos = e.pageX;
		yPos = e.pageY;
		//alert (document.documentElement.scrollTop);
	}
	else
	{
		xPos = 1;
		yPos = 1;
	}

}

function SwitchNews(id, SwitchFlag)
{
	x = new getObj('n'+id);
	if (!OldOver[id] || !OldOut[id])
	{
		Obj = GetEl('n'+id);
		OldOver[id] = (Obj.onmouseover) ? Obj.onmouseover : null;
		OldOut[id] = (Obj.onmouseout) ? Obj.onmouseout : null;
	}

	if (OldOver[id] && OldOut[id])
	{
		if (SwitchFlag)
		{
			x.obj.onmouseover = null;
			x.obj.onmouseout = null;
		}
		else
		{
			x.obj.onmouseover = OldOver[id];
			x.obj.onmouseout = OldOut[id];
		}
	}
}

function getObj(name)
{
	if (document.getElementById)
	{
		this.obj = document.getElementById(name);
		this.stl = document.getElementById(name).style;
	}
	else if (document.all)
	{
		this.obj = document.all[name];
		this.stl = document.all[name].style;
	}
	else if (document.layers)
	{
		this.obj = document.layers[name];
		this.stl = document.layers[name];
	}
}
//+++++++++++++++++++++++ Переключение наигации в панели юзера +++++++++++++++++++++++
function cabinet_nav()
{
	url='';
	index = document.getElementById('cab_nav').options.selectedIndex;
	if (index > -1)
	url = document.getElementById('cab_nav').options[index].value;
	document.location.href = "/Profile/"+url;
}
//+++++++++++++++++++++++ Отправка преглашения +++++++++++++++++++++++
function Send_Mes(Act, to, from, event)
{
	GetEl('subject').value = '';
	GetEl('text_body').value = '';
	Menu = GetEl('send_message');
	Menu.style.display = 'none';
	ObjBG = GetEl('not_logged_bg');
	ObjBG.style.display = 'none';

	if ( Source = GetEl('send_mes'+Act) )
	{
		//		if (isThisMozilla) 	event=evt;
		var rightedge = document.body.clientWidth-event.clientX;
		var bottomedge = document.body.clientHeight-event.clientY;

		if (rightedge < Menu.offsetWidth)
		Menu.style.left = document.body.scrollLeft + event.clientX - Menu.offsetWidth;
		else
		Menu.style.left = document.body.clientWidth / 2;

		if (bottomedge < Menu.offsetHeight)
		Menu.style.top = document.body.scrollTop + event.clientY - Menu.offsetHeight;
		else
		Menu.style.top = document.body.scrollTop + event.clientY;

		if (to != '')
		GetEl('emailto').value = to;

		if (from != '')
		GetEl('emailfrom').value = from;
		Menu.style.display = 'block';
	}
	return false;
}
//+++++++++++++++++++++++ Отправка новости на емаил +++++++++++++++++++++++
function Complain2(newsId){
	GetEl("compl_div_"+newsId).innerHTML = 'Принято!';
}


// ++++++++++++++++++++++++++++++++ NEW FUNCTION ++++++++++++++++++++++++++++++++++++++++++
function login(){
	WarnClose();
	obj = GetEl('login_form');
	obj.style.display = 'block';
}

function login_close(){
	obj = GetEl('login_form');
	obj.style.display = 'none';
}

//#########################Loader Section#############################
function loader_set()
{
	Obj = GetEl('error_form');
	textObj = GetEl('error_text');
	textObj.innerHTML = 'Загрузка';
	Obj.style.display = 'block';
	login_close();
}

function remove()
{
	Obj = GetEl('error_form');
	textObj = GetEl('error_text');
	textObj.innerHTML = '';
	Obj.style.display = 'none';
}

function change(request)
{
	//	loader_set();
	request;
	return false;
}

function Warn2(Act)
{
	Obj = GetEl('error_form');
	textObj = GetEl('error_text');
	textObj.innerHTML = 'На данный момент эта функция не доступна';
	Obj.style.display = 'block';
	login_close();

	return false;
}

function Warn()
{
	Obj = GetEl('error_form');
	textObj = GetEl('error_text');
	textObj.innerHTML = 'На данный момент у Вас нет доступа к этой функции. Вам необходимо <a href="/User/Register/">зарегистрироваться</a> или <a href="#" onClick="login(); return false;">войти в свой аккаунт</a>.<br>&nbsp;';
	Obj.style.display = 'block';
	login_close();
	return false;
}

function WarnClose()
{
	Obj = GetEl('error_form');
	textObj = GetEl('error_text');
	textObj.innerHTML = '';
	Obj.style.display = 'none';
	return false;
}

function Complain(id)
{
	NewsId = id;
	Menu = GetEl('complain');
	Menu.style.display = 'none';

	if (Source = GetEl('c_'+id))
	{
		Menu.style.top = (Source.offsetTop + Source.offsetHeight + 6) + 'px';
		Menu.style.left = (Source.offsetLeft + 3) + 'px';
		Menu.style.display = 'block';
	}
	return false;
}
//+++++++++++++++++++++++ Вывод карточки пользователя +++++++++++++++++++++++
function myTo_email(Act, id)
{
	var element = document.getElementById(Act);
	var bounds = getBounds(element);
	GetEl('uid').value = id;

	loader_set();
	var form = GetEl('user_card');
	form.style.top = bounds.top; //event.clientY;
	form.style.left = bounds.left; //event.clientX;
	xajax_getProfail(GetEl('d56b69').value, GetEl('uid').value);
	remove();
}

function getBounds(element)
{
	var left = element.offsetLeft;
	var top = element.offsetTop;
	for (var parent = element.offsetParent; parent; parent = parent.offsetParent)
	{
		left += parent.offsetLeft;
		top += parent.offsetTop;
	}
	return {left: left, top: top, width: element.offsetWidth, height: element.offsetHeight};
}

function Profile(id, event)
{
	var form = GetEl('user_card');
	form.style.display = 'block';
	return false;
}

function ProfileClose()
{
	GetEl('user_card').style.display = 'none';
	return false;
}

//+++++++++++++++++++++++ Отправка новости на емаил +++++++++++++++++++++++

function To_email(Act, event)
{
	if ('' == Act)
	return Warn();

	Menu = GetEl('mes_email');
	Menu.style.display = 'none';
	GetEl('tmes_email').style.display = 'none';
	GetEl('emailto').value = '';

	if ( Source = GetEl('mes_email_'+Act) )
	{
		Menu.style.left = event.clientX;
		Menu.style.top = event.clientY;
		Menu.style.display = 'block';
		GetEl('tmes_email').style.display = 'block';
	}
	return false;
}
// ++++++++++++++++++++++++++++++++ END NEW FUNCTION ++++++++++++++++++++++++++++++++++++++++++


// show icon over a <input type="button" value="Txt">
//
/*
function KaKa6e4Ka(Btn, Ico, TxtWidth)
{
if ((Btn = GetEl(Btn)) && (Ico = GetEl(Ico)))
{
Ico.style.display = 'block';
IcoHeight = Math.floor(Ico.offsetHeight/2);
IcoWidth = Ico.offsetWidth + 5;
Ico.style.display = 'none';

Btn.style.position = 'absolute';
Btn.style.position = 'relative';

Ico.style.left = (Btn.offsetLeft + Math.floor((Btn.offsetWidth - TxtWidth - IcoWidth)/2)) + 'px';
Ico.style.top = (Btn.offsetTop + Math.floor(Btn.offsetHeight/2) - IcoHeight) + 'px';

Ico.style.display = 'block';
}
}
*/
function Redir(Href)
{
	document.location.href = Href;
}

function createXMLHttp()
{
	if (typeof XMLHttpRequest != "undefined")
	return new XMLHttpRequest();
	else if (window.ActiveXObject)
	{
		var aVersions = ["MSXML2.XMLHttp.5.0", "MSXML2.XMLHttp.4.0", "MSXML2.XMLHttp.3.0", "MSXML2.XMLHttp", "Microsoft.XMLHttp"];
		for (var i = 0; i < aVersions.length; i++)
		{
			try
			{
				var oXmlHttp = new ActiveXObject(aVersions[i]);
				return oXmlHttp;
			}
			catch (oError)
			{	/*Do nothing*/	}
		}
	}
	throw new Error("MSXML is not installed.");
}

var xmlHTTP = createXMLHttp();
function openHelp(filename,actionname,helpName,SearchWord)
{
	HelpContent.innerHTML = "<b>Ждите ответа..</b><br>";
	FileName.value = filename;
	ActionName.value = actionname;
	if (SearchWord == undefined)
	{
		var url = "openfile.php?fn="+filename+"&an="+actionname+"&hn="+helpName;
	}
	else
	{
		var url = "openfile.php?fn="+filename+"&an="+actionname+"&hn="+helpName+"&sw="+SearchWord;
	}
	//window.status = url;

	MakeHttpRequiest(url);
}
function MakeHttpRequiest(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = Process;
	xmlHTTP.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=windows-1251");
	xmlHTTP.send(null);
}

function Process()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		var nameList = resp;
		var regexp = "{^google^}";
		var newArray = nameList.split(regexp);

		var nameLists = newArray[0];
		var regexps = "#cont#ent#";
		var newArrayc = nameLists.split(regexps);


		HelpTitle.innerHTML = newArrayc[0];
		HelpContent.innerHTML = newArrayc[1];

		if (document.getElementById("EditAccess").value == 1)
		{
			TabRightSwitchE(1);
			myQuestionsContent.innerHTML = newArray[2];
			myAnswdQuestionsContent.innerHTML = newArray[3];
		}
		else
		{
			TabRightSwitch(1);
			myQuestionsContent.innerHTML = newArray[1];
		}
		//window.status = document.getElementById("EditAccess").value;
	}
}

function openHelpEdit(filename,actionname)
{
	FileName.value = "";
	ActionName.value = "";
	var url = "openfile.php?fn="+filename+"&an="+actionname;
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
		editor_insertHTMLadd('field', 'simone');
	}
}

function SearchContent()
{
	var SearchWord = document.getElementById("keyword").value;
	if( SearchWord == "")
	{
		SearchStatus.innerHTML = "Введите ключевое слово!<br>";
		return;
	}

	SearchStatus.innerHTML = "<b>Ждите ответа..</b><br>";
	var url = "readdir.php?search_word="+SearchWord;
	MakeHttpRequiestSearch(url);
}

function MakeHttpRequiestSearch(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = ProcessSearch;
	//	xmlHTTP.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=windows-1251");
	xmlHTTP.send(null);
}

function ProcessSearch()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if (resp != "")
		{
			SearchStatus.innerHTML = resp;
		}
		else
		{
			SearchStatus.innerHTML = "<b>Поиск не дал результатов</b>";
		}

	}
}


function AddQuestions()
{
	AddingStatus.innerHTML = "<b>Ждите ответа..</b><br>";
	var MyFileName = filename.value;
	var MyFileAction = actionname.value;
	var MyFaqTitle = FaqTitle.value;
	var MyFaqQuestion = FaqQuestion.value;
	var MyFaqOwner = OperatorName.value;

	var url = "add_question.php?fn="+MyFileName+"&an="+MyFileAction+"&ft="+MyFaqTitle+"&fq="+MyFaqQuestion+"&fo="+MyFaqOwner+"&rnd=" + Math.random();;
	GetEl('FaqTitle').value = "";
	AddQuestion.style.display = 'none';
	AddQuestionResult.style.display = 'inline';
	OCImage.src = 'images/open_qform.gif';
	MakeHttpRequiestAddquestion(url);
}

function MakeHttpRequiestAddquestion(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = ProcessAdd;
	xmlHTTP.send(null);
}

function ProcessAdd()
{
	if (xmlHTTP.readyState == 4)
	{
		var resp = xmlHTTP.responseText;
		if (resp == 'BingOk!')
		{
			AddingStatus.innerHTML = "Ваш вопрось успешно добавлен в базу данных.";
		}
		else
		{
			AddingStatus.innerHTML = resp;
		}
	}
}

function AddAnswer()
{
	AddQuestionResult.style.display = 'inline';
	AddingStatus.innerHTML = "<b>Ждите ответа..</b><br>";

	var MyFileName = filename.value;
	var MyFileAction = actionname.value;
	var MyFaqQuestion = FaqQuestion.value;
	var MyFaqIndex = QuestionIndex.value;
	var MyQuestionAction = QuestionAction.value;
	var MyEmpName = EmpName.value;
	var MyQuestionFaqFile = QuestionFaqFile.value;

	var url = "add_answer.php?fn="+MyFileName+"&an="+MyFileAction+"&find="+MyFaqIndex+"&fq="+MyFaqQuestion+"&fa="+MyQuestionAction+"&fe="+MyEmpName+"&ff="+MyQuestionFaqFile+"&rnd=" + Math.random();
	GetEl('FaqQuestion').value = "";
	AddQuestion.style.display = 'none';
	MakeHttpRequiestAddanswer(url);
}

function DelAnswer()
{
	AddQuestionResult.style.display = 'inline';
	AddingStatus.innerHTML = "<b>Ждите ответа..</b><br>";

	var MyFileName = filename.value;
	var MyFileAction = actionname.value;
	var MyFaqIndex = QuestionIndex1.value;
	var MyQuestionAction = QuestionAction1.value;
	var MyFaqQuestion = "empty";

	var url = "add_answer.php?fn="+MyFileName+"&an="+MyFileAction+"&find="+MyFaqIndex+"&fq="+MyFaqQuestion+"&fa="+MyQuestionAction+"&rnd=" + Math.random();
	GetEl('FaqQuestion').value = "";
	AddQuestion.style.display = 'none';
	MakeHttpRequiestAddanswer(url);
}

function MakeHttpRequiestAddanswer(url)
{
	xmlHTTP.open("GET", url, true);
	xmlHTTP.onreadystatechange = ProcessAddAnswer;
	xmlHTTP.send(null);
}

function ProcessAddAnswer()
{
	if (xmlHTTP.readyState == 4)
	{
		AddingStatus.innerHTML = "Ваш ответ успешно добавлен в базу данных.";

		var resp = xmlHTTP.responseText;
		var nameList = resp;
		var regexp = "{^google^}";
		var newArray = nameList.split(regexp);

		TabRightSwitchE(2);
		myQuestionsContent.innerHTML = newArray[0];
		myAnswdQuestionsContent.innerHTML = newArray[1];
		if(newArray[2] != 0)
		{
			QuestionCount1.innerHTML = newArray[2];
			QuestionCount2.innerHTML = newArray[2];
			QuestionCount3.innerHTML = newArray[2];
		}
		else
		{
			QuestionCount1.innerHTML = "";
			QuestionCount2.innerHTML = "";
			QuestionCount3.innerHTML = "";
		}
	}
}
/*function ChangeLangs(Asuffix, id)
{
	if (id == 1)
	{
		document.getElementById(Asuffix + "10").style.display = 'inline';
		document.getElementById(Asuffix + "11").style.display = 'inline';
		document.getElementById(Asuffix + "12").style.display = 'inline';
		document.getElementById(Asuffix + "00").style.display = 'none';
		document.getElementById(Asuffix + "01").style.display = 'none';
		document.getElementById(Asuffix + "02").style.display = 'none';
	}
	else
	{
		document.getElementById(Asuffix + "10").style.display = 'none';
		document.getElementById(Asuffix + "11").style.display = 'none';
		document.getElementById(Asuffix + "12").style.display = 'none';
		document.getElementById(Asuffix + "00").style.display = 'inline';
		document.getElementById(Asuffix + "01").style.display = 'inline';
		document.getElementById(Asuffix + "02").style.display = 'inline';
	}
}*/