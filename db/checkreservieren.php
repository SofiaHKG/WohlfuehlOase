<?php
    session_start();
    $redirectToBooking = 0; 

    require("dbaccess.php");

  
    // Prepared Statement verwenden, um SQL-Injections zu vermeiden
    $stmt = $db_obj->prepare("SELECT Anreise, Abreise FROM buchungen WHERE (Anreise <= ? AND Abreise >= ?) OR (Anreise <= ? AND Abreise >= ?) OR (Anreise >= ? AND Abreise <= ?)");
    $anreise = $_POST["anreise"];
    $abreise = $_POST["abreise"];
    $stmt->bind_param("ssssss", $anreise, $anreise, $abreise, $abreise, $anreise, $abreise);
    $stmt->execute();
    $result = $stmt->get_result();

    // überprüfen, ob sich Buchungen überschneiden
    while ($row = $result->fetch_array()) { 
        if ((($_POST["anreise"] >= $row['Anreise'] && $_POST["abreise"] <= $row['Abreise']) || 
        ($_POST["anreise"] >= $row['Anreise'] && $_POST["anreise"] <= $row['Abreise'] && $_POST["abreise"] >= $row['Abreise']) || 
        ($_POST["anreise"] <= $row['Anreise']) && ($_POST["abreise"] >= $row['Anreise']))) { 
            $_SESSION["schonAusgebucht"] = 1;
            $redirectToBooking = 1;
        } else {
            $_SESSION["schonAusgebucht"] = 0;
        }
    }
    $stmt->close();
    
   
    if(isset($_POST["anreise"]) && isset($_POST["abreise"])){
         // Überprüfen, ob Anreise vor heute ist
        if($_POST["anreise"] < date("Y-m-d")){
            $_SESSION["anreiseVorHeute"] = 1;
            $redirectToBooking = 1; 
        } else {
            $_SESSION["anreiseVorHeute"] = 0;
        }
        if($_POST["abreise"] < date("Y-m-d")){
            $_SESSION["abreiseVorHeute"] = 1;
            $redirectToBooking = 1; 
        } else {
            $_SESSION["abreiseVorHeute"] = 0;
        }

        // Überprüfen, ob Anreise nach Abreise ist
        if($_POST["anreise"] > $_POST["abreise"]){
            $_SESSION["anreiseNachAbreise"] = 1;
            $redirectToBooking = 1; 
        } else {
            $_SESSION["anreiseNachAbreise"]  = 0;
        }
    }

    // Frühstück überprüfen
    if (!isset($_POST["fruehstueck"])){
        $_SESSION["Fruehstueck"] = 0;
      } else {
        $_SESSION["Fruehstueck"] = 1;
    }

    // Parkplatz überprüfen
    if (!isset($_POST["parkplatz"])){
        $_SESSION["Parkplatz"] = 0;
      } else {
        $_SESSION["Parkplatz"] = 1;
    }

    // Haustier überprüfen
    if (!isset($_POST["haustier"])){
        $_SESSION["Haustier"] = 0;
      } else {
        $_SESSION["Haustier"] = 1;
    }

    // Information zu Haustier überprüfen
    if(!isset($_POST["infosHaustier"])){
        $_SESSION["InfosHaustier"] = "";
    } else {
        $_SESSION["InfosHaustier"] = $_POST["infosHaustier"];
    }
 
    $_SESSION["Anreise"] = $_POST["anreise"];
    $_SESSION["Abreise"] = $_POST["abreise"];

    if($redirectToBooking == 1){
        header('Location: /DOCUMENT_ROOT/index.php?site=neueReservierung');
        exit;
      } else {
        header('Location: /DOCUMENT_ROOT/db/dbreservieren.php');
        exit;
      } 
?>