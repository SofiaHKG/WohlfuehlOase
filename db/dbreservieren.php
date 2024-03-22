<?php 
    session_start();

    // Prepared Statement verwenden, um SQL-Injections zu vermeiden  
    require("dbaccess.php");
    $sql = "INSERT INTO buchungen (id, Vorname, Nachname, Anreise, Abreise, Frühstück, Haustier, Haustierinfo, Buchungsstatus, Parkplatz, Datum, Preis) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db_obj->prepare($sql);
    $id = "NULL";
    $stmt-> bind_param("issssddssdsd", $id, $Vorname, $Nachname, $Anreise, $Abreise, $Fruehstueck, $Haustier, $HaustierInfo, $Buchungsstatus, $Parkplatz, $Datum, $Preis);

    $id = NULL; 
    $Vorname = $_SESSION["Vorname"];
    $Nachname = $_SESSION["Nachname"];
    $Anreise = $_SESSION["Anreise"];
    $Abreise = $_SESSION["Abreise"];
    $Fruehstueck = $_SESSION["Fruehstueck"];
    $Parkplatz = $_SESSION["Parkplatz"];
    $Haustier = $_SESSION["Haustier"];
    $HaustierInfo = $_SESSION["InfosHaustier"];
    $Buchungsstatus = "neu";
    $Datum = date("Y-m-d H:i:s", time());

    // Berechnung wie viele Nächte
    $dateTime1 = new DateTime($_SESSION["Anreise"]);
    $dateTime2 = new DateTime($_SESSION["Abreise"]);
    $interval = $dateTime1->diff($dateTime2);
    $Nächte = $interval->days;
    
    // Berechnung Preis
    $Preis = 80 * $Nächte;

    if($_SESSION["Parkplatz"] == 1){
        $Preis += $Nächte * 15;
    }
    if($_SESSION["Fruehstueck"] == 1){
        $Preis += $Nächte * 15;
    }
    if($_SESSION["Haustier"] == 1){
        $Preis += $Nächte * 15;
    }
 
    $_SESSION["schonAusgebucht"] = 0;
    
    $stmt->execute();
    $stmt->close();
    
    header('Location: /DOCUMENT_ROOT/index.php?site=gebucht');
    exit; 
?>