
<?php
/*/////////////////////////////////////////////////////////////////////////

git 계정을 통해 소스를 관리할것!!

////////////////////////////////////////////////////////////////////////*/

//database init
$conn = mysql_connect("localhost","twins10402","nocha1040");
if(!$conn) {
  echo "unable to connect DB" . mysql_error();
  exit;
}

if (!mysql_select_db("twins10402")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

//유저 입력 데이터 to database
$data_who = $_GET['who'];
$data_what = $_GET['what'];
$data_how_much = $_GET['how_much'];

mysql_query("INSERT INTO MainTable (who, what, how_much)
 VALUES ('".$data_who."','".$data_what."',".$data_how_much.")");

//data out
$sql = "SELECT * FROM  MainTable ORDER BY time desc";
 


$result = mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}
/* it makes problem because we print data also when have nothing
if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
*/

?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <?php// echo "<meta http-equiv='refresh' content='0; url=http://twins10402.dothome.co.kr'>"; //php 중복 입력 방지 ?>

    <meta charset="euc-kr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>on going</title>

    <!-- Toss CSS Framework CDN -->
    <link href="https://cdn.rawgit.com/tossapp/tossapp.github.io/master/framework-bt/assets/stylesheets/tossframe-latest.css" rel="stylesheet">    

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link href="assets/style.css" rel="stylesheet">
  
  </head>
  <body class="gray-200">
      <div class="wrapper"></div>

      <div class="summary container blue-500 gray-50-text">
        <div class="row nav">
          <div class="col-xs-12"><h5 class="bold">명승이 값아야 할 돈</h5></div>
        </div>

        <div class="row side">
          <div class="col-xs-7">
            
            <?php
            $after_calc = 0;
            while ($row = mysql_fetch_assoc($result)) {
              if($row['who']=='wook')
                $after_calc += $row['how_much'];
              else if($row['who']=='seong')
                $after_calc -= $row['how_much'];
              else
                echo 'wrong name';
            }

            $after_calc = intval($after_calc/2);
                        echo '<h1 class="number inline-block">'.$after_calc.'</h1><h4 class="inline-block">원</h4>';
            ?>
          </div>
          <div class="col-xs-5">
            <a class="btn btn-normal">토스로 보내기</a>
          </div>
        </div>
      </div>

      <section class="list gray-200">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <table class="table">
                <tr>
                  <th>소비자</th>
                  <th>금액</th>
                  <th>내역</th>
                </tr>
<?php

//data out

 $result = mysql_query($sql);

//echo $row['what'];
//echo $row['who'];
while ($row = mysql_fetch_assoc($result)) {
  echo '<tr>';
  

  if($row['who'] == 'wook')
     echo '<td><button class="btn btn-danger btn-mu">명욱</button></td>';
  else if($row['who'] == 'seong')
     echo '<td><button class="btn btn-primary btn-ms">명승</button></td>';
  else
     echo '<td><button class="btn btn-primary btn-ms">누구?</button></td>';


  echo  '<td>'.$row["how_much"].'원</td>';
  echo  '<td>'.$row["what"].'</td>';
  echo  '</tr>';
}
?>
              </table>
            </div>
          </div>
        </div>
        
      </section>

      
      <form class="form-group" method="get" action="index.php">
          <div class="toggle text-right">
            <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
          </div>

          <div class="btn-toggle-2" data-toggle="buttons">
                   
            <input type="radio" name="who" value="seong" id="option1" checked="">
            <label for="option1">명승</label>

            <input type="radio" name="who" value="wook" id="option2">
            <label for="option2">명욱</label>

          </div>

          <label class="gray-600-text">금액</label>
          <input type="number" class="form-control" name="how_much" id="inputPassword3" placeholder="얼마를 썼나요?">

          <label class="gray-600-text">내역</label>
          <input type="text" class="form-control" name="what" id="inputPassword3" placeholder="어디에 썼나요?">

          <input class="btn btn-pay" type="submit" value="입력" />

      </form>

    
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.toggle').click(function(){
          // $('.toggle span').toggleClass('');
          $('.form-group').toggleClass('close-form');
          $('.glyphicon-menu-down').toggleClass('glyphicon-menu-up');
        });
      });
    </script>

  </body>
</html>