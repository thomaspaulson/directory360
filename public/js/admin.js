function autoFillTextBox(){
	obj = document.getElementById('URL');
	obj.value = strdocument.getElementById('Title').value;
	
	obj = document.getElementById('MetaTitle');
	obj.value = document.getElementById('Title').value;
	
}

function init(){
	document.getElementById('Title').onkeypress = autoFillTextBox;
}

window.onload = init