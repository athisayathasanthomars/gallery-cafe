<?php
//code to show the customer details
// Start the session
session_start();

// Include your database connection
include('db_connection.php');

// Initialize the error message
$error= "";

$id=$_GET['id']; 
  
  if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
  }
  else{
    $result=mysqli_query($conn,"SELECT * FROM table_reservation WHERE reservationid='$id'");
	$row=mysqli_fetch_assoc($result);
    $id=$row['reservationid'];
    $date=$row['date'];
    $time=$row['time'];
    $name=$row['name'];
    $guests=$row['no_of_guest'];
    $customerid=$row['customerid'];
    $status=$row['status'];
  }
?>

<?php
//code for update customer details
if(isset($_POST['update'])){
    if(empty($_POST['id']) || empty($_POST['date']) || empty($_POST['time']) || empty($_POST['name']) || empty($_POST['no_guests']) || empty($_POST['customerid']) || empty($_POST['status'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
        $id=$_POST['id'];
        $date=$_POST['date'];
        $time=$_POST['time'];
        $name=$_POST['name'];
        $no_guests=$_POST['no_guests'];
        $customerid=$_POST['customerid'];
        $status=$_POST['status'];
        $password=$_POST['password'];
      
        $update_query="UPDATE table_reservation SET date='$date',time='$time',name='$name',no_of_guest='$no_guests',customerid='$customerid',status='$status' WHERE reservationid='$id'";
        if($conn->query($update_query)){
           echo "<script> alert('Update successful.'); </script>";
           echo "<script>window.location='staff_home.php';</script>";
        }
        else{
           echo "<script> alert('Update fail.'); </script>";
        }      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Reservation</title>
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

        input[type="text"],input[type='date'] {
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
            curso r: pointer;
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
    </style>
</head>
<body>   
    
    <div class="booking-container">
      <h2>Update Reservation</h2>
      <form method="post" action="">
        <div class="form-row">
          <div class="form-group">
              <label for="id">Reservation ID:</label>
              <input value="<?php echo $id; ?>" type="text" id="id" name="id">
          </div>
          <div class="form-group">
              <label for="name">Date:</label>
              <input value="<?php echo $date; ?>" type="text" id="date" name="date">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="time">Time:</label>
              <input value="<?php echo $time; ?>" type="text" id="time" name="time">
          </div>
          <div class="form-group">
              <label for="name">Name:</label>
              <input value="<?php echo $name; ?>" type="text" id="name" name="name">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <label for="no_guests">No_Guests:</label>
              <input value="<?php echo $guests; ?>" type="text" id="no_guests" name="no_guests">
          </div>
          <div class="form-group">
              <label for="customerid">Customer ID:</label>
              <input value="<?php echo $customerid; ?>" type="text" id="customerid" name="customerid">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <label for="status">Status:</label>
              <input value="<?php echo $status; ?>" type="text" id="status" name="status">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group full-width">
              <button name="update" type="submit">Update</button>
          </div>
          <div class="form-group full-width">
              <button class="cancel-btn"><a href="staff_home.php" style="text-decoration:none; color:white;">Cancel</a></button>
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
