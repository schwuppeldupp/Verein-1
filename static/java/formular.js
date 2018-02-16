/* Überprüfung der Formulareingaben   */

function checkFormular() {

if (document.forms["registrierung"].nachname.value=="") {

alert('Bitte geben Sie einen Nachnamen an!')

return(false);

}

if (document.forms["registrierung"].vorname.value=="") {

alert('Bitte geben Sie einen Vornamen an!')

return(false);

}

if (document.forms["registrierung"].strasse.value=="") {

alert('Bitte geben Sie eine Straße an!')

return(false);

}

if (document.forms["registrierung"].hausnr.value=="") {

alert('Bitte geben Sie eine Hausnummer an!')

return(false);

}

if (!validPlz(document.forms["registrierung"].plz.value)) {

alert('Bitte geben Sie eine korrekte Postleitzahl ein (5 Stellen!');
   
return(false);   

}

if (document.forms["registrierung"].ort.value=="") {

alert('Bitte geben Sie einen Wohnort an!')

return(false);

}

if (!validTel(document.forms["registrierung"].telNr.value)) {

alert('Bitte geben Sie eine korrekte Telefonnummer ein!');
   
return(false); 

}

if (!validEmail(document.forms["registrierung"].email.value)) {

alert('Bitte geben Sie eine korrekte Email-Adresse ein!');
   
return(false);   

}

if (document.forms["registrierung"].gebdatum.value=="") {

alert('Bitte geben Sie ein Geburtsdatum an!');

return(false);

} 
  
if (document.forms["registrierung"].benutzername.value=="") {

alert('Bitte geben Sie einen Benutzernamen an!');

return(false);

}

if (!validPasswort1(document.forms["registrierung"].passwort1.value)) {

alert('Ihr Passwort ist nicht sicher!');
   
return(false); 

}



/*Unterfunktionen zur Prüfung der Formulareingaben
  
/*Unterfunktion zur Email-Prüfung */
  
function validEmail(email) {

  var strReg = "^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$";

  var regex = new RegExp(strReg);

  return(regex.test(email));

}

/*Unterfunktion zur PLZ-Prüfung */

function validPlz(plz) {

  var strReg = "^([0-9]{5})+$";

  var regex = new RegExp(strReg);

  return(regex.test(plz));

}

/*Unterfunktion zur Passwort-Prüfung */

function validPasswort1(passwort1) {

  var strReg = "^([A-Z0-9a-z]{8,})+$";

  var regex = new RegExp(strReg);

  return(regex.test(passwort1));

}

/* Unterfunktion zur Telefonnummer-Prüfung */ 

function validTel(telNr) {

  var strReg = "^([0-9])+$";

  var regex = new RegExp(strReg);

  return(regex.test(telNr));

}

}