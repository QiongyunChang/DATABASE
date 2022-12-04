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

<?php
  $host = 'localhost';
  $dbuser ='root';
  $dbpassword = '';
  $dbname = 'farmer_association';
  $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
  $sqll = "SELECT * FROM association;";
  $result = mysqli_query($link,$sqll);
?>
<ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a class="active" href="select.php">Search</a></li>
    <li><a href="insert.php">Insert/Delete/Update</a></li>
    <li><a  href="advance.php">Advance: Nested queries</a></li>
    <li><a  href="advance2.php">Advance: Aggregate functions </a></li>
    </ul>
    <br>
    <br>

    <div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">
    <form action="#" method="post">
      <!--標籤、文字欄位-->
      <h4>查詢農會販賣哪些農產品/哪些沒有</h4>
      <br>    		
      <label for="function">農會</label>
      <select class="form-select form-select-sm" aria-label=".form-select-sm example"id="faid">
      <?php
       $index = 1;
       echo "<option></option>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='".$row['FAId']."'>".$row['FAName']."</option>";
        }
      ?>
      </select>
      <br>  
      <label for="function">功能</label>  		 
      <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="funele">
      <option></option>
      <option>IN</option>
      <option>NOT IN</option>
      <option>EXISTS</option>
      <option>NOT EXISTS</option>
    </select>
   
    <br>
    <br>
    <label for="function">SQL </label>
      <textarea class="form-control" rows="3" id="stext" name ="stext" ></textarea>
      <br>
      <!--按鈕送出-->
      
    
      <!--按鈕送出-->
      <button type="button" onclick="button_ql()" class="btn btn-success btn-lg btn-block">Convert to SQL</button>
      <button type="submit" class="btn btn-info btn-lg btn-block" name = "submit" value="submit">Submit</button>
    </form>
  </div>
  <script>
    function button_ql(){
      const func = document.getElementById("funele").value;
      const fid = document.getElementById("faid").value;
      // in function 
      if (func == 'IN'){
          document.getElementById("stext").value = "SELECT * FROM product WHERE '"+fid+"' IN (SELECT `FAId` FROM association WHERE association.FAId =product.FAId);";
      } 
      if (func == 'NOT IN'){
        document.getElementById("stext").value = "SELECT * FROM product WHERE '"+fid+"' NOT IN (SELECT `FAId` FROM association WHERE association.FAId =product.FAId);";
      } 
      if (func == 'EXISTS'){
        document.getElementById("stext").value = "SELECT * FROM product WHERE EXISTS (SELECT * FROM association WHERE association.FAId =product.FAId and association.FAId ='"+fid+"');";
      }
      if (func == 'NOT EXISTS'){
        document.getElementById("stext").value = "SELECT * FROM product WHERE NOT EXISTS (SELECT * FROM association WHERE association.FAId =product.FAId and association.FAId ='"+fid+"');";
      }
    }
</script>
<?php 
    if (isset($_POST['submit'])){
      $sqllup = $_POST['stext'];
      $result2 = mysqli_query($link,$sqllup); // select
      $ind = 1;
      echo '<div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">';
      echo'<table class="table">';
      echo'<thead>';
      echo'<tr>';
      echo'<th scope="col">#</th>';
      echo'<th scope="col">商品名稱</th>';
      echo'<th scope="col">商品數量</th>';
      echo'<th scope="col">追朔號碼</th>';
      echo'<th scope="col">產銷履歷日期</th>';
      echo'<th scope="col">產銷履歷地點</th>';
      echo'</tr>';
      echo'</thead>';
      echo'<tbody>';
      echo'<tr>';
      if (mysqli_num_rows($result2)>0){
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result2)) {
              // 每跑一次迴圈就抓一筆值，最後放進data陣列中
              // $id = $row['FAId'];	
              // $fname=$row['FAName'];
              // $faddr= $row['FAAddress'];
              // $fphone = $row['FAPhone'];
              echo'<th scope="row">'.$ind.'</th>';            
              echo'<td>'.$row['PName'].'</td>';
              echo'<td>'.$row['quantity'].'</td>';
              echo'<td>'.$row['traceId'].'</td>';
              echo'<td>'.$row['trace_date'].'</td>';
              echo'<td>'.$row['traceLoc'].'</td>';
              // 每跑一次迴圈就抓一筆值，最後放進data陣列中
              echo'</tr>';
              $ind = $ind +1;
          }
          echo'</tbody>';
          echo'</table>';
          echo '<div>';
        // 釋放資料庫查到的記憶體
          mysqli_free_result($result2);
    } 
  }
?>

</body>                                                                                                                            
</html>