function tryLog(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var newPassword= document.getElementById('newPasswordIn').value;
    var confPassword= document.getElementById('confPasswordIn').value;
    backBlack()
    var emptyParameter= emptyIn("accesso", email, password);
    var emptyParameterNew= emptyIn("", newPassword, confPassword);
    if(document.getElementById("newPassword").style.display== "flex"){
        for(i=0;i<emptyParameterNew.length;i++){
            document.getElementById(emptyParameterNew[i]).style.border= "1px solid red";
        }
        if(!isValidPassword(newPassword) || emptyParameterNew== null){
            return false
        }
    }
    else{
        for(i=0;i<emptyParameter.length;i++){
            document.getElementById(emptyParameter[i]).style.border= "1px solid red";
        }
    }
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var result = this.responseText;
        window.alert(result)
        switch (result){
            case "NE":
                document.getElementById("email").style.border= "1px solid red";
                document.getElementById("errorEmail").innerHTML="Email inesistente";
                return false;
            break;
            case "NP":
                document.getElementById("password").style.border= "1px solid red";
                document.getElementById("errorPassword").innerHTML="Password errata";
                return false;
            break
            case "OP":
                document.getElementById("newPassword").style.display= "flex";
                document.getElementById("confPassword").style.display= "flex";
                document.getElementById("newPasswordIn").style.display= "";
                document.getElementById("confPasswordIn").style.display= "";
                document.getElementById("acc").style.display= "none";
                document.getElementById("acc2").style.display= "none";
                return false;
            break
        }
        if(emptyParameter[0]!=null){
            window.alert(emptyParameter[0])
            return false
        }
        else{
            window.open("../pages/listaProf.php","_self")
        }
    }
    xhttp.open("GET", "login.php?email="+email+"&password="+password+"&newPassword="+newPassword+"&confPassword"+confPassword);
    xhttp.send();
    return false;
}

function backBlack(){
    document.getElementById("email").style.border= "1px solid #ccc"
    document.getElementById("password").style.border= "1px solid #ccc"
    document.getElementById("errorEmail").innerHTML=""
    document.getElementById("errorPassword").innerHTML=""
}

function sleepFor(sleepDuration){
    var now = new Date().getTime();
    while(new Date().getTime() < now + sleepDuration){ 
        /* Do nothing */ 
    }
}

function logOut(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        result = this.responseText;  
    }
    xhttp.open("GET", "logout.php");
    xhttp.send();
    return true
}

// ----------------------------- CONTROLLI

function isValidPassword(value){
    check= checkPasswordValidation(value);
    if(check!=null){
      document.getElementById("newPasswordIn").style.border="1px solid red";
      document.getElementById("errorNewPassword").innerHTML=check;
      return false;
    }
    else{
      return true;
    }
  }

function checkPasswordValidation(value) {

    if(value==""){
      return "";
    }
  
    const isWhitespace = /^(?=.*\s)/;
    if (isWhitespace.test(value)) {
      return "La password non deve contenere spazzi.";
    }
  
    const isContainsUppercase = /^(?=.*[A-Z])/;
    if (!isContainsUppercase.test(value)) {
      return "La password deve contenere almeno un carattere maiuscolo.";
    }
  
    const isContainsLowercase = /^(?=.*[a-z])/;
    if (!isContainsLowercase.test(value)) {
      return "La password deve contenere almeno un carattere minuscolo.";
    }
  
    const isContainsNumber = /^(?=.*[0-9])/;
    if (!isContainsNumber.test(value)) {
      return "La password deve contenere almeno un numero.";
    }
  
    const isContainsSymbol =
      /^(?=.*[~`!@#$%^&*()--+={}\[\]|\\:;"'<>,.?/_₹])/;
    if (!isContainsSymbol.test(value)) {
      return "La password deve contenere almeno un carattere speciale.";
    }
  
    const isValidLength = /^.{8,16}$/;
    if (value.length<8) {
      return "La password deve essere almeno lunga 8 caratteri.";
    }
  
    return null;
  }

  function emptyIn(value, ...elements){
    var index=[];
    var campivuoti=[];
    var counter=0;
    for(let element of elements){
        if(element==""){
            index.push(counter);
        }
        counter++;
    }
    if(value=="accesso"){
        for(i=0;i<index.length;i++){
            switch (index[i]){
                case 0:
                campivuoti.push("email")
                break;
                case 1:
                campivuoti.push("password");
                break;
            }
        }
    }
    else{
        for(i=0;i<index.length;i++){
            switch (index[i]){
                case 0:
                campivuoti.push("newPasswordIn")
                break;
                case 1:
                campivuoti.push("confPasswordIn");
                break;
            }
        }
    }

    return campivuoti;
}