<div class = "newsBeitrag">
<?php
  require("dbaccess.php");
// Wenn Beitrag zum Löschen ausgewählt - Beitrag löschen
  if(isset($_POST["id"])) {
    // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
    $sqlDelete = "DELETE FROM news WHERE id = ?";
      $stmt = $db_obj->prepare($sqlDelete);
      $stmt->bind_param("i", $_POST["id"]);
      $stmt->execute();
  }

  // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
  $sql = "SELECT id, Titel, Lead, Textfeld,Datum, Bild FROM news ORDER BY id desc";
  $stmt = $db_obj->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();

  $noNews = 1;
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class = "newsBeitrag">';
    echo '<img src="/DOCUMENT_ROOT/uploads/thumbnails/thumb_'.$row["Bild"].'" class="thumbnail">';
    echo '<h4 class="newsHeadline">'.$row["Titel"].'</h4>';
    echo '<p style="font-weight: 600;">'.$row["Datum"].'</p>';
    echo '<p style="font-weight: 600;">'.$row["Lead"].'</p>';
    echo '<p>'.$row["Textfeld"].'</p>';

    // Wenn Admin angemeldet ist, Beitrag löschbar 
    if(isset($_SESSION["usernameLoggedIn"]) && $_SESSION['usernameLoggedIn'] == "hoteladmin"){
      echo '<form action="index.php?site=news" method="POST" style="text-align: center;">
        <input name="id" value="'.$row['id'].'" hidden>
        <button type="submit style="margin: auto; display: block;">Löschen</button>
        </form>';
        echo '</div>';
    } else {
      echo '</div>';
    }
    $noNews = 0;
  } 

  if($noNews == 1){
    echo "<p>Es gibt leider keine Artikel!</p>";
  }

  $stmt->close();
?>
