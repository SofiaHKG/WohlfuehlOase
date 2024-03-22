<main id="hilfe-main">
  <form action = "db/dbanmelden.php" method = "post">
    <fieldset>
      <legend>Anmelden</legend>
      <?php
        //Anzeigen, dass Passwort falsch ist, wenn falsches Passwort eingegeben wird. 
        if(isset($_SESSION["anmeldeStatus"]) && $_SESSION["anmeldeStatus"] == 0){
            echo "<label style='font-weight: 600;'>Falsches Passwort oder Username!</label>";
          }
      ?>
      <div>
        <label for="usernameLoggedIn">Username: </label> 
        <input
          type="text"
          name="usernameLoggedIn"
          placeholder="Username"
          required
        />
      </div>
      <div>
        <label for="passwortLoggedIn">Passwort: </label>
        <input
          type="password"
          name="passwortLoggedIn"
          placeholder="Passwort"
          required
        />
      </div>
      <button type="submit">Anmelden</button>
    </fieldset>
  </form>
</main>
   

