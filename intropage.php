<!DOCTYPE html>
<html>
<?php 
	session_start();
	if(!isset($_SESSION["session_username"])) {
		header("location:login.php");
	} else {
?>
<?php
	}
?>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Добро пожаловать!</title>
		<link rel="stylesheet" href="../css/style.css" >
		<script src="../js/call.js" language="javascript"></script> 
	</head>
	<body>
		<div class="cn">
			<div class="navigation">
				<div class="wrapper">
					<div class="logo-text">
						<MARQUEE><h1>Молочная ферма</h1></MARQUEE>
					</div>
					<span class="line"></span>
					<div class="menu">
						<div class="menu">
						<a href="../index.html">Главная</a>
						<a href="../index4.html">Сотрудники</a>
						<a href="../index5.html">О товаре</a>
						<a href="login.php">Личный кабинет</a>
					</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="wrapper">
 					<h4>Добро пожаловать!<br>Вы вошли на сайт, как<span> <?php echo $_SESSION['session_username'];?>!</span></h4>
					<h4><?php
					$namm=$_SESSION['session_username'];
					$link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
						$name1=mysqli_query($link,"select name from accounts where email='$namm'");
						$row=mysqli_fetch_assoc($name1);
						$name=$row['name'];
						$adr1=mysqli_query($link,"select address, name, phone, about, company from users where name='$name'");
						$adr2=mysqli_fetch_assoc($adr1);
						$adr3=$adr2['name'];
						$adr4=$adr2['about'];
						$adr5=$adr2['phone'];
						$adr6=$adr2['company'];
						$adr=$adr2['address'];?> 
					<link rel="stylesheet" href="css/style.css">
					<div id="container"> 
		<div id="main"> 
					<form method="post" action="cart.php?page=cart">
					<table> 
          			<tr> 
            			<th>Имя</th> 
            			<th>Телефон</th> 
            			<th>Адрес</th> 
            			<th>Компания</th> 
						<th>О вас</th> 
        			</tr> 
					<tr> 
							<td><?php echo $adr3 ?></td> 
                            <td><?php echo $adr5  ?></td>
							<td><?php echo $adr ?></td>
							<td><?php echo $adr6 ?></td>
							<td><?php echo $adr4 ?></td>
							
                        </tr>
						</table>
						</form>
						</div>
						</div>
					<?php
							echo "<br><a href='../php/products.php'>Сделать заказ</a>";
							echo "<br><a href='../php/cart.php'>Корзина</a>";
					?>
					<p><a href="logout.php"><br>Выйти</a></p>
				</div>
			</div>
			<div class="footer" style="position: absolute">
				<div class="wrapper">
					<ul class="head">
						<li><div class="inf">
							<b>Сайт выполнили:Чаров А.А., Вершинин С.А., Лаптев Р.С.</b>
							<b><br>ФИФТ БИ(с)-31</br></b>
						</div></li>
					</ul>
				</div>
			</div>
	</body>
</html>