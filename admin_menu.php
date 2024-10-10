<?php
include('db_connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menuid = $_POST['id']; // Get the menuid from the form
    $name = $_POST['name'];
    $ingredients = $_POST['ingredient'];
    $category = $_POST['category'];
    $cousintype = $_POST['cousintype'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];

    // Check if the file upload was successful
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    } else {
        $image = NULL; // Set image to null if upload failed
    }

    // Insert menu details into the database
    $sql = "INSERT INTO menu (menuid, name, ingredients, category, cousintype, price, availability, image) 
            VALUES ('$menuid', '$name', '$ingredients', '$category', '$cousintype', '$price', '$availability', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New Menu Added..');</script>";
        echo "<script>window.location='admin_menu.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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
        .td img {
        border-radius: 2px;
        width: 200px;
        height: 200px
    }
    </style>
</head>
<body>
    <section>
    <div id="main">
      <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
           <li><a href="admin_home.php">Customer</a></li>
           <li><a href="admin_menu.php">Menu</a></li>
           <li><a href="admin_res_table.php">Tables</a></li>
           <li><a href="admin_staff.php">Staff</a></li>
           <li><a href="admin_reservation.php">Reservation</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="">Logout</a></li>
        </ul>
      </nav>
    </div>
    </section> 
    
    <div class="booking-container">
      <h2>Add Menu</h2>
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
              <label for="id">Menu ID:</label>
              <input placeholder="M01" type="text" id="id" name="id" required>
          </div>
          <div class="form-group">
              <label for="name">Name:</label>
              <input placeholder="Shushi" type="text" id="name" name="name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="ingredient">Ingredients:</label>
              <input placeholder="Floor,Suger..." type="text" id="ingredient" name="ingredient" required>
          </div>
          <div class="form-group">
              <label for="category">Category:</label>
              <input placeholder="Breakfast/Lunch/Dinner" type="text" id="category" name="category" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="cousintype">Cousin Type:</label>
              <input placeholder="Indian/Chinese...." type="text" id="cousintype" name="cousintype" required>
          </div>
          <div class="form-group">
              <label for="price">Price:</label>
              <input placeholder="2300" type="text" id="price" name="price" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <label for="Availability">Availability:</label>
              <input placeholder="yes/no" type="text" id="availability" name="availability" required>
          </div>
          <div class="form-group full-width">
              <label for="image">Image:</label>
              <input placeholder="Select the image File.." type="file" id="image" name="image" required>
          </div>
        </div>
        <button type="submit">Insert</button>
      </form>
    </div>

    <div class="staff-table-container">
        <h2>Menu List</h2>
        <table>
            <thead>
                <tr>
                    <th>MenuID</th>
                    <th>Name</th>
                    <th>Ingredients</th>
                    <th>Category</th>
                    <th>Coursin Type</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Image</th>
                    <th>Update</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   // Include your database connection
                   include('db_connection.php');

                   // Fetch staff details
                   $sql = "SELECT * FROM menu";
                   $result = $conn->query($sql);

                   // Check if there are any records to display
                   if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>" . $row['menuid'] . "</td>";
                           echo "<td>" . $row['name'] . "</td>";
                           echo "<td>" . $row['ingredients'] . "</td>";
                           echo "<td>" . $row['category'] . "</td>";
                           echo "<td>" . $row['cousintype'] . "</td>";
                           echo "<td>" . $row['price'] . "</td>";
                           echo "<td>" . $row['availability'] . "</td>";  
                           echo '<td><img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Menu Image" width="200px" height="200px"></td>';                
                           echo "<td><a href='update_menu.php?id=" . $row['menuid'] . "'><button type='button' name='update' class='btn-update'>Update</button></a></td>";
                           echo "<td><a href='delete_menu.php?id=" . $row['menuid'] . "'><button type='button' name='delete' class='btn-delete'>Delete</button></a></td>";
                           echo "</tr>";
                        }
                    } 
                    else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
