function refresh() {
    document.getElementById("loadingArea").style.display="flex";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        alert(this.responseText)
        result = this.responseText;
        document.getElementById("loadingArea").style.display="none";
    }
    xhttp.open("GET", "../pages/parser.php?materie="+"../file/EXP_MATIERE.txt"+"&prof="+"../file/EXP_PROFESSEUR.txt"+"&classi="+"../file/EXP_CLASSE.txt"+"&ore="+"../file/EXP_COURS.txt");
    xhttp.send();  
}

function refreshLoad(){
    document.getElementById("loadingArea").style.display="flex";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        alert(this.responseText)
        result = this.responseText;
        document.getElementById("loadingArea").style.display="none";
    }
    xhttp.open("GET", "../pages/parser.php?materie="+"../file/EXP_MATIERE.txt"+"&prof="+"../file/EXP_PROFESSEUR.txt"+"&classi="+"../file/EXP_CLASSE.txt"+"&ore="+"../file/EXP_COURS.txt");
    xhttp.send(); 
}

function assente(d,h,id,m,idH,idDiv) {
    week = document.getElementById("a").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        result = this.responseText;
        document.getElementById(idDiv).style.backgroundColor="red";
    }
    xhttp.open("GET", "../pages/sostituzioni.php?d="+d+"&h="+h+"&id="+id+"&m="+m+"&idH="+idH+"&week="+week);
    xhttp.send();
}

function fuoriclasse(d,h,id,m,idH,idDiv) {
    week = document.getElementById("a").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        result = this.responseText;
        document.getElementById(idDiv).style.backgroundColor="red";
    }
    xhttp.open("GET", "../pages/fuoriclasse.php?d="+d+"&h="+h+"&id="+id+"&m="+m+"&idH="+idH+"&week="+week);
    xhttp.send();
}

function controlloAss(id){
    week = document.getElementById("a").value;
    var father= document.getElementById("orarioProf").querySelectorAll(".ora");
    for(i=0;i<father.length;i++){
        father[i].style.backgroundColor="#a2beec";
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        resp = this.responseText;
        resp = resp.split(",");
        for(i=0;i<resp.length;i++){
            document.getElementById(resp[i]).style.backgroundColor="red";
        }
    }
    xhttp.open("GET", "../pages/controlloAss.php?id="+id+"&week="+week);
    xhttp.send();
}

function controlloAssClasse(id){
    week = document.getElementById("a").value;
    var father= document.getElementById("orarioClasse").querySelectorAll(".ora");
    for(i=0;i<father.length;i++){
        father[i].style.backgroundColor="#a2beec";
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        resp = this.responseText;
        resp = resp.split(",");
        for(i=0;i<resp.length;i++){
            document.getElementById(resp[i]).style.backgroundColor="red";
        }
    }
    xhttp.open("GET", "../pages/controlloAssClasse.php?id="+id+"&week="+week);
    xhttp.send();
}

function pathfinder(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const list = document.getElementById("listaContainer");
        while (list.hasChildNodes()) {
            list.removeChild(list.firstChild);
        }
        window.alert(this.response)
        resp =(this.response).split(",");
        for(i=0;i<resp.length;i++){

            const node = document.createElement("li");

            var idProf= resp[i].split("-")[1]

            node.setAttribute("onclick","sostituisci("+idProf+","+id+")")

            if(resp[i].includes("*")){
                node.setAttribute("class","assigned")
                resp[i]=resp[i].replace("*", "")
            }

            node.setAttribute("id","prof"+[i])
            const textnode = document.createTextNode(resp[i].split("-")[0]);

            node.appendChild(textnode);

            document.getElementById("listaContainer").appendChild(node);
        }
    }
    xhttp.open("GET", "../pages/pathfinder.php?id="+id);
    xhttp.send();
}

function sostituisci(resp, id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        location.reload();
    }
    xhttp.open("GET", "../pages/pathresolver.php?id="+id+"&idProf="+resp);
    xhttp.send();
}

function cercaProf(){
    var profCercato = document.getElementById("ricerca").value
    var lista= document.getElementById("listaProf");
    if(profCercato!=""){
        for(var i=0;i<lista.children.length;i++){
            if(!lista.children[i].innerHTML.toUpperCase().includes(profCercato.toUpperCase())){
                lista.children[i].style.display = "none";
            }
            else{
                lista.children[i].style.display = "inline-flex";
            }
        }

    }
    else{
        for(var i=0;i<lista.length;i++){
            lista.children[i].style.display = "inline-flex";
        }
    }
}