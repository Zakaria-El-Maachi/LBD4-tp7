<?php
$servername = "localhost";
$username = "root";
$password = "";
if (isset($_POST["pseudo"])) {
    try {

        $conn = new PDO("mysql:host=$servername;dbname=users", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "select name from pseudo where name like :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $_POST["pseudo"]);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Already used";
        } else {
            echo "Pseudo available";
        }
    } catch (PDOException $e) {
        echo "Error in Connection" . $e->getMessage();
    }
}
