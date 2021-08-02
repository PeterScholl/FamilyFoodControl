<?php
  //ACHTUNG - alle Ausgaben dieses Skriptes müssen
  //JSON-Format haben - auch FEHLERMELDUNGEN ?!
  $debug=false;
  global $retObj;
  $retObj = new stdClass();

  function debugTextOutput($test) {
    global $debug;
    if ($debug) {
      echo "".$test."<br>\n";
    }
  }

  //debug-Optionen
  ini_set('display_errors', 1);
  ini_set('log_errors', 1);
  ini_set('error_log', './ERROR.LOG');
  error_reporting(E_ALL & ~E_NOTICE);
  
  require_once("config.php"); // konfiguration lesen
  // Initialize the session
  session_start();
  
  // TODO: BERECHTIGUNGEN überprüfen - SESSION?!

  //Open-and-prepare database
  require_once("sqlite_inc.php");

  if(!$db) {
    debugTextOutput("Datenbank kann nicht geöffnet werden!");
    $retObj->error = "could not open database!";
  } 
  
  // Processing get-data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["debug"])) {
      $debug=true;
    }
    if (isset($_GET["article"])) { //hier sollen alle Artikel zurückgeliefert werden
      debugTextOutput("Artikel werden gelesen - Datenbank");
      $retObj = getTableAsArray("article");
    } else if (isset($_GET["shoplist"])) { // hier soll eine Einkaufsliste geliefert werden
      debugTextOutput("Einkaufsliste wird gelesen: ".$_GET["shoplist"]);
      $num = (int)$_GET["shoplist"];
      $retObj = getSingleTableRow('shoppinglist',$num);
      
    }
  }


$myJSON = json_encode($retObj);

echo $myJSON;
?>
