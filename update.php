<!doctype html>
<html>
<head>
  <title>Product management</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    ul {
      list-style-type: none;
      margin: 0;
      /* padding: 0; */
      overflow: hidden;
      /* background-color:#4C7797; */
      padding: 14px 30px;
    }
    .ind {
      list-style-type: none;
      margin: 0;
      /* padding: 0; */
      overflow: hidden;
      background-color:#4C7797;
      padding: 14px 30px;
    }
    h3{
      float: left;
      padding: 14px 16px; 
      color: white; 
      font: size 15px;
    }
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }
    li {
      float: left;
    }
    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    li a:hover {
      background-color: #111;
    }
</style>
<body>
<ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a class="active" href="select.php">Search</a></li>
    <li><a href="insert.php">Insert/Delete/Update</a></li>
    <li><a  href="advance.php">Advance: Nested queries</a></li>
    <li><a  href="advance2.php">Advance: Aggregate functions </a></li>
    </ul>
    <br>
    <br>

    <?php 
      include('mysqlconnect.php');
      $get_id=$_GET['FAId'];
      $get_fname=$_GET['fname'];
      $get_faddr=$_GET['faddr'];
      $get_fphone=$_GET['fphone'];
    ?>
    <div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">
    <form action="#" method="post">
      <!--標籤、文字欄位-->
      <h4>修改農會資訊</h4>
      <br>    		
      <label for="function">農會代碼</label>
        <textarea class="form-control" rows="1" id="fid" ><?php echo $get_id?></textarea>
      <br>
      <label for="function">農會名稱</label>
      <textarea class="form-control" rows="1" id="fname" ><?php echo $get_fname?></textarea>
      <br>
      <label for="function">農會地址</label>
      <textarea class="form-control" rows="1" id="faddr" ><?php echo $get_faddr ?></textarea>
      <br>
      <label for="function">農會電話</label>
      <textarea class="form-control" rows="1" id="fphone" ><?php echo $get_fphone?></textarea>
      <br>
      <label for="function">SQL </label>
      <textarea class="form-control" rows="3" id="stext" name ="stext" ></textarea>
      <br>
      <!--按鈕送出-->
      <button type="button" onclick="button_ql()" class="btn btn-success btn-lg btn-block">Convert to SQL</button>
      <button type="submit" class="btn btn-info btn-lg btn-block" name = "submit" value="submit">Update</button>
    </form>
  </div>
  <script>
    function button_ql(){
      const fidElement = document.getElementById("fid");
      const fid = fidElement.value;
      const fnameElement = document.getElementById("fname");
      const fname = fnameElement.value;
      const faddrElement = document.getElementById("faddr");
      const faddr = faddrElement.value;
      const fphoneElement = document.getElementById("fphone");
      const fphone = fphoneElement.value;
      if (fid == ""){
        document.getElementById("stext").value = "SELECT * FROM association;";
      }else{
        document.getElementById("stext").value = "UPDATE `association` SET `FAName`='"+fname+"',`FAAddress`='"+faddr+"',`FAPhone`='"+fphone+"'"+" WHERE `FAId`= '"+fid+"';";
      }
    }
</script>
<?php 
    echo'<div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">';
    echo '<form action="#" method="post">';
    echo'<table class="table">';
    echo'<thead>';
    echo'<tr>';
    echo'<th scope="col">農會代碼</th>';
    echo'<th scope="col">農會名稱</th>';
    echo'<th scope="col">農會地址</th>';
    echo'<th scope="col">農會電話</th>';
    echo'</tr>';
    echo'</thead>';
    echo'<tbody>';
    if (isset($_POST['submit'])){
      $sqllup = $_POST['stext'];
      mysqli_query($link,$sqllup); // update 
      $sqllall = "SELECT * FROM association;";
      $result = mysqli_query($link,$sqllall); // show table 
      $index = 1;
      echo '<div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">';
      echo'<table class="table">';
      echo'<thead>';
      echo'<tr>';
      echo'<th scope="col">#</th>';
      echo'<th scope="col">農會代碼</th>';
      echo'<th scope="col">農會名稱</th>';
      echo'<th scope="col">農會地址</th>';
      echo'<th scope="col">農會電話</th>';
      echo'</tr>';
      echo'</thead>';
      echo'<tbody>';
      echo'<tr>';
        if (mysqli_num_rows($result)>0) {
              // 取得大於0代表有資料
              // while迴圈會根據資料數量，決定跑的次數
              // mysqli_fetch_assoc方法可取得一筆值
              while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $id = $row['FAId'];	
                $fname=$row['FAName'];
                $faddr= $row['FAAddress'];
                $fphone = $row['FAPhone'];
                echo'<th scope="row">'.$index.'</th>';            
                echo'<td>'.$row['FAId'].'</td>';
                echo'<td>'.$row['FAName'].'</td>';
                echo'<td>'.$row['FAAddress'].'</td>';
                echo'<td>'.$row['FAPhone'].'</td>';
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                echo'</tr>';
                $index = $index +1 ;
            }
            echo'</tbody>';
            echo'</table>';
            echo '<div>';
          // 釋放資料庫查到的記憶體
            mysqli_free_result($result);
          } 
    }
?>

</body>                                                                                                                            
</html>