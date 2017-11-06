<html>
<head>
<?php require_once('template/header.php'); ?>
<link rel="stylesheet" href="css/style.css">

<script>
  $(function(){
    $('#MenuIcon').click(function(){
     $('#nav nav').slideToggle();
    });
  });
</script>
</head>

<body>
<?php require_once('template/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 my-4" contenteditable="true">活動管理</h1>
          <a class="btn btn-warning my-2" href="add.php"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 新增一筆</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">活動管理</li>
          </ul>
          <table class="table">
            <thead>
              <tr>
                <th>活動開跑至結束日期</th>
                <th>標題</th>
                <th>編輯</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="pagination float-right">
            <?php include_once("template/page_num.php"); ?>
          </ul>
        </div>
      </div>
	   </div>
   </div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>

</html>
