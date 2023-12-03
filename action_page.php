<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f23_anerdene";
$password = "my+sql=i494f23_anerdene";
$dbname = "i494f23_anerdene";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$dish_name = clean($_POST['dish_name']);
$dish_price = clean($_POST['dish_price']);
$dish_description = clean($_POST['dish_description']);
$dish_attributes = clean($_POST['dish_attributes']);

function clean($input) {
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}
 
$pattern = "/^[A-Za-z\s]+$/";

if (!preg_match($pattern, $dish_name) || !preg_match($pattern, $dish_description)) {
    echo "Dish_name and dish_description contains invalid input";
} else {
    if ($conn->connect_error) {
        die("Connection is failed, $conn->connect_error");
    } else {
        $stmt = $conn->prepare("INSERT INTO food (food_name, description, category, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $dish_name, $dish_description, $dish_attributes, $dish_price);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Submission successful";
            echo "<button onclick=\"window.location.href = 'home.php';\">Go to Home page</button>";
            echo "<button onclick=\"window.location.href = 'public.php';\">Go to Public page</button>";
        } else {
        }

        $stmt->close();
    }
}
?>
