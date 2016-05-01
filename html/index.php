
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

    <meta charset="EUC-KR">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>명승 명욱 가계부 명욱 수정중</title>

    <!-- 부트스트랩 -->
    <link href="assets/bootstrap.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Toss CSS Framework CDN -->
    <link href="https://cdn.rawgit.com/kkCheon/tossframe/master/assets/stylesheets/tossframe.css" rel="stylesheet">
    <style>
      label { display: inline-block }
    </style>
  </head>
  <body>


      <div class="container">
        <div class="row nav">
          <div class="col-xs-8"><h2>생활비.com</h2></div>
          <div class="col-xs-4">
            <button class="btn"><p>정산완료</p></button>
          </div>
        </div>
        <div class="row side">
          <div class="col-xs-12">
            <div class="">
              <button class="btn btn-primary btn-ms">명승</button>
              <span class="arrow">->>></span>
              <button class="btn btn-danger btn-mu">명욱</button>
            </div>
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
            echo '<h1>'.$after_calc.'</h1>';
?>
          </div>
        </div>
      </div>

      <section class="list">
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
    <div class="container text-center"><div class="row">
    <form class="form" method="get" action="index.php">
       <!-- <label> <span>who</span> <input class="form-control" type="text" name="who" /></label>-->
        <label>wook<input class="form-control" type="radio" name="who" value="wook" /></label>
        <label>seong<input class="form-control" type="radio" name="who" value="seong" /></label>
        <label>what<input class="form-control" type="text" name="what" /></label>
        <label>how_much<input class="form-control" type="number" name="how_much" /></label>
        <input class="btn btn-tint" type="submit" value="입력" />
    </form>
    </div></div>

    
    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  </body>
</html>