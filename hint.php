<?php
   session_start();
   include('common.php');
   if(isset($_REQUEST["q"]))
   {
    $q=$_REQUEST["q"];
    $sql="SELECT distinct `from_address` FROM `off_ride` WHERE from_address LIKE '%$q%'";
    $result = mysqli_query($con,$sql);
    $json=array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
      array_push($json, $row['from_address']);
    }
    echo json_encode($json);
  }
?>