function getCursorPos(textElement)
{
	var sOldText = textElement.value;
	var objRange = document.selection.createRange();
	var sOldRange = objRange.text;
	var sWeirdString = '#%~';
	objRange.text = sOldRange + sWeirdString;
	objRange.moveStart('character', (0 - sOldRange.length - sWeirdString.length));
	var sNewText = textElement.value;
	objRange.text = sOldRange;
	for (i=0; i <= sNewText.length; i++)
	{
		var sTemp = sNewText.substring(i, i + sWeirdString.length);
		if (sTemp == sWeirdString)
		{
			var cursorPos = (i - sOldRange.length);
			return cursorPos;
		}
	}
}
function moveCaret(oTextArea,nPos)
{
	var rng=oTextArea.createTextRange();
	rng.collapse()
	rng.moveStart("character",nPos);
	rng.select();
}
function BanDateKey()
{
	if (event.keyCode < 48 || event.keyCode > 57)
	{
		event.returnValue = false;
		return false;
	}
	return true;
}
function FormatDate(elem)
{
	if (event.keyCode == 13)
		return;
	if (!BanDateKey())
		return false;
	var oldMaxLength = elem.maxLength;
	elem.maxLength = oldMaxLength + 5;
	var cursorPos = getCursorPos(elem);
	DeleteRightSign();
	if (cursorPos == 2 || cursorPos == 5)
	{
		SetLetter('.');
		DeleteRightSign();
	}
	elem.maxLength = oldMaxLength;
}
function DeleteRightSign()
{
	textrange=document.selection.createRange();
	if(!textrange.text>"")
		textrange.moveEnd("character", 1);
	textrange.text="";
}
function DeleteLeftSign()
{
	textrange=document.selection.createRange();
	if(!textrange.text>"")
		textrange.moveStart("character", -1);
	textrange.text="";
}
function SetLetter(let)
{
	textrange=document.selection.createRange();
	textrange.text=let;
}
function BanDeleteKeys(elem)
{
	if (event.keyCode == 8)
	{
		keyboardBackspacePress(elem);
		event.returnValue = false;
	}
	else if (event.keyCode == 46)
	{
		keyboardDeletePress(elem);
		event.returnValue = false;
	}
}
function keyboardDeletePress(elem)
{
	var oldMaxLength = elem.maxLength;
	elem.maxLength = oldMaxLength + 5;
	var cursorPos = getCursorPos(elem);
	if (cursorPos == 10)
	{
		elem.maxLength = oldMaxLength;
		return;
	}
	if (cursorPos == 2 || cursorPos == 5)
		SetLetter('.');
	else SetLetter(" ");
	DeleteRightSign();
	elem.maxLength = oldMaxLength;
}
function keyboardBackspacePress(elem)
{
	var oldMaxLength = elem.maxLength;
	elem.maxLength = oldMaxLength + 5;
	var cursorPos = getCursorPos(elem);
	var newCursorPos = cursorPos - 1;

	if (cursorPos == 0)
	{
		elem.maxLength = oldMaxLength;
		return;
	}
	else if (cursorPos == 3)
		moveCaret(elem, newCursorPos);
	else if (cursorPos == 6)
		moveCaret(elem, newCursorPos);
	else
	{
		DeleteLeftSign();
		SetLetter(" ");
		moveCaret(elem, newCursorPos);
	}
	elem.maxLength = oldMaxLength;
}