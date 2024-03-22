<main id="hilfe-main">
  <form action = "db/checkregistrieren.php" method = "post" class="registrierung-wrapping">
    <fieldset>
      <legend>Registrierung</legend>

      <?php
      //Anzeigen, dass Anrede vergessen wurde
        if(isset($_SESSION["anredeVergleich"]) && ($_SESSION["anredeVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Wählen Sie eine Anrede!</label>";
          }
      ?>

      <div>
        <label for="anrede">Anrede:</label>
        <select name="anrede" required>
          <option disabled selected>Bitte auswählen</option>
          <option value="Frau">Frau</option>
          <option value="Herr">Herr</option>
          <option value="Keine Anrede">Keine Anrede</option>
        </select>
      </div>

      <?php
      //Anzeigen, dass kein richtiger Vorname eingegeben wurde
        if(isset($_SESSION["vornameVergleich"]) && ($_SESSION["vornameVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Geben Sie einen Vornamen ohne Sonderzeichen ein!</label>";
          }
      ?>

      <div>
        <label for="vorname">Vorname:</label>
        <input
          type="text"
          name="vorname"
          <?php 
          // Vorname von vorherigen Submit anzeigen, wenn Registrieren gescheitert ist 
          if(isset($_SESSION["Vorname"])){
            echo 'value="'.$_SESSION["Vorname"].'"';
          } else {
          echo 'placeholder="Vorname"';
          }
          ?>
          required
        />
      </div>

      <?php
      //Anzeigen, dass kein richtiger Nachname eingegeben wurde
        if(isset($_SESSION["nachnameVergleich"]) && ($_SESSION["nachnameVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Geben Sie einen Nachnamen ohne Sonderzeichen ein!</label>";
          }
      ?>

      <div>
        <label for="nachname">Nachname:</label>
        <input
          type="text"
          name="nachname"
          <?php 
          // Nachname von vorherigen Submit anzeigen, wenn Registrieren gescheitert ist 
          if(isset($_SESSION["Nachname"])){
            echo 'value="'.$_SESSION["Nachname"].'"';
          } else {
          echo 'placeholder="Nachname"';
          }
          ?>
          required
        />
      </div>

      <?php
      //Anzeigen, dass keine richtige Email eingegeben wurde
        if(isset($_SESSION["emailVergleich"]) && ($_SESSION["emailVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Das ist keine gültige Email-Adresse!</label>";
          }
      ?>

      <div>
        <label for="email">E-Mail:</label>
        <input
          type="email"
          name="email"
          <?php 
          // Email von vorherigen Submit anzeigen, wenn Registrieren gescheitert ist 
          if(isset($_SESSION["Email"])){
            echo 'value="'.$_SESSION["Email"].'"';
          } else {
          echo 'placeholder="E-Mail"';
          }
          ?>
          required
        />
      </div>

      <?php
      //Anzeigen, dass es bereits einen Account mit dem Namen gibt
        if(isset($_SESSION["bereitsAccount"]) && $_SESSION["bereitsAccount"] == 1){
          echo "<label style='font-weight: 600;'>Dieser Username ist leider bereits vergeben!</label>";
        }
      ?>

      <div>
        <label for="username">Username:</label>
        <input
          type="text"
          name="username"
          <?php 
          // Username von vorherigen Submit anzeigen, wenn Registrieren gescheitert ist 
          if(isset($_SESSION["Username"])){
            echo 'value="'.$_SESSION["Username"].'"';
          } else {
          echo 'placeholder="Username"';
          }
          ?>
          required
        />
      </div>
      
      <?php
      // Anzeigen, dass Passwörter nicht übereinstimmen 
        if(isset($_SESSION["passwortVergleich"]) && ($_SESSION["passwortVergleich"] == 0)){
            echo "<label style='font-weight: 600;'>Passwörter stimmen nicht überein!</label>";
          }
      ?>

      <div>
        <label for="passwort1">Passwort:</label>
        <input
          type="password"
          name="passwort1"
          placeholder="Passwort"
          required
        />
      </div>
      <div>
        <label for="passwort2">Passwort wiederholen:</label>
        <input
          type="password"
          name="passwort2"
          placeholder="Passwort"
          required
        />
      </div>
      <div>
        <input type="checkbox" name="newsletter" value="Newsletter" checked class="checkbox"/>
        <label>Ich möchte mich zum Newsletter anmelden!</label>
      </div>
      <div>
        <input type="checkbox" name="AGB" value="AGB" class="checkbox" required/>
        <label>Ich habe
          <a href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fwww.wko.at%2Foe%2Fagb%2Fagb-hotellerie.docx&wdOrigin=BROWSELINK" target="_blank"> die AGB</a>
        gelesen!</label>
      </div>
      <button type="submit" class="submit-button">Senden</button>
    </fieldset>
  </form>
</main>
    
