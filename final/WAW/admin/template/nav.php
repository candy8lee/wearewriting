<nav class="navbar navbar-expand-md bg-warning navbar-dark" style="margin-top:35px;">
  <div class="container">
    <a class="navbar-brand my-3" href="../news/list.php"><h2>We Are Writing</h2></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
      <ul class="navbar-nav">
        <li class="dropdown">
          <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">關於管理
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="../acts/list.php">活動管理</a></li>
            <li><a href="../Q_A_category/list.php">Q&A管理</a></li>
            <li><a href="../brand/list.php">品牌介紹管理</a></li>
            <li><a href="../industry/list.php">相關產業介紹管理</a></li>
            <li><a href="../makeawish/list.php">許願池管理</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../news/list.php">消息管理</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../product_category/list.php">產品管理</a>
        </li>
        <li class="dropdown">
          <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown" style="border: 0px;">訂單管理
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
                <li><a href="../customer_order/list.php?Status=0">待付款 / 新訂單</a></li>
                <li><a href="../customer_order/list.php?Status=1">已付款 / 出貨中</a></li>
                <li><a href="../customer_order/list.php?Status=2">已出貨 / 運送中</a></li>
                <li><a href="../customer_order/list.php?Status=3">已送達 / 訂單完成</a></li>
                <li><a href="../customer_order/list.php?Status=99">訂單取消</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../member/list.php">會員管理</a>
        </li>
      </ul>
      <a href="../template/logout.php" class="btn navbar-btn btn-warning ml-2 text-white"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign out</a>
    </div>
  </div>
</nav>
