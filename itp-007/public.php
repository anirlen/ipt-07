<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f23_anerdene";
$password = "my+sql=i494f23_anerdene";
$dbname = "i494f23_anerdene";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection is failed, $conn->connect_error");
}


if (isset($_SESSION['id'])) {
    $Id = $_SESSION['id'];
} else {
    $Id = 0;
}

$sql_menu = "SELECT food.id, food.food_name, food.description, food.category, food.price
        FROM food
        ORDER BY food.id DESC";
$result_menu = mysqli_query($conn, $sql_menu);

$sql_location = "SELECT restaurant.name, restaurant.address, restaurant.city, restaurant.state, restaurant.zip_code, restaurant.phone
        FROM restaurant
        ORDER BY restaurant.id ASC
        LIMIT 1";
$result_location = mysqli_query($conn, $sql_location);

$sql_location_footer = "SELECT restaurant.name, restaurant.address, restaurant.city, restaurant.state, restaurant.zip_code, restaurant.phone
        FROM restaurant
        ORDER BY restaurant.id DESC
        LIMIT 1";
$result_location_footer = mysqli_query($conn, $sql_location_footer);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodId = $_POST['food_id'];
    $newfoodname = $_POST['newfoodname'];
    $newprice = $_POST['newprice'];
    $newcategory = $_POST['newcategory'];
    $newDescription = $_POST['newdescription'];

    $updateSql = "INSERT INTO food (id, food_name, description, category, price) 
                  VALUES ($foodId, '$newfoodname', '$newDescription', '$newcategory', '$newprice') 
                  ON DUPLICATE KEY UPDATE food_name = '$newfoodname', 
                                          description = '$newDescription', 
                                          category = '$newcategory', 
                                          price = '$newprice'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
            $food_name = $newfoodname;
            $price = $newprice;
            $category = $newcategory;
            $description = $newdescription;
        }
    } else {
        echo "" . mysqli_error($conn);
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
    <title>Restaurant Menu</title>
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

    <div class="location-header">
        <?php
        while ($row = mysqli_fetch_assoc($result_location)) {
            echo "<div class='menu-item'>";
            echo "<div>" . $row['name'] . "</div>";
            echo "<div>" . $row['address'] . "</div>";
            echo "<div>" . $row['city'] . "</div>";
            echo "<div>" . $row['state'] . "</div>";
            echo "<div>" . $row['zip_code'] . "</div>";
            echo "<div>" . $row['phone'] . "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="menu-grid">
    <?php
        while ($row = mysqli_fetch_assoc($result_menu)) {
            $foodId = $row['id'];

            echo "<div class='menu-item'>";
            echo "<div>" . $row['food_name'] . "</div>";
            echo "<div>" . $row['price'] . "</div>";
            echo "<div>" . $row['category'] . "</div>";
            echo "<div>" . $row['description'] . "</div>";

            echo "<button class='edit-form' data-foodid='$foodId' data-foodname='" . 
                htmlspecialchars($row['food_name']) . "' data-price='" . 
                htmlspecialchars($row['price']) . "' data-category='" . 
                htmlspecialchars($row['category']) . "' data-description='" . 
                htmlspecialchars($row['description']) . "'>Edit</button>";
            echo "</div>";

        
            echo "<button class='delete-form' data-foodid='$foodId'>Delete</button>";

        }
?>

    </div>


    <div class="location-footer">
        <?php
        while ($row = mysqli_fetch_assoc($result_location_footer)) {
            echo "<div class='location-footer'>";
            echo "Visit our second location to get one free coke!";
            echo "<div>" . $row['name'] . "</div>";
            echo "<div>" . $row['address'] . "</div>";
            echo "<div>" . $row['city'] . "</div>";
            echo "<div>" . $row['state'] . "</div>";
            echo "<div>" . $row['zip_code'] . "</div>";
            echo "<div>" . $row['phone'] . "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="popup-container">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="food_id" id="popup-food-id"> 
                <label for="newfood_name">Edit Food Name:</label><br>
                <input type="text" id="newfoodname" name="newfoodname"><br>
                <label for="newprice">Edit Price:</label><br>
                <input type="number" id="newprice" name="newprice"><br>
                <label for="newcategory">Edit Category:</label><br>
                <input type="text" id="newcategory" name="newcategory"><br>
                <label for="newdescription">Edit Description:</label><br>
                <input type="text" id="newdescription" name="newdescription"><br>
                <br>
                <button id="saveButton" type="submit">Save</button>
            </form>
        </div>
    </div>

    <script src="js/site.js"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-form');
    const deleteButtons= document.querySelectorAll('.delete-form')


    const popupContainer = document.querySelector('.popup-container');
    const closePopupButton = document.querySelector('.close-popup');
    const foodIdInput = document.getElementById('popup-food-id');
    const foodNameInput = document.getElementById('newfoodname');
    const priceInput = document.getElementById('newprice');
    const categoryInput = document.getElementById('newcategory'); 
    const descriptionInput = document.getElementById('newdescription');
    const saveButton = document.getElementById('saveButton'); 




    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const foodId = this.getAttribute('data-foodid');
            if (confirm("Do you want to delete this data?")) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert("Item deleted successfully.");
                        location.reload();
                    } else {
                        alert("Error deleting item.");
                    }
                };
                xhr.send('food_id=' + foodId);
            }
        });
    });


    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const foodId = this.getAttribute('data-foodid');
            const foodName = this.getAttribute('data-foodname');
            const price = this.getAttribute('data-price');
            const category = this.getAttribute('data-category');
            const description = this.getAttribute('data-description');

            foodIdInput.value = foodId;
            foodNameInput.value = foodName;
            priceInput.value = price;

            categoryInput.value = category;
            descriptionInput.value = description;

            popupContainer.style.display = 'block';
        });
    });

    closePopupButton.addEventListener('click', function() {
        popupContainer.style.display = 'none';
    });

    saveButton.addEventListener('click', function() {
        alert("Changes saved. Please reload the page to see the updates.");
    });
});



    </script>

</body>

</html>
