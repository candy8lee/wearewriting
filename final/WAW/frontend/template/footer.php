<div id="footer" class="container">
  <div class="row">
    <div id="footer_L" class="col-sm-6">
      <div class="row">
        <div class="col-sm-4 col-xs-6">
      	    <ul><h4>關於</h4>
      	      <li><a href="#">網站地圖</a></li>
              <li><a href="#">聯絡資訊</a></li>
              <li><a href="#">好站分享</a></li>
              <li><a href="#">活動紀錄</a></li>
              <li><a href="#">常見問題</a></li>
      	    </ul>
        </div>
        <?php
          $sth = $db->query("SELECT category FROM product_category");
          $category = $sth->fetchALL(PDO::FETCH_ASSOC);
         ?>
        <div class="col-sm-4 col-xs-6">
      	    <ul><h4>商品</h4>
            <?php foreach($category as $row){ ?>
      	      <li><a href="#"><?php echo $row['category']; ?></a></li>
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
      <div>
      	   <h4>聯絡資訊</h4>
           admin@wearewriting.com<br>
           0912345678<br>
           office hour: a.m.10:30 ~ p.m.5:30
      </div>
    </div>
  </div>
</div>
