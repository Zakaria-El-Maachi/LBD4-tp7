<?php
$servername = "localhost";
$username = "root";
$password = "";
if (isset($_GET["go"])) {
    try {

        $conn = new PDO("mysql:host=$servername;dbname=world", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_GET["go"] == '0') {
            $query = "select name from country";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            echo implode(',', $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
        } else {
            $query = "select * from country C inner join city S on C.capital = S.ID where C.Name = :name";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $_GET["country"]);
            $stmt->execute();
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)[0]);
        }
    } catch (PDOException $e) {
        echo "Error in Connection" . $e->getMessage();
    }
}
