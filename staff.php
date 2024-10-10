<?php
// Start the session
session_start();

// Include your database connection
include('db_connection.php');

//for error message
$error = "";

//check the form is submitted or not
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $usertype = $_POST['usertype'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($usertype == 'admin') {
      // Query to check the admin credentials
      $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    }
    else{
      // Query to check the staff credentials
      $sql = "SELECT * FROM staff WHERE username = ? AND password = ?";
    }
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      // Check if the credentials match
      if ($result->num_rows > 0) {
        // User found, set session variables and redirect
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = $usertype;
        
        if ($usertype == 'admin') {
            header("Location: admin_home.php");
        } else {
            header("Location: operationalstaff_home.php");
        }
        exit();
    }
    else {
        // Invalid credentials, set an error message
        $error = "Invalid username or password!";
    }
    } 
    else {
    $error = "Error preparing statement: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff/Admin Login</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/book-table.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
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
      <h2>Admin/Staff Login</h2>

      <!-- Display error message if login fails -->
      <?php if (!empty($error)) { ?>
          <p style="color: red;"><?php echo $error; ?></p>
      <?php } ?>

      <form method="post" action="">
                
        <label for="username">Usertype:</label>
        <select name="usertype" id="usertype" class="usertype-select" style="background-color: #f8f9fa; color: #343a40; 
               border-radius: 5px; padding: 8px 12px; font-family: Arial, sans-serif; 
               font-size: 14px; cursor: pointer;">
          <option value="admin">Admin</option>
          <option value="staff">Staff</option>  
        </select>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>

        <button type="submit">Login</button>
       </form>
       </div><br><br><br><br>
       <br><br>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
