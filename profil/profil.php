<?php
  // wenn Profil Bearbeiten Knopf gedrückt wird und Passwort korrekt ist, User Bearbeiten lassen
  if(isset($_POST["changeType"])) {
    $_SESSION["changeType"] = "user";  
    $_SESSION["userBearbeiten"] = 1;
  }

  if(isset($_POST["passwortLoggedIn"]) && $_POST["passwortLoggedIn"] == $_SESSION["passwortLoggedIn"] && isset($_SESSION["userBearbeiten"]) || (isset($_SESSION["userBearbeiten"]) && $_SESSION["userBearbeiten"] == 1)) {
    $_SESSION["passwortCheckProfil"] = 1;
    include 'profil/profilBearbeiten.php';
  } else {
    if(isset($_POST["passwortLoggedIn"])){
        $_SESSION["passwortCheckProfil"] = 0;
    }
    include 'profil/profilAnzeigen.php';
  }
?>