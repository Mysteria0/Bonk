<!DOCTYPE html>
<html lang="fi">
    <head>
        <title>Hemagon.com</title>
        <script src="Calculatorlogic.js"></script>
    </head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, "test");
        class Main {
            public static function cleartournament($database) {
                $database->query("DROP TABLE IF EXISTS RedFighters");
                $database->query("CREATE TABLE RedFighters (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, fighter VARCHAR(30) NOT NULL)");
                $database->query("DROP TABLE IF EXISTS BlueFighters");
                $database->query("CREATE TABLE BlueFighters (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, fighter VARCHAR(30) NOT NULL)");
            }
        }
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $colour = $name = "";

        echo '
            <p>Red Fighter</p>
            <input type="Radio" id="1-1" name="Points-1" value="0" onclick="setredfighterpoints(0)">
            <label for="1-1">0 Points</label>
            <input type="Radio" id="2-1" name="Points-1" value="2" onclick="setredfighterpoints(2)">
            <label for="2-1">2 Points</label>
            <input type="Radio" id="3-1" name="Points-1" value="3" onclick="setredfighterpoints(3)">
            <label for="3-1">3 Points</label>
            <p>Blue Fighter</p>
            <input type="Radio" id="1-2" name="Points-2" value="0" onclick="setbluefighterpoints(0)">
            <label for="1-2">0 Points</label>
            <input type="Radio" id="1-2" name="Points-2" value="2" onclick="setbluefighterpoints(2)">
            <label for="2-2">2 Points</label>
            <input type="Radio" id="3-2" name="Points-2" value="3" onclick="setbluefighterpoints(3)">
            <label for="3-2">3 Points</label>
            <br><br>
            <input type="text" id="Pointdisplay" class="display" disabled>
            <button class="PointButton" onclick="calculatePoints()">Calculate</button>
            <br><br><br><br>
        ';
        //Main::clearDatabase($conn);
        if(isset($_POST['submitBtn'])){
            // Button is clicked
            // Perform necessary actions
            Main::cleartournament($conn);
        }
        echo '
            <form method="POST" action="Main.php">
            <button type="submit" name="submitBtn">Clear Tournament</button>
            </form>
            <br>
            <form method="POST" action="Main.php">
            Fighter: <select name="fighters" id="dropdownfighter" </select>>
            Colour: <input type="Radio" name="colour" value="Blue">Blue</input><input type="Radio" name="colour" value="Red">Red</input><br>
            <button type="submit" name="addbtn">Add To Tournament</button><br>
            <br>
            <input type="text" id="Name"">
            <button type="submit" name="addfig">Add Fighter</button>
            </form>
            <br>
        ';
        if(isset($_POST['addfig'])){
            // Button is clicked
            // Perform necessary actions
            $fighter = $_POST["addfig"];
            $conn->query("INSERT INTO AllFighters (fighter) VALUES ('$fighter')");
        }
        if(isset($_POST['addbtn']) && isset($_POST['colour']) && isset($_POST['fighters']) ){
            // Button is clicked
            // Perform necessary actions
            $colour = $_POST["colour"];
            $name = $_POST["fighters"];
            if($colour == "Red") {
                $conn->query("INSERT INTO RedFighters (fighter) VALUES ('$name')");
            } else {
                $conn->query("INSERT INTO BlueFighters (fighter) VALUES ('$name')");
            }
        }
        $Aresult = $conn->query("SELECT fighter FROM AllFighters ORDER BY id ASC");

        if($Aresult) {
            while($row = $Aresult->fetch_assoc()) {
                echo '<script type="text/javascript">
                    var x = "<?php echo"$row["fighter"]"?>";
                    addfighter(x);
                    </script>';
            }
        }
        $Rresult = $conn->query("SELECT id, fighter FROM RedFighters ORDER BY id ASC");
        $Bresult = $conn->query("SELECT id, fighter FROM BlueFighters ORDER BY id ASC");

        if($Rresult) {
            echo "Red Fighters <br>";
            while($row = $Rresult->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["fighter"]. " - Colour: Red". "<br>";
            }   
        }   
        if($Bresult) {
            echo "Blue Fighters <br>";
            while($row = $Bresult->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["fighter"]. " - Colour: Blue". "<br>";
            }   
        }    
    ?>
</body>
</html>