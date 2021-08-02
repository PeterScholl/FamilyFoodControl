"use strict"

var fccdaten = {};

function init() {
  console.log("fcc-skript initialisieren...");
}

function loadDocGet(url, cFunction) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {cFunction(this);}
  xhttp.open("GET", url);
  xhttp.send();
}

function holeArtikel() {
  console.log("Ajax-Daten zu Artikeln holen");
  var daten = {};
  loadDocGet("ajaxjsondata.php?article=1", function(xhttp) {
    daten = JSON.parse(xhttp.responseText);
    //console.log(JSON.stringify(daten));
    let len = daten.length;
    for (let i=0; i<len; i++) {
      $("#liste").append("<li>"+daten[i].name+"</li>");
      $("#dl_articles").append("<option value=\""+daten[i].name+"\">");
    }
    fccdaten.artikel=daten;
  })
  console.log("Ajax-Daten da ?");  
}

function holeArtikel_orig() {
  console.log("Ajax-Daten zu Artikeln holen");
  const xmlhttp = new XMLHttpRequest();
  var daten = {};
  xmlhttp.onload = function() {
    daten = JSON.parse(this.responseText);
    console.log(JSON.stringify(daten));
    let len = daten.length;
    for (let i=0; i<len; i++) {
      $("#liste").append("<li>"+daten[i].name+"</li>");
      $("#dl_articles").append("<option value=\""+daten[i].name+"\">");
    }
  }
  xmlhttp.open("GET", "ajaxjsondata.php?article=1");
  xmlhttp.send();
  console.log("Ajax-Daten da ?");  
}
