<html>
<head>
<?php require_once('template/header.php'); ?>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div class="container">
<a href="cart_clear_ALL.php" class="btn btn-warning" style="float:right;" onclick="if(!confirm('是否清空購物車？')){return false;};">清空購物車</a>
  <div class="row cart">
    <table class="text-center">
      <tr>
        <th width="15%">商品圖片</th>
        <th width="30%">品名</th>
				<th width="10%">單價</th>
        <th width="10%">數量</th>
        <th width="10%">小計</th>
        <th width="8%">更新</th>
        <th width="8%">刪除</th>
      </tr>
      <tr>
        <td>圖片</td>
        <td class="text-left">123</td>
        <td>120</td>
        <td>1</td>
        <td>123</td>
        <td><i class="fa fa-upload cart_edit_btn"></i></td>
        <td><i class="fa fa-times cart_delete_btn"></i></td>
      </tr>
      <tr>
			  <td colspan="7" >
					<a href="order_confirm.php" class="btn btn-warning btn-lg">我要結帳</a>
				</td>
			</tr>
    </table>
  </div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
