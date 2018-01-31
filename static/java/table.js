/**
* Läd Beschreibung des ersten Elements in der Liste beim Laden.
*/
window.onload = function(){
	document.getElementById("content").innerHTML = document.querySelectorAll('div[id^="tr_"]')[0].children[5].innerHTML;
	//console.log(document.querySelectorAll('div[id^="tr_"]')[0].children[5].innerHTML);
}

/**
* Erzeugt Event-Listener für die ganze Tabelle - Mouseover!.
*/
document.getElementById('table').addEventListener('mouseover', function(event) {
  func(event.target);
});

/**
* Setzt den Inhalt im Feld Beschreibung für das aktuelle Element in der Liste.
*/
function func(element) {
  if (element.parentElement.children[5] && element.parentElement.children[5].innerHTML != 'Beschreibung') {
	  document.getElementById("content").innerHTML = element.parentElement.children[5].innerHTML;
  }
}	