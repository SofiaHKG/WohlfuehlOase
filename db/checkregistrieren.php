<?php
  session_start();

  $redirectToRegister = 0; 

  require("dbaccess.php");

  $SESSION["bereitsAccount"] = 0;

  if (isset($_POST["username"])) {
    // Prepared Statement verwenden, um SQL-Injections zu vermeiden
    $stmt = $db_obj->prepare("SELECT Username FROM users WHERE Username = ?");
    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    $result = $stmt->get_result();

    // überprüfen, ob username bereits vergeben ist
    if ($result->fetch_array()) { 
        $_SESSION["bereitsAccount"] = 1; 
        $redirectToRegister = 1;
    } else {
        $_SESSION["bereitsAccount"] = 0;
    }

    $stmt->close();
  }

  // Anrede überprüfen
  if(!isset($_POST["anrede"]) || !($_POST["anrede"] == "Frau" || $_POST["anrede"] == "Herr" || $_POST["anrede"] == "Keine Anrede")) {
    $_SESSION["anredeVergleich"] = 0;
    $redirectToRegister = 1;
  } else {
    $_SESSION["anredeVergleich"] = 1;
  }

  // Vorname überprüfen
  if(!isset($_POST["vorname"]) || trim($_POST["vorname"]) == "" || !preg_match("/^[a-zA-ZäöüÄÖÜß']*$/", $_POST["vorname"])) {
    $_SESSION["vornameVergleich"] = 0;
    $redirectToRegister = 1;
  } else {
    $_SESSION["vornameVergleich"] = 1;
  }

  // Nachname überprüfen
  if(!isset($_POST["nachname"]) || trim($_POST["nachname"]) == "" || !preg_match("/^[a-zA-ZäöüÄÖÜß']*$/", $_POST["nachname"])) {
    $_SESSION["nachnameVergleich"] = 0;
    $redirectToRegister = 1;
  } else {
    $_SESSION["nachnameVergleich"] = 1;
  }

  // Email überprüfen
  $email = $_POST["email"];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    $_SESSION["emailVergleich"] = 0;
    $redirectToRegister = 1;
  } else {
    $_SESSION["emailVergleich"] = 1;
  }
  
  // Passwort vergleichen
  if(isset($_POST["passwort1"]) && isset($_POST["passwort2"]) && $_POST["passwort1"] != $_POST["passwort2"]) {
    $_SESSION["passwortVergleich"] = 0;
    $redirectToRegister = 1;
  } else {
    $_SESSION["passwortVergleich"] = 1;
  }

  // Newsletter überprüfen
  if (!isset($_POST["newsletter"])){
    $_SESSION["Newsletter"] = 0;
  } else {
    $_SESSION["Newsletter"] = 1;
  }

  // Session Variablen setten 
  $_SESSION["Username"] = $_POST["username"];
  $_SESSION["Passwort"] = $_POST["passwort1"];
  $_SESSION["Anrede"] = $_POST["anrede"];
  $_SESSION["Vorname"] = $_POST["vorname"];
  $_SESSION["Nachname"] = $_POST["nachname"];
  $_SESSION["Email"] = $_POST["email"]; 

  
  if($redirectToRegister == 1){
    header('Location: /DOCUMENT_ROOT/index.php?site=registrieren');
    exit;
  } else {
    header('Location: /DOCUMENT_ROOT/db/dbregistrieren.php');
    exit;
  } 
?>