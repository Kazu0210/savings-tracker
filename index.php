<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'savings';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insert_db($conn, $quantity, $type) {
    // Using prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO amount (peso_quantity, peso_type) VALUES (?, ?)");
    $stmt->bind_param("is", $quantity, $type); // "i" for integer, "s" for string

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_POST['1_peso'])) {
    $quantity = 1;
    $type = 'coin';
    insert_db($conn, $quantity, $type);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css/bootstrap.min.css">
    <title>Savings Tracker</title>
</head>
<body>
    <div class="container">
        <div class="container">
            <h1>Savings Tracker</h1>
        </div>

        <div class="container">
            <form action="" method="post">
                <button name="1_peso">1 Peso</button>
                <button>5 Peso</button>
                <button>10 Peso</button>
                <button>20 Peso</button>
            </form>
        </div>
        <div class="container">     
            <button>20 Peso Bill</button>
            <button>50 Peso Bill</button>
            <button>100 Peso Bill</button>
            <button>200 Peso Bill</button>
            <button>500 Peso Bill</button>
            <button>1,000 Peso Bill</button>
        </div>
    </div>
</body>
</html>