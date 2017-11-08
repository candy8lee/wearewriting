<script>
  $( function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
      active: false,
	  collapsible: true
    });
  } );
</script>
<div id="contact" >
	<div class="container">
	  <div class="row">
		<form class="col-md-6" action="index.html" method="post" data-toggle="validator">
			<div class="row">
				<div class="col-md-2">
					<lable>稱呼：</lable>
				</div>
				<div class="col-md-10">
					<input type="text" name="name" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<lable>信箱：</lable>
				</div>
				<div class="col-md-10">
					<input type="email" name="email" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<lable>主旨：</lable>
				</div>
				<div class="col-md-10">
					<input type="text" name="title" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<lable>內容：</lable>
				</div>
				<div class="col-md-10">
					<div id="accordion">
					  <h3>點擊顯示編輯器 click▼</h3>
					  <div>
						<textarea id="tinymce" type="text" name="content" required></textarea>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="#" type="button" class="btn btn-warning btn-lg float-left">送出</a>
				</div>
			</div>
		</form>
		<div class="col-md-6">
			<h2 class="text-right">contact Us<h2>
			<p id="postscript" class="text-right">*若已有會員身分請<a href="login/login.php">登入</a>，在帳號專區裡也備有提問服務與紀錄。<p>
		</div>
	  </div>
	</div>
</div>
