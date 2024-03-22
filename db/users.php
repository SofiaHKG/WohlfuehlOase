<h2> Alle User</h2>

<?php 

  require("dbaccess.php"); 
  if(isset($_POST["BuchungsstatusÄndern"])){
      // Buchungsstatus ändern
      // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
      $sqlBuchung = "UPDATE buchungen SET Buchungsstatus = ? WHERE id = ?";
      $stmtBuchung = $db_obj->prepare($sqlBuchung);
      $stmtBuchung->bind_param("sd", $_POST["Buchungsstatus"], $_POST["BuchungsId"]);
      $stmtBuchung ->execute();
      $stmtBuchung->close();
  }

  if(isset($_POST["userBearbeiten"])){
      $_SESSION["userBearbeiten"] = $_POST["userBearbeiten"];
      $_SESSION["selectedUser"] = $_POST['Username'];
  }

  if(isset($_POST["changeType"])) {
      $_SESSION["changeType"] = $_POST["changeType"];
    }

 // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
  $sql = "SELECT id, Username, Passwort, Anrede, Vorname, Nachname, Email, Newsletter, aktiv FROM users";
  $stmt = $db_obj->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) { 
    $Vorname = $row["Vorname"];
    $Nachname = $row["Nachname"];
    if(isset($_SESSION["userBearbeiten"]) && $_SESSION["userBearbeiten"] == 1 && ((isset($_POST["Username"]) && $_POST["Username"] == $row["Username"]) || (isset($_SESSION["selectedUser"] ) && $_SESSION["selectedUser"] == $row["Username"]))) {
      $_SESSION["Vorname"] = $row["Vorname"];
      $_SESSION["Nachname"] = $row["Nachname"];
      echo  '<form action="db/checkprofilbearbeiten.php" method="post">';

        // Anrede vergleichen
        if(isset($_SESSION["anredeVergleich"]) && ($_SESSION["anredeVergleich"] == 0)){
          echo "<label style='font-weight: 600;'>Wählen Sie eine Anrede!</label>";
        }
        echo '<div>
            <label for="anrede">Anrede:</label>
            <select name="anrede" required>
                <option disabled selected>Bitte auswählen</option>
                <option value="Frau">Frau</option>
                <option value="Herr">Herr</option>
                <option value="Keine Anrede">Keine Anrede</option>
            </select>
            </div>';
           
        // Vorname vergleichen    
        if(isset($_SESSION["vornameVergleich"]) && ($_SESSION["vornameVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Geben Sie einen Vornamen ohne Sonderzeichen ein!</label>";
        }
        echo '<div>
          <label for="vorname">Vorname:</label>
          <input
              type="text"
              name="vorname"
              value="'.$row["Vorname"].'"
              required />
          </div>';

        // Nachname vergleichen  
        if(isset($_SESSION["vornameVergleich"]) && ($_SESSION["vornameVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Geben Sie einen Nachnamen ohne Sonderzeichen ein!</label>";
        }
        echo '<div>
          <label for="nachname">Nachname:</label>
          <input
              type="text"
              name="nachname"
              value="'.$row["Nachname"].'"
              required />
          </div>';

        // Email vergleichen 
        if(isset($_SESSION["emailVergleich"]) && ($_SESSION["emailVergleich"] == 0)){
              echo "<label style='font-weight: 600;'>Geben Sie eine gültige Email-Adresse ein!</label>";
        }
        echo '<div>
          <label for="email">E-Mail:</label>
          <input
              type="email"
              name="email"
              value="'.$row["Email"].'"
              required />
          </div>';
        
        // bereits Account vergleichen
        if(isset($_SESSION["bereitsAccount"]) && $_SESSION["bereitsAccount"] == 0){
          echo "<label style='font-weight: 600;'>Dieser Username ist leider bereits vergeben!</label>";
        }
        echo '<div>
            <label for="username">Username:</label>
            <input
                type="text"
                name="username"
                value="'.$row["Username"].'"
                required />
            </div>';

        // Passwortvergleich überprüfen
        if(isset($_SESSION["passwortVergleich"]) && ($_SESSION["passwortVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Passwörter stimmen nicht überein!</label>";
        }
        echo '<div>
            <label for="passwort1">Passwort:</label>
            <input
                type="password"
                name="passwort1"
                required />
            </div>';
        echo '<div>
            <label for="passwort2">Passwort wiederholen:</label>
            <input
                type="password"
                name="passwort2"
                required />
            </div>
            <div>
            <input type="checkbox" name="newsletter"'; 
            // überprüfen, ob Newsletterfeld ist angeklickt
            if($row["Newsletter"] == 1){echo 'checked="checked"';}
            echo 'class="checkbox"/>
            <label for="newsletter">Zum Newsletter anmelden!</label>
          </div>
          <div>
            <input type="checkbox" name="aktiv"'; 
            // überprüfen, ob aktiv ist angeklickt
            if(trim($row["aktiv"])  == "aktiv"){echo "checked='checked'";}
            echo 'class="checkbox"/>
            <div>
            <div><label for="aktiv">aktiv</label></div>
        <input name="changeType" value="admin" hidden>
        <input name="currentUsername" value="'.$row["Username"].'" hidden>
        <button type="submit">Senden</button>
      </form>';
    } else {
      // Reguläre Daten anzeigen
      echo '<div class="container-fluid">
          <div class="row first-row">
          <div class="col-lg-6 px-0"><p>Username:</p></div>
          <div class="col-lg-6 px-0"><p>'.$row["Username"].'</p></div>
          </div>
          <div class="row first-row">
          <div class="col-lg-6 px-0"><p>Vorname:</p></div>
          <div class="col-lg-6 px-0"><p>'.$row["Vorname"].'</p></div>
          </div>
          <div class="row first-row">
          <div class="col-lg-6 px-0"><p>Nachname:</p></div>
          <div class="col-lg-6 px-0"><p>'.$row["Nachname"].'</p></div>
          </div>
          <div class="row first-row">
          <div class="col-lg-6 px-0"><p>Email:</p></div>
          <div class="col-lg-6 px-0"><p>'.$row["Email"].'</p></div>
          </div>
          <div class="row first-row">
          <div class="col-lg-6 px-0"><p>Aktivität:</p></div>
          <div class="col-lg-6 px-0"><p>'.$row["aktiv"].'</p></div>
          </div>';

         // user Bearbeiten Knopf 
        echo '<form action="index.php?site=users" method="POST">
          <input name="Username" value="'.$row['Username'].'" hidden>
          <input name="changeType" value="admin" hidden>
          <input name="userBearbeiten" value="1" hidden>
          <button type="submit">Bearbeiten</button>
          </form>';

        // Buchungen anzeigen 
        if(isset($_POST["buchungenAnzeigen"]) && isset($_POST["Username"]) && $_POST["Username"] == $row["Username"]){
          $counter = 0;

          // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
          $stmt1 = $db_obj->prepare("SELECT id, Vorname, Nachname, Anreise, Abreise, Frühstück, Haustier, Haustierinfo, Buchungsstatus, Parkplatz, Datum, Preis FROM buchungen");
          $stmt1->execute();
          $result1 = $stmt1->get_result();
          $keineBuchungen = 1; 

          // Buchungen für einzelne Personen anzeigen
          while ($row = $result1->fetch_assoc()) {
              if(($row["Vorname"] == $Vorname && $row["Nachname"] == $Nachname)){
                $counter = $counter + 1;  
                $keineBuchungen = 0;
                echo '<h3>Buchung '.$counter.'</h3>';
                echo '<p>'.$row["Datum"].'</p>';
                echo '<div class="container-fluid">';
                if($_SESSION["Vorname"] == "Hotel" && $_SESSION["Nachname"] == "Admin"){
                  echo '<div class="row first-row">
                  <div class="col-sm-6 px-0"><p>Vorname:</p></div>
                  <div class="col-sm-6 px-0"><p>'.$row["Vorname"].'</p></div>
                  </div>';
                  echo '<div class="row first-row">
                  <div class="col-sm-6 px-0"><p>Nachname:</p></div>
                  <div class="col-sm-6 px-0"><p>'.$row["Nachname"].'</p></div>
                  </div>';
                }
                echo '<div class="row first-row">
                <div class="col-6 px-0 "><p>Anreise:</p></div>
                <div class="col-6 px-0 "><p>'.$row["Anreise"].'</p></div>
                </div>';
                echo '<div class="row first-row">
                <div class="col-6 px-0"><p>Abreise:</p></div>
                <div class="col-6 px-0"><p>'.$row["Abreise"].'</p></div>
                  </div>';
                if($row["Frühstück"] == 1){
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Frühstück:</p></div>
                  <div class="col-6 px-0"><p>ja</p></div>
                  </div>';
                } else {
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Frühstück:</p></div>
                  <div class="col-6 px-0"><p>nein</p></div>
                  </div>';
                }
                if($row["Parkplatz"] == 1){
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Parkplatz:</p></div>
                  <div class="col-6 px-0"><p>ja</p></div>
                  </div>';
                } else {
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Parkplatz:</p></div>
                  <div class="col-6 px-0"><p>nein</p></div>
                  </div>';
                }
                if($row["Haustier"] == 1){
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Haustier:</p></div>
                  <div class="col-6 px-0"><p>ja</p></div>
                  </div>';
                } else {
                  echo '<div class="row first-row">
                  <div class="col-6 px-0"><p>Mit Haustier:</p></div>
                  <div class="col-6 px-0"><p>nein</p></div>
                  </div>';
                }
                echo '<div class="row first-row">
                <div class="col-6 px-0"><p>Buchungsstatus:</p></div>
                
                <div class="col-6 px-0"><p>
                <form action="index.php?site=users" method="POST" style="background-color: #e6e6e6;">
                    <select name="Buchungsstatus" required>
                        <option disabled selected>Bitte auswählen</option>
                        <option value="neu"'; 
                        if($row["Buchungsstatus"] == "neu"){echo 'selected';}
                        echo '>neu</option>
                        <option value="bestätigt" '; 
                        if($row["Buchungsstatus"] == "bestätigt"){echo 'selected';}
                        echo '>bestätigt</option>
                        <option value="storniert"'; 
                        if($row["Buchungsstatus"] == "storniert"){echo 'selected';}
                        echo '>storniert</option>
                    </select>
                    <input name="BuchungsstatusÄndern" hidden>
                    <input name="BuchungsId" value='.$row["id"].' hidden>
                    <button type="submit">Buchungsstatus ändern</button>
                </form></p></div>
                </div>';    
                echo '<div class="row first-row">
                <div class="col-6 px-0"><p>Preis:</p></div>
                <div class="col-6 px-0"><p>'.$row["Preis"].'€</p></div>
                </div>';  
                echo '</div>'; 
              }   
        }

        if($keineBuchungen == 1){
            echo "<p>Es gibt keine Buchungen unter diesem Namen!</p>";
        }

        echo '<form action="index.php?site=users" method="POST">
            <input name="buchungenVerbergen" hidden>
            <button type="submit">Buchungen verbergen</button>
            </form>';
        }  else {
            echo '<form action="index.php?site=users" method="POST">
            <input name="buchungenAnzeigen" value="1" hidden>
            <input name="Username" value="'.$row['Username'].'" hidden>
            <button type="submit">Buchungen anzeigen</button>
            </form>';
        }
      
       
    }
  } 
  $stmt->close();
?>