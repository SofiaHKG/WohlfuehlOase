<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wohlfühloase</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/DOCUMENT_ROOT/stylesheet2.css" />
  </head>
  <body>

  <?php
    // Sessions unsetten
    if(isset($_POST["logOut"])){
      unset($_SESSION["anmeldeStatus"]);
      unset($_SESSION["anreiseVorHeute"]);
      unset($_SESSION["abreiseVorHeute"]);
      unset($_SESSION["anreiseNachAbreise"]);
      unset($_SESSION["Vorname"]);
      unset($_SESSION["Nachname"]);
      unset($_SESSION["Rolle"]);
      unset($_SESSION["bereitsAccount"]);
      unset($_SESSION["emailVergleich"]);
      unset($_SESSION["selectedUser"]);
      unset($_SESSION["userBearbeiten"]);
    }

    // Navbar je nach Anmeldestatus einfügen
    if (isset($_SESSION["anmeldeStatus"]) && $_SESSION["anmeldeStatus"] == 1){
      include 'logging_status/navbar_loggedIn_admin.php';
    } else if(isset($_SESSION["anmeldeStatus"]) && $_SESSION["anmeldeStatus"] == 2){
      include 'logging_status/navbar_loggedIn.php';
    }  else {
      include 'logging_status/navbar_loggedOut.php';
    } 

    if($_GET['site'] == "homepage"){
      include 'homepage.php';
    }
  
    if($_GET['site'] == "help"){
      include 'footer/help.php';
    }

    if($_GET['site'] == "impressum"){
      include 'footer/impressum.php';
    }
  
    if($_GET['site'] == "anmelden"){
      if(!isset($_SESSION["anmeldeStatus"]) || $_SESSION["anmeldeStatus"] == 0){
        include 'anmelden_registrieren/anmelden.php';
      } else {
        echo "<p>Sie sind bereits angemeldet!</p>";
      }
    }
  
    if($_GET['site'] == "registrieren"){
      if(!isset($_SESSION["anmeldeStatus"]) || $_SESSION["anmeldeStatus"] == 0){
        include 'anmelden_registrieren/registrieren.php';
      } else {
        echo "<p>Sie sind bereits angemeldet!</p>";
      }
    }

    if($_GET['site'] == "profilAnzeigen"){
      if(!isset($_SESSION["anmeldeStatus"])){
        echo "<p>Sie sind nicht angemeldet!</p>";
      } else {
        include 'profil/profilAnzeigen.php';
      }
    }

    if($_GET['site'] == "profil"){
      if(!isset($_SESSION["anmeldeStatus"])){
        echo "<p>Sie sind nicht angemeldet!</p>";
      } else {
        include 'profil/profil.php';
      }
    }

    if($_GET['site'] == "neueReservierung"){
    if(!isset($_SESSION["anmeldeStatus"])){
      echo "<p>Melden Sie sich bitte an, um ein Zimmer zu buchen!</p>";
    } else {
      include 'db/neueBuchung.php';
    }
    }

    if($_GET['site'] == "gebucht"){
    if(!isset($_SESSION["anmeldeStatus"])){
      echo "<p>Melden Sie sich bitte an, um Ihre Buchungen einzusehen!</p>";
    } else {
      include 'db/listeBuchungen.php';
    }
    }

    if($_GET['site'] == "einzelneBuchung"){
      if(isset($_SESSION["anmeldeStatus"]) && $_SESSION["anmeldeStatus"] != 1){
        echo "<p>Nur Admins können einzelne Buchungen einsehen!</p>";
      } else {
        include 'db/einzelneBuchung.php';
      }
      }

    if($_GET['site'] == "CMS"){
      if(!isset($_SESSION["anmeldeStatus"]) || $_SESSION["anmeldeStatus"] != 1){
        echo "<p>Melden Sie sich bitte als Admin an, um auf das CMS zugreifen zu können!</p>";
      } else {
        include 'cms/cms.php';
      }
    }

    if($_GET['site'] == "cms"){
      if(!isset($_SESSION["anmeldeStatus"]) || $_SESSION["anmeldeStatus"] != 1){
        echo "<p>Melden Sie sich bitte als Admin an, um auf das CMS zugreifen zu können!</p>";
      } else {
        include 'cms/cms.php';
      }
    }

    if($_GET['site'] == "news"){
      include 'db/news.php';
    }

    if($_GET['site'] == "users"){
      include 'db/users.php';
    }
  ?>

    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="/DOCUMENT_ROOT/index.php?site=homepage" class="nav-link px-2 text-body-secondary">Home</a></li>
        <li class="nav-item"><a href="/DOCUMENT_ROOT/index.php?site=help" class="nav-link px-2 text-body-secondary">Help & FAQ</a></li>
        <li class="nav-item"><a href="/DOCUMENT_ROOT/index.php?site=impressum" class="nav-link px-2 text-body-secondary">Impressum</a></li>
      </ul>
      <p class="text-center text-body-secondary" id="footer-copyright">© 2023 Wohlfühloase, GmbH</p>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
