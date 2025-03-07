<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'savings';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert data into the database using prepared statements
function insert_db($conn, $amount, $type) {
    $stmt = $conn->prepare("INSERT INTO amount (amount, peso_type) VALUES (?, ?)");
    $stmt->bind_param("is", $amount, $type); // "i" for integer, "s" for string

    if ($stmt->execute()) {
        echo "<script>console.log('New record created successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

function reset_amount($conn) {
    $conn->query("TRUNCATE TABLE amount");

    // check if the current amount is empty or not
}

// Query to retrieve all amounts from the database
$current_amount_query = "SELECT amount FROM amount";
$result = $conn->query($current_amount_query);

$amounts = []; // Initialize the array outside the loop

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $amounts[] = $row['amount']; // Add the amount to the array
    }

    $current_amount = number_format(array_sum($amounts), 2, '.', ','); // Calculate the sum of the amounts
} else {
    $current_amount = 0; // Default value when no results are found
}

// Check which button was pressed and insert the appropriate amount
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['1_peso'])) {
        insert_db($conn, 1, 'coin');
    } elseif (isset($_POST['5_peso'])) {
        insert_db($conn, 5, 'coin');
    } elseif (isset($_POST['10_peso'])) {
        insert_db($conn, 10, 'coin');
    } elseif (isset($_POST['20_peso'])) {
        insert_db($conn, 20, 'coin');
    } elseif (isset($_POST['20_bill'])) {
        insert_db($conn, 20, 'bill');
    } elseif (isset($_POST['50_bill'])) {
        insert_db($conn, 50, 'bill');
    } elseif (isset($_POST['100_bill'])) {
        insert_db($conn, 100, 'bill');
    } elseif (isset($_POST['200_bill'])) {
        insert_db($conn, 200, 'bill');
    } elseif (isset($_POST['500_bill'])) {
        insert_db($conn, 500, 'bill');
    } elseif (isset($_POST['1000_bill'])) {
        insert_db($conn, 1000, 'bill');
    } elseif (isset($_POST['reset-amount-btn'])) {
        reset_amount($conn);
    }

    // Refresh the page to update the displayed current amount
    echo "<script>window.location.href='';</script>";
    exit;
}

$conn->close(); // Close the database connection
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
            <h3>Current Amount: ₱<?php echo $current_amount; ?> PHP</h3>
        </div>

        <div class="container">
            <form action="" method="post">
                <button type="submit" name="1_peso" class="btn btn-primary">1 Peso Coin</button>
                <button type="submit" name="5_peso" class="btn btn-primary">5 Peso Coin</button>
                <button type="submit" name="10_peso" class="btn btn-primary">10 Peso Coin</button>
                <button type="submit" name="20_peso" class="btn btn-primary">20 Peso Coin</button>
            </form>
        </div>

        <div class="container mt-3">
            <form action="" method="post">
                <button type="submit" name="20_bill" class="btn btn-success">20 Peso Bill</button>
                <button type="submit" name="50_bill" class="btn btn-success">50 Peso Bill</button>
                <button type="submit" name="100_bill" class="btn btn-success">100 Peso Bill</button>
                <button type="submit" name="200_bill" class="btn btn-success">200 Peso Bill</button>
                <button type="submit" name="500_bill" class="btn btn-success">500 Peso Bill</button>
                <button type="submit" name="1000_bill" class="btn btn-success">1,000 Peso Bill</button>
            </form>
        </div>

        <div class="container mt-3">
            <form action="" method="post" onsubmit="return confirmDelete()">
                <button name="reset-amount-btn" class="btn btn-danger">Reset Amount</button>
            </form>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete all records? This action cannot be undone.");
        }
    </script>

    <script src="styles/js/bootstrap.bundle.min.js"></script>
</body>
</html>
