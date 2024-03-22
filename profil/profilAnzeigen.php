
<h2>Mein Profil</h2>

<p class="listen">Anrede: <?php echo $_SESSION["Anrede"]?></p>
<p class="listen">Vorname: <?php echo $_SESSION["Vorname"]?></p>
<p class="listen">Nachname: <?php echo $_SESSION["Nachname"]?></p>
<p class="listen">E-Mail: <?php echo $_SESSION["Email"]?></p>
<p class="listen">Username: <?php echo $_SESSION["usernameLoggedIn"]?></p>

<form action="index.php?site=profil" method="post">
    <input name="bearbeiten" value="ja" hidden>
    <button type= submit class="padding-form" >Profil bearbeiten</button>
</form>

<?php
    // checken, ob Profil bearbeiten angeklickt wurde 
    if(isset($_POST["bearbeiten"])){
        echo '
        <form action="index.php?site=profil" class="padding-form" method="post">
            <div>';
        if(isset($_SESSION["passwortCheckProfil"]) && $_SESSION["passwortCheckProfil"] == 0){
            echo "<div><label style='font-weight: 600;'>Falsches Passwort!</label></div>";
        }
        echo '<label for="passwortLoggedIn">Passwort:</label>
            <input 
            type="password"
            name="passwortLoggedIn"
            />
            <input name="bearbeiten" value="ja" hidden>
            </div>
            <input name="changeType" value="user" hidden>
            <button type="submit">Senden</button>
        </form>';
    }
?>

