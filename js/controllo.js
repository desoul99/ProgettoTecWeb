let dettagli_form = {
  "nome": ["Nome", /^[\w\s]{2,20}$/, "Nome non corretto"],//w{2,20} controlla che ci sia da un min di 2 lettere ad un max di 29
  "mail": ["Mail", /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/, "Mail non valida"],
  "oggetto": ["Oggetto", /^[\w\s]{5,30}$/, "Oggetto non inserito"],
  "messaggio": ["Messaggio da inserire.....", /^.{10,1024}$/s, "Messaggio non inserito"]
}
function campodefault(input){
  input.className = "default-text";
  input.value = dettagli_form[input.id][0];
}

function campoPerInput(input){
  if(input.value == dettagli_form[input.id][0]){
    input.value ="";
    input.className="";
  }
}

function caricamento(){
  for(var key in dettagli_form){
    var input = document.getElementById(key);
    campodefault(input);
    input.onfocus = function(){
      campoPerInput(this);
    };
  }
}

function mostraError(input){
  var p = input.parentNode;
  var elemento = document.createElement("strong");
  elemento.className = "erroriJS";
  elemento.appendChild(document.createTextNode(dettagli_form[input.id][2]));
  p.appendChild(elemento);
}

function validazioneCampo(input){

  var parent = input.parentNode;//lo specializzazione span
  if(parent.children.length == 2){
    parent.removeChild(parent.children[1]);//lo strong eventuale
    console.log(parent.children[1]);
  }

  var regex = dettagli_form[input.id][1];
  var text = input.value;
  if(text.search(regex) != 0){
    mostraError(input);
    return false;
  }
  else {
    return true;
  }
}
function validateForm(){
  var corretto = true;
  for(var key in dettagli_form){
    var input = document.getElementById(key);
    var risultato = validazioneCampo(input);
    corretto = corretto && risultato;
  }
  return corretto;
}
