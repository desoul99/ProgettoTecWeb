//Codice javascript ispirato e adattato da quello utilizzato nei laboratori del corso

let dettagli_form_contatti = {
  nome: ["Nome", /^[\w\s]{2,20}$/, "Nome non corretto"], //w{2,20} controlla che ci sia da un min di 2 lettere ad un max di 20
  mail: [
    "Mail",
    /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/,
    "Mail non valida",
  ],
  oggetto: ["Oggetto", /^.{5,30}$/, "Oggetto non inserito"],
  messaggio: [
    "Messaggio da inserire.....",
    /^[\s\S]{10,1024}$/s,
    "Messaggio non inserito",
  ],
};
let dettagli_form_recensioni = {
  nome_recensione: [
    "Nome Recensione",
    /^[a-z_]{1,32}$/,
    "Nome Recensione non valido",
  ],
  titolo: ["Titolo opera", /^.{1,128}$/, "Titolo opera non valido"],
  autore_opera: ["Autore opera", /^.{1,128}$/, "Autore opera non valido"],
  testo: [
    "Testo recensione",
    /^[\s\S]{1,4096}$/,
    "Testo recensione non valido",
  ],
  tipo: ["Tipo opera", /^[\w\s]{1,16}$/, "Tipo opera non valido"],
  tags: ["Tags", /^.{1,256}$/, "Tags non valide"],
  alt_immagine: [
    "Testo alternativo immagine",
    /.{0,64}/,
    "Testo alternativo non valido",
  ],
};

function mostraError(input, form) {
  var p = input.parentNode;
  var elemento = document.createElement("strong");
  elemento.className = "erroriJS";
  elemento.appendChild(document.createTextNode(form[input.id][2]));
  p.appendChild(elemento);
}

function validazioneCampo(input, form) {
  var parent = input.parentNode; //lo specializzazione span
  if (parent.children.length == 2) {
    parent.removeChild(parent.children[1]); //lo strong eventuale
    console.log(parent.children[1]);
  }
  var regex = form[input.id][1];
  console.log(regex);
  var text = input.value;
  console.log(input.value);
  if (text.search(regex) != 0) {
    mostraError(input, form);
    return false;
  } else {
    return true;
  }
}
function validateForm(form) {
  if (form == "contatti") {
    form = dettagli_form_contatti;
  } else {
    form = dettagli_form_recensioni;
  }
  var corretto = true;
  for (var key in form) {
    var input = document.getElementById(key);
    var risultato = validazioneCampo(input, form);
    corretto = corretto && risultato;
  }

  return corretto;
}
