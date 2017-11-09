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
	<div class="container" style="width:100%;">
	  <div class="row">
  		<div id="boards" class="col-md-5">最新內容
        <!--只顯示最新三則-->
  			<table class="table">
  			  <tr>
  			    <th width=20%>標題</th>
            <th>內文</th>
  			  </tr>
    			<tr>
    			  <td>標題</td>
            <td>內文</td>
    			</tr>
    			<tr>
    			  <td>標題</td>
            <td>內文</td>
    			</tr>
    			<tr>
    			  <td>標題</td>
            <td>內文</td>
    			</tr>
  			</table>
        <a href="boards_list.php" type="button" class="btn btn-warning btn-lg float-right">觀看全部</a>
  		</div>
      <form class="col-md-7" action="index.html" method="post" data-toggle="validator">
  			<div class="row">
  				<div class="col-md-2">
  					<lable>帳號：</lable>
  				</div>
  				<div class="col-md-10">
  					<input type="hidden" name="account" value="<?php?>" required>
            <lable><?php?></lable>
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
  					<a href="#" type="button" class="btn btn-warning btn-lg float-left">發表</a>
  				</div>
  			</div>
  		</form>
    </div>
	</div>
</div>
