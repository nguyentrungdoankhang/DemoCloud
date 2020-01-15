<!DOCTYPE html>
<html>
<head>
	<title>Lamborghini</title>
	<link rel="stylesheet" type="text/css" href="homepage.css">
</head>
<body>
<div id="head">
	<div id="main-title">
		<h1>DAY DREAMER AUTO</h1>
		<h2>Luxury car for showing off</h2>
		<div id="dang-nhap">
			<a href="backend/index.php">Login (For admin)</a>
		</div>
	</div>
	<div id="menu">
		<div class="wrap">
			<ul>
				<li><a href="homepage.php">HomePage</a></li>
				<li><a href="#About">About Us</a></li>
				<li><a href="http://localhost/asm/backend/index.php">Login</a></li>
				<form>
					<div class="tk">
						<input class="tk" type="text" name="timkiem" required placeholder="input name here">
						<input class="ts" type="submit" name="search" value="Search">
					</div>
				</form>
			</ul>
		</div>
	</div>
	<div id="content" class="wrap">
		<div class="left">
			<div class="left-top">
				<h3>Category</h3>
			</div>
			<div class="left-bot">
				<a href="lamborghini.php">Lamborghini</a>
				<a href="#">Ferrarri</a>
				<a href="#">McLaren</a>
				<a href="#">Roll Royce</a>
			</div>
			<div id="map-box">
				<div id="map-title">
					<h4>Map to Auto</h4>
				</div>
				<div id="map-show">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.645097269903!2d105.91661991422481!3d21.08683249117077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a9d3939a69cb%3A0xc7093d91d3899ba2!2zNDQ2IEjDoCBIdXkgVOG6rXAsIFnDqm4gVmnDqm4sIEdpYSBMw6JtLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1556535251614!5m2!1svi!2s" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="right-top">
			<h3>Selling Car</h3>
			</div>
			<div class="right-bot">
					<?php include('backend/functions.php');
					$query="select * from Car where Category='1001'";
					$result = queryMysql($query);
					 while ($row = mysqli_fetch_array($result)) 
					 {  ?>
					 <ul style="list-style-type: none;">
					 	<li style="float:left;text-align: center;padding-left: 35px;padding-top: 20px;">
					 		<b style="color: blue;"><?=$row['Name'];?></b><br>
					 		<img style="height: 150px;width: 170px;" src="backend/images/car/<?=$row['Image']?>"><br>
					 		<?=$row['Type'];?><br>
					 		<?=$row['Description'];?><br>
					 		<b><?=$row['Price'];?><br></b>
					 		<a href="order.html">
					 		<input class="nut" type="submit" value="Order" style="text-align: center;background-color: black;color: white;width: 120px;height: 45px;margin-top: 10px;"></a>
					 	</li>
					 </ul>
					     <?php
					 } 
					 ?>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="wrap">
			<h3 id="#About"><a href="#">Day Dreamer Auto</a>
			. Address : 446 Ha Huy Tap Street, Yen Vien Town, Gia Lam, Ha Noi.<br> Phone number : 0392822322<br></h3>
			<h4>Copyright Notice 2006-2019 <a href="https://sontungauto.bonbanh.com">SonTungAuto</a></h4>
		</div>
	</div>
</body>
</html>