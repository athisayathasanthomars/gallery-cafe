<?php
// Start the session
session_start();

// Include your database connection
include('db_connection.php');

// Initialize the error message
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check the customer credentials
    $sql = "SELECT * FROM customer WHERE username = ? AND password = ?";

    // Prepare and execute the statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the credentials match
        if ($result->num_rows > 0) {
            // User found, set session variables and redirect
            $_SESSION['username'] = $username;

            // Redirect to the reservation page or any other desired page
            header("Location: reservation_table.php");
            exit();
        } else {
            // Invalid credentials, set an error message
            $error = "Invalid username or password!";
        }

        // Close the statement
        $stmt->close();
    } else {
        $error = "Error preparing statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
      <h2>Customer Login</h2>

      <!-- Display error message if login fails -->
      <?php if (!empty($error)) { ?>
          <p style="color: red;"><?php echo $error; ?></p>
      <?php } ?>

      <form method="post" action="">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required>

        <button type="submit">Login</button>
        <a href="customer_register.php"><p>Not Registered? Click Here!!</p></a>
       </form>
       </div><br><br><br><br><br><br><br>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
