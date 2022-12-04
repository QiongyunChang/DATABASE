<?php
    $host = 'localhost';
    $dbuser ='root';
    $dbpassword = '';
    $dbname = 'farmer_association';
    $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
    if (!$link)
    {
	 die('Could not connect: ' . mysql_error());
	}
 ?>