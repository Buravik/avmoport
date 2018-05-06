<html>
<head>
	<title>{$title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<META NAME="Author" CONTENT="Botirjon Olimov">
	<meta http-equiv="Expires" CONTENT="Wed, 21 Feb 2007 08:21:57 GMT">
	<link rel="icon" href="/favicon.ico">
	<link rel="stylesheet" href="css/newstyle.css">
</head>
<body class="main-body">
<div class="topDiv">
	<div class="leftColumnTop" align="center"><img src="images/logo.png" height="50" style="margin-top:10px;">
	</div>
	<div class="rightColumnTop">&nbsp;
		<div class="rateBox">
		</div>
		<div class="ToolBox">
		<b>{$EmpName}</b>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="settings.php" target="mainframe">{$Lang.SETTINGS}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php">{$Lang.EXIT}</a>
		</div>
		<div class="InfoBox">
 
		<ul class="board">
			<li style="width:50%">
			<!--<span class="title" id="Title1">Агент:&nbsp;</span><span id="CodeSpan">{$AgentInfo.company}</span>!-->
			</li>
			<li style="width:50%">
			<!--<span class="title" id="Title2">Масъул шахс:&nbsp;</span><span id="NameSpan">{$AgentInfo.name}</span>!-->
			</li>
		</ul>
		
		</div>
	</div>
</div>
<div class="resizers leftColumn" id="leftColumn">
	<div class="SeperatorLine" id="separator">
	</div>
	<div class="boxcontent">
		<iframe name="menuframe" src="menu.php??nocap" id="menuframe" width="100%" height="100%" marginheight="0" marginwidth="0" height="100%" frameborder="0" scrolling="yes"></iframe>
	</div>
</div>
<div class="resizers rightColumn" id="rightColumn">
	<div class="boxcontent">
		<div id="frontdiv" style="position:absolute; TOP:1; opacity:10; width:98%; height:98%; display:none"></div>
		<iframe name="mainframe" src="main.php?act=search" id="mainframe" width="100%" height="100%" marginheight="0" marginwidth="0" height="100%" frameborder="0" scrolling="yes"></iframe>
		<iframe name="printframe" id="printframe" style=display:none></iframe>
	</div>
</div>
<script type="text/javascript"> 
{literal}
//
var dragging = false;
var mouseX = 0;
var leftPercent = 20;
var rightPercent = 80;
var elem = document.getElementById("separator");
var leftCol = document.getElementById("leftColumn");
var rightCol = document.getElementById("rightColumn");
var mask = document.getElementById("frontdiv");

function getWindowWidth() {
	if (typeof window.innerWidth != 'undefined') {
		return window.innerWidth;
	} else {
		return document.documentElement.clientWidth;
	}
}

function fixEvent(e) {
	// получить объект событие для IE
	e = e || window.event;

	// добавить pageX/pageY для IE
	if ( e.pageX == null && e.clientX != null ) {
		var html = document.documentElement;
		var body = document.body;
		e.pageX = e.clientX + (html && html.scrollLeft || body && body.scrollLeft || 0) - (html.clientLeft || 0);
		e.pageY = e.clientY + (html && html.scrollTop || body && body.scrollTop || 0) - (html.clientTop || 0);
	}

	// добавить which для IE
	if (!e.which && e.button) {
		e.which = e.button & 1 ? 1 : ( e.button & 2 ? 3 : ( e.button & 4 ? 2 : 0 ) );
	}

	return e;
}

elem.onmousedown = function (event) {
	var e = fixEvent(event);
	mouseX = e.pageX;

	startDrag();
	return false;
}

elem.onmouseup = function () {
	stopDrag();
	return false;
}

document.onmousemove = function (event) {
	if (!dragging) return;
	var e = fixEvent(event);

	if (e.pageX != mouseX) {
		var pos = mouseX - e.pageX;
		mouseX = e.pageX;

		var p = pos * 100 / getWindowWidth();

		if (p) {
			leftPercent -= p;
			if (leftPercent < 20) {
				leftPercent = 20;
				rightPercent = 80;
				stopDrag();
			} else if (leftPercent > 40) {
				leftPercent = 40;
				rightPercent = 60;
				stopDrag();
			} else {
				rightPercent += p;
			}

			leftCol.style.right = rightPercent + "%";
			rightCol.style.left = leftPercent + "%";
		}
	}
	return false;
}

leftCol.onselectstart = function () {
	return false;
}

function startDrag() {
	dragging = true;
	mask.style.display = "block";
}

function stopDrag() {
	dragging = false;
	mask.style.display = "none";
}
//
{/literal}

</script>
</body>
</html>

