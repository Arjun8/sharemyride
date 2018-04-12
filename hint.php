<?php
    require_once ('common.php');

    $q=$_REQUEST["q"]; 
    $sql="SELECT `fname` FROM `Property` WHERE fname LIKE '%$q%'";
    $result = mysql_query($sql);

    $json=array();

    while($row = mysql_fetch_array($result)) {
      array_push($json, $row['fname']);
    }

    echo json_encode($json);
?>