<html>
<head>
<?php require_once('template/header.php'); ?>
<link rel="stylesheet" href="css/style.css">
<script>
$('.flip').hover(function(){
  $(this).find('.card').toggleClass('flipped');
});
</script>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<div id="map">
  <p>We Are Writing</p>
  <ul class="tree">
    <li>關於
      <ul>
        <li>網站地圖：正瀏覽的此頁面。</li>
        <li>聯絡資訊：店家的地址、電話、郵件信箱、營業時間。</li>
        <li>好站分享：國內外的優秀網站，鋼筆墨水賞析、紙質試寫、鋼筆繪畫，各種相關知識教學。</li>
        <li>活動紀錄：優惠活動或是大家共襄參與的非營利活動等等。</li>
        <li>Q & A：常見問題：購物流程、帳戶變更、訂單相關、個資法。</li>
      </ul>
    </li>
    <li>商品
    </li>
    <li>品牌
      <ul>
        <li>詳細介紹：品牌的歷史，大事件的紀錄介紹等等。</li>
        <li>品牌地圖(PC only)：互動式地圖，滑鼠游標移過去立即會反應，暫時只提供電腦版。</li>
        <li>相關產業簡介：與文具們相關的產業；諸如印刷、玻璃等等</li>
      </ul>
    </li>
  </ul>
</div>
<div id="information">
  <div class="row">
    <div class="col-sm-4">
      <h4>聯絡資訊</h4>
      <table>
        <tr>
          <td class="text-center" width="10%"><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
          <td>admin@wearewriting.com</td>
        </tr>
        <tr>
          <td class="text-center"><i class="fa fa-mobile" aria-hidden="true"></i></td>
          <td>0912345678</td>
        </tr>
        <tr>
          <td class="text-center"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
          <td>320桃園市中壢區健行路229號</td>
        </tr>
        <tr>
          <td class="text-center"><i class="fa fa-calendar" aria-hidden="true"></i></td>
          <td>星期二至星期日</td>
        </tr>
        <tr>
          <td class="text-center"><i class="fa fa-clock-o" aria-hidden="true"></i></td>
          <td>a.m.10:30 ~ p.m.5:30</td>
        </tr>
      </table>
    </div>
    <div class="col-sm-8">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14470.220491908085!2d121.229119!3d24.947221000000003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6c3205000735ed1d!2z5YGl6KGM56eR5oqA5aSn5a24!5e0!3m2!1szh-TW!2stw!4v1510135833288" width="60%" height="300" frameborder="0" style="border:0" allowfullscreen>
      </iframe>
    </div>
  </div>
</div>
<?php include_once("template/flipcards.php"); ?>
<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
