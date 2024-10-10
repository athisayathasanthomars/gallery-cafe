<?php
include('db_connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to generate the next customer ID
function generateCustomerID($conn) {
    // Query to get the last customer ID
    $result = mysqli_query($conn, "SELECT customerid FROM customer ORDER BY customerid DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $lastID = $row['customerid'];

    if ($lastID) {
        // Extract the numeric part and increment it
        $numericPart = intval(substr($lastID, 1)) + 1;
        // Format it back with the 'C' prefix and two digits
        $newID = 'C' . str_pad($numericPart, 2, '0', STR_PAD_LEFT);
    } else {
        // If no records exist, start with C01
        $newID = 'C01';
    }

    return $newID;
}

// Handle register form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerid = generateCustomerID($conn);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert customer details into the database
    $sql = "INSERT INTO customer (customerid, name, email, phoneno, address, nicno, username, password) 
            VALUES ('$customerid', '$name', '$email', '$phoneno', '$address', '$nic', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful.Login using your username and password');</script>";
        echo "<script>window.location='customer.php';</script>";
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
    <title>Customer Register</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/book-table.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .booking-container {
            max-width: 600px;
            background-color: #f8f8f8;
            border-radius: 10px;
            padding-top: 31.5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .booking-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
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
    </style>
</head>
<body>
    <section>
    <div id="main">
      <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
           <li><a href="index.php">Home</a></li>
           <li><a href="about.html">About</a></li>
           <li><a href="facilities.html">Facilities</a></li>
           <li><a href="menu.php">Menus</a></li>
           <li><a href="reservation_table.php">Reserve Table</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           <li><a href="customer.php">Customer</a></li>
           <li><a href="staff.php">Staff</a></li>
           <li><a href="staff.php">Admin</a></li>
        </ul>
      </nav>
    </div>
    </section> 

    <div class="booking-container">
      <h2>Customer Login</h2>
      <form method="post" action="">
        <div class="form-row">
          <div class="form-group">
              <label for="name">Full Name:</label>
              <input type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" id="email" name="email" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="phoneno">Phone No:</label>
              <input type="text" id="phoneno" name="phoneno" required>
          </div>
          <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" id="address" name="address" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="nic">NIC:</label>
              <input type="text" id="nic" name="nic" required>
          </div>
          <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" id="username" name="username" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <label for="password">Password:</label>
              <input type="text" id="password" name="password" required>
          </div>
        </div>
        <button type="submit">Register</button>
        <div class="login-link">
            <p>To Login? <a href="customer.php">Click Here!!</a></p>
        </div>
       </form>
    </div>    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
