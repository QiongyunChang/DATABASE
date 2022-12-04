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
    /* div {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    } */
    
    </style>
<body>
    <ul>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a class="active" href="select.php">Search</a></li>
    <li><a href="insert.php">Insert/Delete/Update</a></li>
    <li><a  href="index.php">Advance</a></li>
    <li><a  href="index.php">About</a></li>
    </ul>
    <br>
    <br>
  <div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">
    <form action="#" method="post">
      <!--標籤、文字欄位-->
      <h4>依據需求條件查詢商品資訊</h4>
      <br> 
      <label for="function">Column</label>
        <textarea class="form-control" rows="1" id="column1" name="column"></textarea>
      <br>
      <label for="function">Operator</label>
      <textarea class="form-control" rows="1" id="operator1" name="operator"></textarea>
      <br>
      <label for="value">Value</label>
      <input type="value" id="value1">
      <br>
      <label for="function">SQL </label>
      <textarea class="form-control" rows="3" id="stext" name = "stext"></textarea>
      <br>
      <!--按鈕送出-->
      <button type="button" onclick="button_ql()" class="btn btn-success btn-lg btn-block">Button convert to SQL</button>
      <button type="submit" class="btn btn-info btn-lg btn-block" name = "submit" value="submit">Submit</button>
      
    </form>
  </div>
  <script>
    function button_ql(){
      const columnElement = document.getElementById("column1");
      const column = columnElement.value;
      const operatorElement = document.getElementById("operator1");
      const operator = operatorElement.value;
      const valueElement = document.getElementById("value1");
      const value = valueElement.value;
      if (column== ""){
        document.getElementById("stext").value = "SELECT * FROM product;";
      }else{
        document.getElementById("stext").value = "SELECT * FROM product WHERE "+column+" "+operator+"'"+ value+"'";
      }
    }

  </script>
<?php
   
    
         
  // require_once 'mysqlconnect.php';
  $host = 'localhost';
  $dbuser ='root';
  $dbpassword = '';
  $dbname = 'farmer_association';
  $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
  if (isset($_POST['submit'])){
    $sqll = $_POST['stext'];
    $result = mysqli_query($link,$sqll);
    $index = 1;
    echo '<div class="container", style=" border-radius: 5px;background-color: #f2f2f2; padding: 20px;">';
    echo'<table class="table">';
    echo'<thead>';
    echo'<tr>';
    echo'<th scope="col">#</th>';
    echo'<th scope="col">商品名稱</th>';
    echo'<th scope="col">商品數量</th>';
    echo'<th scope="col">檢驗機構代碼</th>';
    echo'<th scope="col">追朔號碼</th>';
    echo'<th scope="col">產銷履歷地點</th>';
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
              echo'<th scope="row">'.$index.'</th>';            
              echo'<td>'.$row['PName'].'</td>';
              echo'<td>'.$row['quantity'].'</td>';
              echo'<td>'.$row['AGId'].'</td>';
              echo'<td>'.$row['traceId'].'</td>';
              echo'<td>'.$row['traceLoc'].'</td>';
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