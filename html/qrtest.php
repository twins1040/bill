
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>Toss Web Framework</title>
    
    <!-- Toss 공용 CSS 문서의 맨 처음에 와야 합니다;-->
    <link href="https://toss.im/tossframe/assets/stylesheets/tossframe-latest.css" rel="stylesheet">

  </head>
  <body>
    <h1 class="text-center">Hello World!</h1>




    <!-- 내용을 작성하세요. -->
    


        
    <!-- Toss JS Framework CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://toss.im/tossframe/assets/javascripts/tossframe.js"></script>
    <script>

    $.ajax({
        url:"https://toss.im/saveTheChildren",
        type:'GET',
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
            payToken = data.payToken,
            url = "supertoss://pay?payToken=" + payToken,
            window.location.href = url,
            console.log("payToken: " + payToken),
            console.log(url)
        }
    });
</script>

  </body>
</html>