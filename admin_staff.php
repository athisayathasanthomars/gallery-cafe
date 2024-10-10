<?php
include('db_connection.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the last staff ID from the table
    $last_staffid = "";
    $sql_last_id = "SELECT staffid FROM staff ORDER BY staffid DESC LIMIT 1";
    $result = mysqli_query($conn, $sql_last_id);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the last staff ID
        $row = mysqli_fetch_assoc($result);
        $last_staffid = $row['staffid'];
    }

    // Generate the new staff ID
    if ($last_staffid) {
        // Extract the numeric part from the last staffid and increment it
        $num = (int) substr($last_staffid, 1); // Get the numeric part, e.g., "01" -> 1
        $num++; // Increment the number
    } else {
        $num = 1; // Start with 1 if there is no existing staff
    }

    // Format the new staffid as "SXX" (e.g., S01, S02)
    $new_staffid = 'S' . str_pad($num, 2, '0', STR_PAD_LEFT);

    // Insert staff details into the database with the new staffid
    $sql = "INSERT INTO staff (staffid, name, email, phoneno, address, nic, username, password) 
            VALUES ('$new_staffid', '$name', '$email', '$phoneno', '$address', '$nic', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New Staff Added..');</script>";
        echo "<script>window.location='admin_staff.php';</script>";
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
      <h2>Add Staff</h2>
      <form method="post" action="">
        <div class="form-row">
          <div class="form-group">
              <label for="id">Staff ID:</label>
              <input placeholder="P01" type="text" id="id" name="id" required>
          </div>
          <div class="form-group">
              <label for="name">Full Name:</label>
              <input placeholder="Kopi Thavasuntharam" type="text" id="name" name="name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="email">Email:</label>
              <input placeholder="kopi@gmail.com" type="text" id="email" name="email" required>
          </div>
          <div class="form-group">
              <label for="phoneno">Phone No:</label>
              <input placeholder="0761164638" type="text" id="phoneno" name="phoneno" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="address">Address:</label>
              <input placeholder="De Fonseka Place,Colombo 6" type="text" id="address" name="address" required>
          </div>
          <div class="form-group">
              <label for="nic">NIC:</label>
              <input placeholder="200134702209" type="text" id="nic" name="nic" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <label for="username">Username:</label>
              <input placeholder="kopi2001" type="text" id="username" name="username" required>
          </div>
          <div class="form-group full-width">
              <label for="password">Password:</label>
              <input placeholder="6 digit password" type="text" id="password" name="password" required>
          </div>
        </div>
        <button type="submit">Insert</button>
      </form>
    </div>

    <div class="staff-table-container">
        <h2>Staff List</h2>
        <table>
            <thead>
                <tr>
                    <th>StaffID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>NIC</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Update</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   // Include your database connection
                   include('db_connection.php');

                   // Fetch staff details
                   $sql = "SELECT * FROM staff";
                   $result = $conn->query($sql);

                   // Check if there are any records to display
                   if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>" . $row['staffid'] . "</td>";
                           echo "<td>" . $row['name'] . "</td>";
                           echo "<td>" . $row['email'] . "</td>";
                           echo "<td>" . $row['phoneno'] . "</td>";
                           echo "<td>" . $row['address'] . "</td>";
                           echo "<td>" . $row['nic'] . "</td>";
                           echo "<td>" . $row['username'] . "</td>";  
                           echo "<td>" . $row['password'] . "</td>";                 
                           echo "<td><a href='update_staff.php?id=" . $row['staffid'] . "'><button type='button' name='update' class='btn-update'>Update</button></a></td>";
                           echo "<td><a href='delete_staff.php?id=" . $row['staffid'] . "'><button type='button' name='delete' class='btn-delete'>Delete</button></a></td>";
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
