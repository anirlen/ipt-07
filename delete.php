<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f23_anerdene";
$password = "my+sql=i494f23_anerdene";
$dbname = "i494f23_anerdene";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection is failed, $conn->connect_error");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodId = $_POST['food_id'];

    $deleteSql = "DELETE FROM food WHERE id = $foodId";
    $deleteResult = mysqli_query($conn, $deleteSql);

    if ($deleteResult) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
}
?>
