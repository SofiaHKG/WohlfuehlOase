<?php
  session_start();

  $redirectToProfilBearbeiten = 0; 
  $_SESSION["profilBearbeitenEnable"] = 1;
  $_SESSION["bereitsAccount"] = 1; 


  require("dbaccess.php");
  // Prepared Statement verwenden, um SQL-Injections zu vermeiden
  $stmt = $db_obj->prepare("SELECT Username, Passwort, Vorname, Nachname FROM users WHERE Username = ?");
  $stmt->bind_param("s",  $_POST["username"] );
  $stmt->execute();
  $result = $stmt->get_result();

  $alreadyAccount = false; 

  // überprüfen, ob username bereits vergeben ist
  if(isset($_SESSION["changeType"]) && $_SESSION["changeType"]=="user"){
    while ($row = $result->fetch_assoc()) { 
      echo $_SESSION['usernameLoggedIn'];
        if($_POST["username"] == $row['Username'] && $row['Username'] != $_SESSION['usernameLoggedIn']){
            $_SESSION["bereitsAccount"] = 0; 
            $redirectToProfilBearbeiten = 1;
            $alreadyAccount = true;
            $_SESSION["Username"] = $_SESSION['usernameLoggedIn'];
            echo "gibt's schon und darf nicht nochmal";
            break;
        }
      }
    if(!$alreadyAccount){
        $_SESSION["Username"] = $_POST["username"];
        echo "gibt's noch nicht";
    }
  } else {
    while ($row = $result->fetch_assoc()) { 
      if(isset($_POST["username"]) &&  $_POST["username"] == $row['Username'] && isset($_SESSION["selectedUser"]) && $_SESSION["selectedUser"] != $row['Username']){
        $_SESSION["bereitsAccount"] = 0; 
        $redirectToProfilBearbeiten = 1;
        break;
      } 
    }
    if(!$alreadyAccount){
      $_SESSION["Username"] = $_POST["username"];
    }
    $stmt->close();
    }
    
  // Anrede überprüfen
  if(!isset($_POST["anrede"]) || !($_POST["anrede"] == "Frau" || $_POST["anrede"] == "Herr" || $_POST["anrede"] == "Keine Anrede")) {
    $_SESSION["anredeVergleich"] = 0;
    $redirectToProfilBearbeiten = 1;
  } else {
    $_SESSION["anredeVergleich"] = 1;
    $_SESSION["Anrede"] = $_POST["anrede"];
  }

  // Vorname überprüfen
  if(!isset($_POST["vorname"]) || trim($_POST["vorname"]) == "" || !preg_match("/^[a-zA-ZäöüÄÖÜß']*$/", $_POST["vorname"])) {
    $_SESSION["vornameVergleich"] = 0;
    $redirectToProfilBearbeiten = 1;
  } else {
    $_SESSION["vornameVergleich"] = 1;
    $_SESSION["alterVorname"] = $_SESSION["Vorname"];
    $_SESSION["Vorname"] = $_POST["vorname"];
  }

  // Nachname überprüfen
  if(!isset($_POST["nachname"]) || trim($_POST["nachname"]) == "" || !preg_match("/^[a-zA-ZäöüÄÖÜß']*$/", $_POST["nachname"])) {
    $_SESSION["nachnameVergleich"] = 0;
    $redirectToProfilBearbeiten = 1;
  } else {
    $_SESSION["nachnameVergleich"] = 1;
    $_SESSION["alterNachname"] = $_SESSION["Nachname"];
    $_SESSION["Nachname"] = $_POST["nachname"];
  }

  // Email überprüfen
  $email = $_POST["email"];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
    $_SESSION["emailVergleich"] = 0;
    $redirectToProfilBearbeiten = 1;
  } else {
    $_SESSION["emailVergleich"] = 1;
    $_SESSION["Email"] = $_POST["email"]; 
  }
  
  // Passwort vergleichen
  if(isset($_POST["passwort1"]) && isset($_POST["passwort2"]) && $_POST["passwort1"] != $_POST["passwort2"]) {
    $_SESSION["passwortVergleich"] = 0;
    $redirectToProfilBearbeiten = 1;
  } else {
    $_SESSION["passwortVergleich"] = 1;
    $_SESSION["Passwort"] = password_hash($_POST["passwort1"], PASSWORD_DEFAULT);
  }

  // Newsletter überprüfen
  if (!isset($_POST["newsletter"])){
    $_SESSION["Newsletter"] = 0;
  } else {
    $_SESSION["Newsletter"] = 1;
  }

  // Aktivitätsstatus überprüfen
  if (!isset($_POST["aktiv"])){
    $_SESSION["aktiv"] = "inaktiv";
  } else {
    $_SESSION["aktiv"] = "aktiv";
  }

  // Vergleiche reseten, wenn Änderung erfolgreich
  function resetVergleiche(){
    $_SESSION["userBearbeiten"] = 0;
    $_SESSION["bereitsAccount"] = 1;
    $_SESSION["anredeVergleich"] = 1;
    $_SESSION["emailVergleich"] = 1;
    $_SESSION["vornameVergleich"] = 1;
    $_SESSION["nachnameVergleich"] = 1;
    $_SESSION["passwortVergleich"] = 1;
    $_SESSION['alterVorname'] = $_SESSION["Vorname"];
    $_SESSION["alterNachname"] = $_SESSION["Nachname"];
  }
  
  if($redirectToProfilBearbeiten == 0){
    if(isset($_SESSION["changeType"]) && $_SESSION["changeType"] == "user"){
      // User Information ändern
      // Prepared Statement verwenden, um SQL-Injections zu vermeiden
      $sql = "UPDATE users SET Username = ?, Passwort = ?, Vorname = ?, Nachname = ?, Anrede = ?, Email = ?, Newsletter = ? WHERE Username = ?";
      $stmt = $db_obj->prepare($sql);
      $stmt->bind_param("ssssssis", $_SESSION["Username"], $_SESSION["Passwort"], $_SESSION["Vorname"], $_SESSION["Nachname"], $_SESSION["Anrede"], $_SESSION["Email"], $_SESSION["Newsletter"], $_SESSION["usernameLoggedIn"]);
      $stmt->execute();
    
      // Namen bei betroffenen Buchungen anpassen
      $sql2 = "UPDATE buchungen SET Vorname = ?, Nachname = ? WHERE Vorname = ? AND Nachname = ?";
      $stmt = $db_obj->prepare($sql2);
      $stmt->bind_param("ssss", $_SESSION["Vorname"], $_SESSION["Nachname"], $_SESSION["alterVorname"], $_SESSION["alterNachname"]);
      $stmt->execute();
      $stmt->close();
      $_SESSION['usernameLoggedIn'] = $_POST["username"];
      $_SESSION["passwortLoggedIn"] = $_POST["passwort1"];
      
      resetVergleiche();
      echo "db";
      header('Location: /DOCUMENT_ROOT/index.php?site=profil');
      exit; 
    } else if (isset($_SESSION["changeType"]) && $_SESSION["changeType"] == "admin"){
      // User Information ändern
      // Prepared Statement verwenden, um SQL-Injections zu vermeiden
      echo $_SESSION["Username"];
      $sql = "UPDATE users SET Username = ?, Passwort = ?, Vorname = ?, Nachname = ?, Anrede = ?, Email = ?, Newsletter = ?, aktiv = ? WHERE Username = ?";
      $stmt = $db_obj->prepare($sql);
      $stmt->bind_param("ssssssiss", $_SESSION["Username"], $_SESSION["Passwort"], $_SESSION["Vorname"], $_SESSION["Nachname"], $_SESSION["Anrede"], $_SESSION["Email"], $_SESSION["Newsletter"], $_SESSION["aktiv"], $_SESSION["selectedUser"]);
      $stmt->execute();
      
      // Namen bei betroffenen Buchungen anpassen
      $sql2 = "UPDATE buchungen SET Vorname = ?, Nachname = ? WHERE Vorname = ? AND Nachname = ?";
      $stmt = $db_obj->prepare($sql2);
      $stmt->bind_param("ssss", $_SESSION["Vorname"], $_SESSION["Nachname"], $_SESSION["alterVorname"], $_SESSION["alterNachname"]);
      $stmt->execute();
      
      resetVergleiche();
      // Session Parameter wieder auf Hotel Admin ändern
      $_SESSION["Nachname"] = "Hotel";
      $_SESSION["Vorname"] = "Admin";
      $_SESSION['usernameLoggedIn'] = "hoteladmin";
      $_SESSION["passwortLoggedIn"] = "1234";
      echo "db";
      header('Location: /DOCUMENT_ROOT/index.php?site=users');
      exit; 
    }
  } else {
    if(isset($_SESSION["changeType"]) && $_SESSION["changeType"] == "user"){
      $_SESSION["userBearbeiten"] = 1;
      header('Location: /DOCUMENT_ROOT/index.php?site=profil');
      exit;
    } else {
      $_SESSION["userBearbeiten"] = 1;
      header('Location: /DOCUMENT_ROOT/index.php?site=users');
      exit; 
    }
  } 
  
?>