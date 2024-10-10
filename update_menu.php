<?php
include('db_connection.php');

// Fetch the menu details based on ID
$id = $_GET['id'];

if (!$id) {
    echo "<script> alert('ID not received. Unable to delete!!'); </script>";
} else {
    $result = mysqli_query($conn, "SELECT * FROM menu WHERE menuid='$id'");
    $row = mysqli_fetch_assoc($result);

    // Fetch details from the database
    $id = $row['menuid'];
    $name = $row['name'];
    $ingredients = $row['ingredients'];
    $category = $row['category'];
    $cousintype = $row['cousintype'];
    $price = $row['price'];
    $availability = $row['availability'];
    $image = base64_encode($row['image']); // Convert image binary data to base64
}

?>

<?php
// Update menu details
if (isset($_POST['update'])) {
    include('db_connection.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $ingredients = $_POST['ingredient'];
    $category = $_POST['category'];
    $cousintype = $_POST['cousintype'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];

    // Check if a new image is uploaded
    if ($_FILES['image']['name']) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']); // Get image binary data
        $image = mysqli_real_escape_string($conn, $imageData);
    }

    $update_query = "UPDATE menu SET 
        name='$name', 
        ingredients='$ingredients', 
        category='$category', 
        cousintype='$cousintype', 
        price='$price', 
        availability='$availability', 
        image='$image' 
        WHERE menuid='$id'";

    if ($conn->query($update_query)) {
        echo "<script> alert('Update successful.'); </script>";
        echo "<script>window.location='admin_menu.php';</script>";
    } else {
        echo "<script> alert('Update failed.'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .booking-container {
            max-width: 600px;
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            text-align: left;
        }

        .booking-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .form-group {
            flex: 0 0 48%;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"], 
        button.cancel-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }   
        button[type="submit"]:hover,
        button.cancel-btn:hover {
            background-color: #0056b3;
        }
        .cancel-btn{            
            text-decoration: none;
        }
        .staff-table-container {
            max-width: auto;
            margin: 10px auto;
            background-color: #f8f8f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .btn-update, .btn-delete {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }

        .btn-update {
            background-color: #28a745;
            border: none;
        }

        .btn-delete {
            background-color: #dc3545;
            border: none;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        img {
            display: block;
            margin-top: 10px;
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>   
    <div class="booking-container">
        <h2>Update Menu</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="id">Menu ID:</label>
                    <input value="<?php echo $id; ?>" type="text" id="id" name="id" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input value="<?php echo $name; ?>" type="text" id="name" name="name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="ingredient">Ingredients:</label>
                    <input value="<?php echo $ingredients; ?>" type="text" id="ingredient" name="ingredient" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input value="<?php echo $category; ?>" type="text" id="category" name="category" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cousintype">Cousin Type:</label>
                    <input value="<?php echo $cousintype; ?>" type="text" id="cousintype" name="cousintype" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input value="<?php echo $price; ?>" type="text" id="price" name="price" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="availability">Availability:</label>
                    <input value="<?php echo $availability; ?>" type="text" id="availability" name="availability" required>
                </div>
                <div class="form-group full-width">
                    <label for="image">Image:</label>
                    <input type="file" id="image" name="image">
                    <?php if($image): ?>
                        <img src="data:image/jpeg;base64,<?php echo $image; ?>" alt="Menu Image">
                        <?php endif; ?>
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <button name="update" type="submit">Update</button>
                </div>
                <div class="form-group full-width">
                    <button class="cancel-btn"><a href="admin_menu.php" style="text-decoration:none; color:white;">Cancel</a></button>
                </div>
            </div>
        </form>
    </div><br><br><br><br><br><br><br><br><br>    

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
