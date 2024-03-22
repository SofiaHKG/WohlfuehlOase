<main id="hilfe-main">
    <form action="db/checkreservieren.php" method="post">
        <legend>Neue Buchung</legend>
        <div><label>80€ pro Zimmer pro Nacht</label></div>
        <?php 
            $alreadyPrintedAusgebuchtHeadline = 0;

            // Prepared Statement verwenden, um SQL-Injections zu vermeiden 
            require("dbaccess.php");
            $stmt = $db_obj->prepare("SELECT Anreise, Abreise FROM buchungen");
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Ausgebuchte Zeiträume anzeigen
            while ($row = $result->fetch_assoc()) { 
                if($alreadyPrintedAusgebuchtHeadline == 0){
                    echo '<div><label style="font-weight: 600;">Bereits ausgebuchte Zeiträume:</label></div>';
                    $alreadyPrintedAusgebuchtHeadline++;
                }
                echo '<div><label>'.$row['Anreise'].' bis '.$row['Abreise'].'</label></div>';
            }
            $stmt->close();
            
            // Anzeigen, wenn schon ausgebucht
            if(isset($_SESSION["schonAusgebucht"] ) && $_SESSION["schonAusgebucht"] == 1){
                echo "<label style='font-weight: 600;'>Unsere Zimmer sind zu diesem Zeitpunkt leider schon ausgebucht!</label></br>";
            }
            
            // Anzeigen, wenn Anreise vor Heute
            if(isset($_SESSION["anreiseVorHeute"]) && $_SESSION["anreiseVorHeute"] == 1){
                echo "<label style='font-weight: 600;'>Wählen Sie ein Anreisedatum in der Zukunft!</label></br>";
            }
            
            // Anzeigen, wenn Anreise nach Abreise
            if(isset($_SESSION["anreiseNachAbreise"]) && $_SESSION["anreiseNachAbreise"] == 1){
                echo "<label style='font-weight: 600;'>Sie müssen anreisen, bevor Sie abreisen können!</label></br>";
            }
        ?>
        <label for="anreise">Anreise:</label>
        <input type="date" name="anreise" required>
        <?php 
            // Anzeigen, wenn Abreise vor heute
            if(isset($_SESSION["abreiseVorHeute"]) && $_SESSION["abreiseVorHeute"] == 1){
                echo "<label style='font-weight: 600;'>Wählen Sie ein Abreisedatum in der Zukunft!</label></br>";
            }
        ?>
        <label for="abreise">Abreise:</label>
        <input type="date" name="abreise" required>
        <div>
            <label for="fruehstueck">Mit Frühstück: 15€ Aufpreis</label>
            <input type="checkbox" name="fruehstueck" class="checkbox" checked/>
        </div>
        <div>    
            <label for="parkplatz">Mit Parkplatz: 15€ Aufpreis</label>
            <input type="checkbox" name="parkplatz" class="checkbox"/>
        </div>
        <div>
            <label for="haustier">Mit Haustier: 15€ Aufpreis</label>
            <input type="checkbox" name="haustier" class="checkbox" />
        </div>
        <label for="infosHaustier">Mehr Informationen zum Haustier:</label>
        <input type="text" name="infosHaustier">
        <input type="submit">
    </form>
</main>