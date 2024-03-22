<?php
    session_start();
    require("dbaccess.php");
    // Prepared Statement verwenden, um SQL-Injections zu vermeiden    
    $sql = "INSERT INTO news (id, Titel, Lead, Textfeld, Bild, Datum) VALUES (?, ?, ?, ?, ?, ? )";
    $stmt = $db_obj->prepare($sql);
    $stmt-> bind_param("isssss", $id, $Titel, $Lead, $Textfeld, $Bild, $Datum);
    
    $id = NULL;
    $Titel = $_SESSION["Titel"];
    $Lead = $_SESSION["Lead"];
    $Textfeld = $_SESSION["Textfeld"];
    $Bild = $_SESSION["Bild"];
    $Datum = date("Y-m-d");
    
    $stmt->execute();
    header('Location: /DOCUMENT_ROOT/index.php?site=news');
    exit;
?>