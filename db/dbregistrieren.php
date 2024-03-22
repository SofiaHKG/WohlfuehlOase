<?php 
    session_start();

    // Prepared Statement verwenden, um SQL-Injections zu vermeiden  
    require("dbaccess.php");
    $sql = "INSERT INTO users (id, Username, Passwort, Anrede, Vorname, Nachname, Email, Newsletter, Rolle, aktiv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_obj->prepare($sql);
    $id = "NULL";
    $stmt-> bind_param("issssssiss", $id, $Username, $Passwort, $Anrede, $Vorname, $Nachname, $Email, $Newsletter, $Rolle, $Aktiv);
  
    $Username = $_SESSION["Username"];
    $Passwort = password_hash($_SESSION["Passwort"], PASSWORD_DEFAULT);
    $Anrede = $_SESSION["Anrede"];
    $Vorname = $_SESSION["Vorname"];
    $Nachname = $_SESSION["Nachname"];
    $Email = $_SESSION["Email"]; 
    $Newsletter = $_SESSION["Newsletter"];
    $Rolle = "user";
    $Aktiv =  "aktiv";

    $_SESSION["anmeldeStatus"] = 2;
    $_SESSION["usernameLoggedIn"] = $Username;
    $_SESSION["passwortLoggedIn"] = $_SESSION["Passwort"];

    $stmt->execute();
    $stmt->close();
    header('Location: /DOCUMENT_ROOT/index.php?site=homepage');
    exit; 
    
    
?>