function tryLog(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    backBlack()
    var emptyParameter= emptyIn(email, password);
    for(i=0;i<emptyParameter.length;i++){
        document.getElementById(emptyParameter[i]).style.border= "1px solid red";
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var result = this.responseText;
        window.alert(result);
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
        }
        if(emptyParameter[0]!=null){
            window.alert(emptyParameter[0])
            return false
        }
        else{
            return true;
        }
    }
    xhttp.open("GET", "login.php?email="+email+"&password="+password);
    xhttp.send();
    return false;
}

function backBlack(){
    document.getElementById("email").style.border= "1px solid #ccc"
    document.getElementById("password").style.border= "1px solid #ccc"
    document.getElementById("errorEmail").innerHTML=""
    document.getElementById("errorPassword").innerHTML=""
}

function emptyIn(...elements){
    var index=[];
    var campivuoti=[];
    var counter=0;
    for(let element of elements){
      if(element==""){
          index.push(counter);
      }
      counter++;
    }
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
  
    return campivuoti;
  }