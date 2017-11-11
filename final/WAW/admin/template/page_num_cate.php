
  <?php if($page_num > 1){ ?>
  <li class="page-item">
    <a class="page-link" href="list.php?page=<?php echo $page_num-1; ?>&cateID=<?php echo $_GET['cateID']; ?>">«</a>
  </li>
  <?php }else{ ?>
  <li class="page-item">
    <a class="page-link" href="#">«</a>
  </li>
  <?php }//上一頁 ?>

  <?php for($i=1; $i<=$totalpages; $i++){ ?>
  <li class="page-item">
    <a class="page-link" href="list.php?page=<?php echo $i; ?>&cateID=<?php echo $_GET['cateID']; ?>"><?php echo $i; ?></a>
  </li>
  <?php }//頁數動態增加減少 ?>

  <?php if($page_num < $totalpages){ ?>
  <li class="page-item">
    <a class="page-link" href="list.php?page=<?php echo $page_num+1; ?>&cateID=<?php echo $_GET['cateID']; ?>">»</a>
  </li>
  <?php }else{ ?>
  <li class="page-item">
    <a class="page-link" href="#">»</a>
  </li>
  <?php }//下一頁 ?>
