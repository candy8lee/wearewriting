<script>
  $(function(){
    $('#MenuIcon').click(function(){
     $('#nav').slideToggle();
     $('#MenuIcon').css("color", "transparent");
    });
  });
</script>
<div class="row">
  <div id="login" class="col-md-12">
    <nav>
		<ul class="nav nav-tabs pull-right">
		  <li class="dropdown">
		  <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">購物車<span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="order_confirm.php">快速結帳</a></li>
			<li><a href="my_cart.php">購物車清單</a></li>
			<li><a href="cart_clear_all.php">清空購物車</a></li>
		  </ul>
		  </li>

<?php if(isset($_SESSION['account'])){ ?>
      <li class="dropdown">
      <a class="dropdown-toggle" type="button" data-toggle="dropdown" href="#">會員專區<span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="member_edit.php">會員資料</a></li>
      <li><a href="member_question.php">客服提問</a></li>
      <li><a href="#">留言板</a></li>
      </ul>
      </li>
      <li><a href="order_list.php">訂單紀錄</a></li>
      <li><a href="template/logout.php"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>Sign out</a></li>
<?php } else{ ?>
			<li><a href="member_apply.php">申請會員</a></li>
			<li><a href="login.php"><i class="fa fa-sign-in fa-lg" aria-hidden="true"></i> Sign in</a></li>
<?php } ?>
    </nav>
  </div>
</div>
<div class="row my-5" style="background:#e7cda7;">
  <div class="col-md-4">
    <div class="text-center" style="height:120px;">
      <a href="index.php"><img id="logo" src="images/logo.png"</img></a>
    </div>
  </div>
  <div id="MenuIcon" class="text-left"><i class="fa fa-bars fa-3x" aria-hidden="true"></i></div>
  <div id="nav" class="col-md-8">
    <nav>
		<ul class="nav nav-tabs pull-right">
		  <li><a href="index.php" class="dn_header">首頁</a></li>
		  <li class="dropdown">
		  <a class="dropdown-toggle dn_header" type="button" data-toggle="dropdown" href="#">關於<span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="about.php#map">網站地圖</a></li>
			<li><a href="about.php#information">聯絡資訊</a></li>
			<li><a href="about.php#link">好站分享</a></li>
			<li class="divider"></li>
			<li><a href="acts.php">活動紀錄</a></li>
			<li><a href="q_a.php">Q & A</a></li>
		  </ul>
		  </li>
		  <li class="dropdown">
		  <a class="dropdown-toggle dn_header" type="button" data-toggle="dropdown" href="#">商品<span class="caret"></span></a>
		  <ul class="dropdown-menu">
      <?php
        $sth = $db->query("SELECT * FROM product_category");
        $category = $sth->fetchALL(PDO::FETCH_ASSOC);
        foreach($category as $row){ ?>
          <li><a href="product_category.php?cateID=<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></a></li>
        <?php } ?>
          <li><a href="product_no_category.php">全部商品</a></li>
		  </ul>
		  </li>
		  <li class="dropdown">
		  <a class="dropdown-toggle dn_header" type="button" data-toggle="dropdown" href="#">品牌<span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="brand_introduction.php">詳細介紹</a></li>
			<li><a href="#">品牌地圖</a></li>
			<li class="divider"></li>
			<li><a href="#">相關產業</a></li>
		  </ul>
		  </li>
		</ul>
    </nav>
  </div>
</div>
