<?php require_once("../includes/connection.php"); ?>
	<!-- Регистрация -->
<?php
	if(isset($_POST["register"])){
		if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['password'])) {
			$name=$_POST['name'];
			$address=$_POST['address'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$registration = date('Y-m-d H:i:s');
			
			$query=mysqli_query($con, "SELECT * FROM accounts WHERE email='".$email."'");
			$numrows=mysqli_num_rows($query);
	
			if($numrows==0)
			{
				$sql="INSERT INTO accounts
				(name, address, email,password, registration) 
				VALUES('$name','$address', '$email', '$password', '".$registration."')";

				$result=mysqli_query($con,$sql);

				if($result){
					echo  "Аккаунт создан!";
				} else {
	 				echo  "Не удалось создать аккаунт!";
				}

			} else {
	 			echo  "Это имя пользователя уже существует! Попробуйте другой.";
			}

		} else {
	 		echo  "Все поля обязательны для заполнения!";
		}
	}
?>

 
	<?php if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";} ?>
<!DOCTYPE html>
<html>	
	<head>
		<title>Регистрация</title>
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

					<div class="container mregister">
						<div id="login">
			 				<h1>Регистрация</h1>
							<form action="register.php" id="registerform" method="post" name="registerform">
 							<p><label for="user_login">Полное имя<br>
 							<input class="input" id="name" name="name" size="32"  type="text" value=""></label></p>
							<p><label for="user_address">Адрес<br>
 							<input class="input" id="address" name="address" size="32"  type="text" value=""></label></p>
							<p><label for="user_pass">E-mail<br>
							<input class="input" id="email" name="email" size="32" type="address" value=""></label></p>
							<p><label for="user_pass">Пароль<br>
							<input class="input" id="password" name="password" size="32"   type="password" value=""></label></p>
							<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
	  						<p class="regtext">Уже зарегистрированы? <a href= "login.php">Введите имя пользователя</a>!</p>
 						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>