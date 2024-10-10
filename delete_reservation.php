<?php

// Include your database connection
include('db_connection.php');

if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $reservationid=$_GET['id'];
    $del_query="DELETE FROM table_reservation WHERE reservationid='$reservationid'";
    $result=mysqli_query($conn,$del_query);
    if($result){
        echo "<script> alert('Reservation Deleted!!'); </script>";
    }
    else{
        echo "<script> alert('Unable to delete!!'); </script>";
    }    
}

?>
<script type="text/javascript">
    window.location="staff_home.php";
</script>