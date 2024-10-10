<?php
session_start(); // Start the session

// Include your database connection
include('db_connection.php');

$error = ''; // Initialize the error variable

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, set an error message
    $error = "Login and Book for Table!";
} 
else {
    // Handle form submission for table reservation if the user is logged in
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $date = $_POST['date'];
        $time = $_POST['time'];        
        $name = $_POST['name'];
        $no_of_guest = $_POST['no_of_guest'];
        $customerid = $_SESSION['username']; // Assuming username is used as customerid
        $status = 'pending'; // Set a default status

        // Retrieve the last reservation ID from the table
        $last_reservationid = "";
        $sql_last_id = "SELECT reservationid FROM table_reservation ORDER BY reservationid DESC LIMIT 1";
        $result = $conn->query($sql_last_id);
        if ($result->num_rows > 0) {
            // Fetch the last reservation ID
            $row = $result->fetch_assoc();
            $last_reservationid = $row['reservationid'];
        }

        // Generate the new reservation ID
        if ($last_reservationid) {
            // Extract the numeric part from the last reservationid and increment it
            $num = (int) substr($last_reservationid, 1); // Get numeric part, e.g., "01" -> 1
            $num++; // Increment the number
        } else {
            $num = 1; // Start with 1 if there is no existing reservation
        }

        // Format the new reservationid as "RXX" (e.g., R01, R02)
        $new_reservationid = 'R' . str_pad($num, 2, '0', STR_PAD_LEFT);

        // Prepare the SQL statement to insert the new reservation
        $sql = "INSERT INTO table_reservation (reservationid, date, time, name, no_of_guest, customerid, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssssiss", $new_reservationid, $date, $time, $name, $no_of_guest, $customerid, $status);

            // Execute the statement
            if ($stmt->execute()) {
                $error = "Table booked successfully with reservation ID: $new_reservationid";
            } 
            else {
                $error = "Table not booked. Try Again.";
            }  
            // Close the statement
            $stmt->close();
        } 
        else {
            $error = "Error preparing statement: " . $conn->error;
        }
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
    <title>Reserve Table</title>
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
      <h2>Book the Table</h2>

      <!-- Display error message if login fails -->
      <?php if (!empty($error)) { ?>
          <p style="color: red;"><?php echo $error; ?></p>
      <?php } ?>

      <?php if (empty($error)) { ?>
      <form method="post" action="">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date">

        <label for="time">Time:</label>
        <input type="time" id="time" name="time">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">

        <label for="no_of_guest">Number of Guests:</label>
        <input type="number" id="no_of_guest" name="no_of_guest" min="1" placeholder="Enter number of guests">

        <button type="submit">Book Now</button>
      </form>
      <?php } ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Restaurant. All rights reserved.</p>
        </div>
    </footer>    
</body>
</html>
