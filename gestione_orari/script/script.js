function refresh() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        result = this.responseText;
    }
    xhttp.open("GET", "../pages/parser.php");
    xhttp.send();  
}

function assente(d,h,id,m,idH,idDiv) {
    week = document.getElementById("a").value;
    const xhttp = new XMLHttpRequest();
    alert(d+' '+h+' '+id+' '+m)
    xhttp.onload = function() {
        result = this.responseText;
        document.getElementById(idDiv).style.backgroundColor="red";
    }
    xhttp.open("GET", "../pages/sostituzioni.php?d="+d+"&h="+h+"&id="+id+"&m="+m+"&idH="+idH+"&week="+week);
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

function pathfinder(id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const list = document.getElementById("listaContainer");
        while (list.hasChildNodes()) {
            list.removeChild(list.firstChild);
        }
        resp =(this.response).split(",");
        for(i=0;i<resp.length;i++){

            const node = document.createElement("li");

            node.setAttribute("onclick","sostituisci("+resp[i]+","+id+")")

            if(resp[i].includes("*")){
                node.setAttribute("class","assigned")
                resp[i]=resp[i].replace("*", "")
            }

            node.setAttribute("id","prof"+[i])
            const textnode = document.createTextNode(resp[i]);

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