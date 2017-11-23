<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>品牌地圖</title>
    <?php require_once('template/header.php'); ?>
    <style>
      #side{
        width: 10%;
        float: left;
        margin: 0;
        padding: 0;
      }
      .Continent{
        width: 100%;
        margin-left: -75%;
        transition: 1s;
      }
      .Continent:hover{
        margin-left: -18%;
      }
      #center{
        width: 90%;
      }
    </style>
  </head>
  <script src="../asset/js/jquery.js"></script>
  <script type="text/javascript">
    $( function() {
      $('#Asia').click(function(){
  			var x = document.getElementById('Asia').src;
        document.getElementById("center").src = x;
  		});
      $('#Europe').click(function(){
    		var x = document.getElementById('Europe').src;
        document.getElementById("center").src = x;
    	});
      $('#Africa').click(function(){
      	var x = document.getElementById('Africa').src;
        document.getElementById("center").src = x;
      });
      $('#America_Australia').click(function(){
      	var x = document.getElementById('America_Australia').src;
        document.getElementById("center").src = x;
      });
  	});
  </script>
  <body>
    <ul id="side">
      <div class="Continent">
        <img id="Asia" src="../upload/Asia.svg" type="image/svg+xml" />
      </div>
      <div class="Continent">
        <img id="America_Australia" src="../upload/America_Australia.svg" type="image/svg+xml" />
      </div>
      <div class="Continent">
        <img id="Europe" src="../upload/Europe.svg" type="image/svg+xml" />
      </div>
      <div class="Continent">
        <img id="Africa" src="../upload/Africa.svg" type="image/svg+xml" />
      </div>
    </ul>
    <div>
      <embed id="center" src="../upload/Europe.svg" type="image/svg+xml" />
    </div>
    <div id="introduce">
    </div>
  </body>
</html>
