<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f23_anerdene";
$password = "my+sql=i494f23_anerdene";
$dbname = "i494f23_anerdene";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_attribute = "SELECT attributes.name FROM attributes";
$result_attribute = mysqli_query($conn, $sql_attribute);

if (!$result_attribute) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Abi di babi da bu</title>
</head>

<body>
    <section>
        <nav>
        <ul class="menuItems">
            <li><a href='home.php' data-item='Home'>Home</a></li>
            <li><a href='public.php' data-item='Public'>Public</a></li>
            <li><a href='private.html' data-item='Private'>Private</a></li>
            <li><a href='Signin.html' data-item='Sigin'>Sign In</a></li>
            <li><button id="discountButton">Check Discount</button></li>
        </ul>
        </nav>
    </section>
    <main>
        <div>
            <form action="action_page.php" method="POST">
                <label for="dish_name">Dish Name</label>
                <input type="text" id="dish_name" name="dish_name" placeholder="Dish name..">

                <label for="dish_description">Dish Description</label>
                <input type="text" id="dish_description" name="dish_description" placeholder="Dish description..">

                <label for="attributes">Attributes</label>
                <select id="attributes" name="attributes[]" multiple>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_attribute)) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>

                <label for="dish_price">Dish Price</label>
                <input type="number" id="dish_price" name="dish_price" placeholder="Dish price..">

                <input type="submit" value="Post">
            </form>
        </div>
    </main>
    <script src="js/site.js"></script>
</body>

</html>

<?php
mysqli_close($conn);
?>
