
<?php
/*/////////////////////////////////////////////////////////////////////////

git ������ ���� �ҽ��� �����Ұ�!!

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

//���� �Է� ������ to database
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
    <?php// echo "<meta http-equiv='refresh' content='0; url=http://twins10402.dothome.co.kr'>"; //php �ߺ� �Է� ���� ?>

    <meta charset="EUC-KR">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- �� 3���� ��Ÿ �±״� *�ݵ��* head �±��� ó���� �;��մϴ�; � �ٸ� ���������� �ݵ�� �� �±׵� *������* �;� �մϴ� -->
    <title>��� ��� ����� ��� ������</title>

    <!-- ��Ʈ��Ʈ�� -->
    <link href="assets/bootstrap.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">

    <!-- IE8 ���� HTML5 ��ҿ� �̵�� ������ ���� HTML5 shim �� Respond.js -->
    <!-- WARNING: Respond.js �� ����� file:// �� ���� �������� �� ���� �������� �ʽ��ϴ�. -->
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
          <div class="col-xs-8"><h2>��Ȱ��.com</h2></div>
          <div class="col-xs-4">
            <button class="btn"><p>����Ϸ�</p></button>
          </div>
        </div>
        <div class="row side">
          <div class="col-xs-12">
            <div class="">
              <button class="btn btn-primary btn-ms">���</button>
              <span class="arrow">->>></span>
              <button class="btn btn-danger btn-mu">���</button>
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
                  <th>�Һ���</th>
                  <th>�ݾ�</th>
                  <th>����</th>
                </tr>
<?php

//data out

 $result = mysql_query($sql);

//echo $row['what'];
//echo $row['who'];
while ($row = mysql_fetch_assoc($result)) {
  echo '<tr>';
  

  if($row['who'] == 'wook')
     echo '<td><button class="btn btn-danger btn-mu">���</button></td>';
  else if($row['who'] == 'seong')
     echo '<td><button class="btn btn-primary btn-ms">���</button></td>';
  else
     echo '<td><button class="btn btn-primary btn-ms">����?</button></td>';


  echo  '<td>'.$row["how_much"].'��</td>';
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
        <input class="btn btn-tint" type="submit" value="�Է�" />
    </form>
    </div></div>

    
    <!-- jQuery (��Ʈ��Ʈ���� �ڹٽ�ũ��Ʈ �÷������� ���� �ʿ��մϴ�) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

  </body>
</html>