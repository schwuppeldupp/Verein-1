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

if (document.forms["registrierung"].hausnummer.value=="") {

alert('Bitte geben Sie eine Hausnummer an!')

return(false);

}

if (!validPlz(document.forms["registrierung"].plz.value)) {

alert('Bitte geben Sie eine korrekte Postleitzahl ein (5 Stellen!)');
   
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




/* Passwort1 und Passwort2 auf Gleichheit prüfen */

var passwort1 = document.getElementById('passwort1');
var passwort2 = document.getElementById('passwort2');

var checkPasswordValidity = function() {
    if (passwort1.value != passwort2.value) {
        passwort2.setCustomValidity('Passwörter müssen übereinstimmen!');
    } else {
        passwort2.setCustomValidity('');
    }        
};

passwort1.addEventListener('change', checkPasswordValidity);
passwort2.addEventListener('change', checkPasswordValidity);



// Sobald der Nutzer das Passwort1-Feld anklickt, erscheint der Kriterienkatalog
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// Sobald der Nutzer außerhalb des Passwort1-Feldes klickt, verschwindet der Kriterienkatalog wieder
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// Überprüfung sobald der Nutzer etwas eintippt
myInput.onkeyup = function() {

  // Überprüfung Kleinbuchstaben
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Überprüfung Großbuchstaben´
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }
    
  
  // Überpfügung Zahl
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Überprüfung Passwortlänge
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
}