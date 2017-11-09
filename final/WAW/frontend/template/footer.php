<div id="footer" class="container">
  <div class="row">
    <div id="footer_L" class="col-sm-6">
      <div class="row">
        <div class="col-sm-4 col-xs-6">
      	    <ul><h4>關於</h4>
              <li><a href="about.php#map">網站地圖</a></li>
        			<li><a href="about.php#information">聯絡資訊</a></li>
        			<li><a href="about.php#link">好站分享</a></li>
              <li><a href="acts.php">活動紀錄</a></li>
              <li><a href="q_a.php">常見問題</a></li>
      	    </ul>
        </div>
        <?php
          $sth = $db->query("SELECT * FROM product_category");
          $category = $sth->fetchALL(PDO::FETCH_ASSOC);
         ?>
        <div class="col-sm-4 col-xs-6">
      	    <ul><h4>商品</h4>
              <li><a href="product_no_category.php">全部商品</a></li>
            <?php foreach($category as $row){ ?>
      	      <li><a href="product_category.php?cateID=<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></a></li>
            <?php } ?>
      	    </ul>
        </div>
        <div class="col-sm-4 col-xs-6">
            <ul><h4>品牌</h4>
              <li><a href="brand_introduction.php">詳細介紹</a></li>
              <li><a href="#">品牌地圖(PC only)</a></li>
              <li><a href="#">相關產業簡介</a></li>
            </ul>
        </div>
      </div>
    </div>
    <div id="footer_R" class="col-sm-6 col-xs-12">
	  <div class="row">
        <div class="col-sm-6 col-xs-12 col-xs-12">
      	   <h4>聯絡資訊</h4>
           admin@wearewriting.com<br>
           0912345678<br>
    		   320桃園市中壢區健行路229號<br>
    		   星期二至星期日<br>
    		   a.m.10:30 ~ p.m.5:30
        </div>
	    <iframe class="col-sm-6 col-xs-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3617.5549747165505!2d121.22692455076545!3d24.94722604783961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468224f87c71751%3A0x6c3205000735ed1d!2z5YGl6KGM56eR5oqA5aSn5a24!5e0!3m2!1szh-TW!2stw!4v1509977342981" width="50%" frameborder="0" style="border:0" allowfullscreen>
	    </iframe>
	 </div>
    </div>
  </div>
</div>
