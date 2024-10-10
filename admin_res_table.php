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

        input,select[type="text"] {
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
      <h2>Add Table</h2>
      <form method="post" action="">
        <div class="form-row">
          <div class="form-group">
              <label for="id">Table ID:</label>
              <input placeholder="T01" type="text" id="id" name="id" required>
          </div>
          <div class="form-group">
              <label for="customerid">CustomerID:</label>
              
              <?php  
               // Include your database connection
               include('db_connection.php'); 

               // Fetch all customer IDs from the customer table
               $customer_result = mysqli_query($conn, "SELECT customerid FROM customer");
              ?>

              <select name="customerid" id="customerid" class="usertype-select" style="background-color: #f8f9fa; color: #343a40; 
              border-radius: 5px; padding: 8px 12px; font-family: Arial, sans-serif; 
              font-size: 14px; cursor: pointer;">
              <?php  
              // Loop through the results and create an option for each customerid
              while($row = mysqli_fetch_assoc($customer_result)) {
                    echo "<option value='" . $row['customerid'] . "'>" . $row['customerid'] . "</option>";
              }
              ?>
               </select>

          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="no_seats">No of Seats:</label>
              <input placeholder="10/11/2..." type="text" id="no_seats" name="no_seats" required>
          </div>
        </div>
        <button type="submit">Insert</button>
      </form>
    </div>

    <div class="staff-table-container">
        <h2>Tables List</h2>
        <table>
            <thead>
                <tr>
                    <th>TableID</th>
                    <th>CustomerID</th>
                    <th>No_Seats</th>
                    <th>Update</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   // Include your database connection
                   include('db_connection.php');

                   // Fetch staff details
                   $sql = "SELECT * FROM res_table";
                   $result = $conn->query($sql);

                   // Check if there are any records to display
                   if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>" . $row['tableid'] . "</td>";
                           echo "<td>" . $row['customerid'] . "</td>";
                           echo "<td>" . $row['no_of_seats'] . "</td>";
                           echo "<td><a href='update_table.php?id=" . $row['tableid'] . "'><button type='button' name='update' class='btn-update'>Update</button></a></td>";
                           echo "<td><a href='delete_table.php?id=" . $row['tableid'] . "'><button type='button' name='delete' class='btn-delete'>Delete</button></a></td>";
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
