<h2> Alle Buchungen</h2>
<?php 

  if(isset($_POST["BuchungsstatusÄndern"])){
    // Buchungsstatus verändern
    // Prepared Statement verwenden, um SQL-Injections zu vermeiden  
    require("dbaccess.php");
    $sqlBuchung = "UPDATE buchungen SET Buchungsstatus = ? WHERE id = ?";
    $stmtBuchung = $db_obj->prepare($sqlBuchung);
    $stmtBuchung->bind_param("sd", $_POST["Buchungsstatus"], $_POST["BuchungsId"]);
    $stmtBuchung ->execute();
    $stmtBuchung->close();
  }

  $counter = 0;

  // Prepared Statement verwenden, um SQL-Injections zu vermeiden  
  require("dbaccess.php");
  $stmt = $db_obj->prepare("SELECT id, Vorname, Nachname, Anreise, Abreise, Frühstück, Haustier, Haustierinfo, Buchungsstatus, Parkplatz, Datum, Preis FROM buchungen");
  $stmt->execute();
  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    // Buchungen anzeigen: Wenn normaler User nur seine Buchungen, bei Admin alle 
    if(($row["Vorname"] == $_SESSION["Vorname"] && $row["Nachname"] == $_SESSION["Nachname"])|| ($_SESSION["usernameLoggedIn"] == "hoteladmin")){
      $counter = $counter + 1;  
      echo '<h3>Buchung '.$counter.'</h3>';
      echo '<p>'.$row["Datum"].'</p>';
      echo '<div class="container-fluid">';

      // Namen der Buchenden anzeigen, wenn Admin angemeldet ist
      if($_SESSION['usernameLoggedIn'] == "hoteladmin"){
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
      if($_SESSION['usernameLoggedIn'] != "hoteladmin"){
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
      }
      // Buchungsstatus änderbar, wenn Admin angemeldet ist
      if($_SESSION["usernameLoggedIn"] == "hoteladmin"){
        echo '<div class="row first-row">
        <div class="col-6 px-0"><p>
        <form action="index.php?site=einzelneBuchung" method="POST" style="background-color: #e6e6e6;">
            <input name="zuBearbeitendeBuchung" value="'.$row["id"].'" hidden>
            <button type="submit">Details zu dieser spezifischen Buchung anzeigen</button>
        </form></p></div>
        </div>';  
      } // Buchungsstatus nicht änderbar, wenn Admin nicht angemeldet ist 
      else {
        echo '<div class="row first-row">
        <div class="col-6 px-0"><p>Buchungsstatus:</p></div>
        <div class="col-6 px-0"><p>'.$row["Buchungsstatus"].'</p></div>
        </div>';   
      
        echo '<div class="row first-row">
        <div class="col-6 px-0"><p>Preis:</p></div>
        <div class="col-6 px-0"><p>'.$row["Preis"].'€</p></div>
        </div>';    
        echo '</div>';
      } 
    }    
  } 

  $stmt->close();
?>



