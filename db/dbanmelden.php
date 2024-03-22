<?php 
    session_start();

    // Prepared Statement verwenden, um SQL-Injections zu vermeiden
    require("dbaccess.php");
    $stmt = $db_obj->prepare("SELECT Username, Passwort, Vorname, Nachname, Anrede, Rolle, Email, Newsletter, aktiv FROM users WHERE Username = ?");
    $stmt->bind_param("s", $_POST["usernameLoggedIn"]);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row =$result->fetch_assoc()) { 
        if($_POST["usernameLoggedIn"] == $row['Username'] && password_verify($_POST["passwortLoggedIn"], $row['Passwort'])){
            if($row["aktiv"] == "aktiv"){
                // Session Variablen setten, wenn sich Admin anmeldet
                if($_POST["usernameLoggedIn"] == "hoteladmin" && $_POST["passwortLoggedIn"] == 1234){
                    $_SESSION["anmeldeStatus"] = 1;
                    $_SESSION["usernameLoggedIn"] = $_POST["usernameLoggedIn"];
                    $_SESSION["Rolle"] = $row['Rolle'];
                    $_SESSION["Vorname"] = $row['Vorname'];
                    $_SESSION["Nachname"] = $row['Nachname'];
                    $_SESSION["Rolle"] = $row['Rolle'];
                    $_SESSION["Anrede"] = $row['Anrede'];
                    $_SESSION["Email"] = $row['Email'];
                    $_SESSION["newsletter"] = $row['Newsletter'];
                } // Session Variablen setten, wenn sich ein normaler User anmeldet
                else {
                    $_SESSION["anmeldeStatus"] = 2;
                    $_SESSION["usernameLoggedIn"] = $_POST["usernameLoggedIn"];
                    $_SESSION["passwortLoggedIn"] = $_POST["passwortLoggedIn"];
                    $_SESSION["Vorname"] = $row['Vorname'];
                    $_SESSION["Nachname"] = $row['Nachname'];
                    $_SESSION["Rolle"] = $row['Rolle'];
                    $_SESSION["Anrede"] = $row['Anrede'];
                    $_SESSION["Email"] = $row['Email'];
                    $_SESSION["Newsletter"] = $row['Newsletter'];
                }
                // anmeldung klappt 
                $stmt->close();
                header('Location: /DOCUMENT_ROOT/index.php?site=homepage');
                exit;  
            }
        } 
    }

    // anmeldung geht schiief
    $_SESSION["anmeldeStatus"] = 0;
    $stmt->close();
    header('Location: /DOCUMENT_ROOT/index.php?site=anmelden');
    exit; 
?>