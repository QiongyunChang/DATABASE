<?php 
    include('mysqlconnect.php');
    echo '<script>alert("DELETE ID="'+$_GET['FAId']+'")</script>';
    echo '<script>alert("DELETE")</script>';
    $get_id=$_GET['FAId'];

    mysqli_query($link,"DELETE FROM `association` WHERE `FAId` = '$get_id'");
    // mysql_query("DELETE FROM `association` WHERE `FAId` = '$get_id' ,$link")or die(mysql_error());
    header('location:insert.php');
?>