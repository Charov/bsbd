<?php
		Session_start();
	?>
	<?php
	require_once '../includes/sessions.php';
	if (mySession_start())
	{
		header("location: intropage.php");
	}
?>
	<?php require_once("../includes/connection.php"); ?>
	<?php
		if(isset($_SESSION["session_username"])) {
			// вывод "Session is set"; // в целях проверки
			header("Location: intropage.php");
		}
		if(isset($_POST["login"])) {
			if(!empty($_POST['email']) && !empty($_POST['password'])) {
				$email=htmlspecialchars($_POST['email']);
				$password=md5(htmlspecialchars($_POST['password']));
				$query =mysqli_query($con, "SELECT * FROM accounts WHERE email='".$email."'");
				$numrows=mysqli_num_rows($query);
				if($numrows!=0)
 				{
					while($row=mysqli_fetch_assoc($query))
 					{
						$dbemail=$row['email'];
 	 					$dbpassword=$row['password'];
						$ct=date('Y-m-d H:i:s');
						$idu=$row['user_id'];
 					}
  					if($password == $dbpassword)
 					{
						// старое место расположения
						//  session_start();
						$a= mysqli_num_rows(mysqli_query($con,"select * from sessions where user_id='$idu'"));
						if($a==0){
						mysqli_query($con, "INSERT INTO sessions (user_id, session_date) values('$idu','$ct')");
	 					}else{
							mysqli_query($con, "UPDATE sessions set session_date='$ct' where user_id='$idu'");
						}
						//mysqli_query($con,"TRUNCATE TABLE sessions");
						//mySession_write($user->user_id);	 
 						/* Перенаправление браузера */
						$_SESSION['session_username']=$email;
   						header("Location: intropage.php");
						
					}
					else {
					//  $message = "Invalid email or password!";
					echo  "Неправильное имя пользователя или пароль!";
					}
				} else {
					//  $message = "Invalid email or password!";
					echo  "Неправильное имя пользователя или пароль!";
 				}
			} else {
    			echo  "Все поля обязательны для заполнения!";
			}
		}
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Авторизация</title>
		<link rel="shortcut icon" href="../images/favicon.jpg">
		<link rel="stylesheet" href="../css/style.css" >
		<link href="../css/style_lk.css" media="screen" rel="stylesheet">
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
					<div class="container mlogin">
						<div id="login">
							<h1>Вход</h1>
							<form action="" id="loginform" method="post" name="loginform">
								<p><label for="user_login">Email<br>
								<input class="input" id="email" name="email" size="20" type="text" value=""></label></p>
								<p><label for="user_pass">Пароль<br>
 								<input class="input" id="password" name="password" size="20" type="password" value=""></label></p> 
								<p class="submit"><input class="button" name="login" type= "submit" value="Авторизация"></p>
								<p class="regtext">Еще не зарегистрированы? <a href= "register.php">Регистрация</a>!</p>
   							</form>
			 			</div>
			 		</div>
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
		</div>
	</body>
</html>