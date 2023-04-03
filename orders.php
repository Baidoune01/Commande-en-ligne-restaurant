<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <table>
        <tr>
            <th>Client</th>
            <th>Dish</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "restaurant";
        $status = "Pending";
        // Create connection
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT C.cname, D.dname, D.dtype FROM orders O inner join client C on O.cid = C.cid inner join dishes D on D.did = O.did where O.stat = :stat");
            $stmt->bindParam(':stat', $status);
            $stmt->execute();
            // Fetch results
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Process each row
                echo "<tr>
                <td>".$row['cname']."</td><td>".$row['dname']."</td><td>".$row['dtype']."</td><td>".$row['dtype']."</td>
                </tr>";
            }
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $conn = null;
    ?>
    </table>
</body>
</html>