<?php 
    session_start(); 
?>
<?php 
    if(isset($_GET['action']) && $_GET['action']=="add"){     
        $id=intval($_GET['id']); 
        if(isset($_SESSION['cart'][$id])){ 
            $_SESSION['cart'][$id]['quantity']++; 
        }else{ 
            $link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
            $query_s=mysqli_query($link, "SELECT * FROM our_production WHERE id={$id}"); 
            if(mysqli_num_rows($query_s)!=0){ 
                $row_s=mysqli_fetch_array($query_s);    
                $_SESSION['cart'][$row_s['id']]=array( 
                        "quantity" => 1, 
                        "price" => $row_s['price'] 
                    ); 
            }else{ 
                $message="Ошибка!"; 
            } 
        } 
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Сделать заказ</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php
			if (empty($_SESSION['session_username']))
			{ 
				echo "Вы вошли на сайт, как гость. Пожалуйста, авторизуйтесь<br>";
				die;
			}
			else
		?>
		<div id="container"> 
			<div id="main"> 
				<h1>Товары</h1>
				<?php 
					if(isset($message)){ 
						echo "<h2>$message</h2>"; 
					} 
				?> 
				<table> 
					<tr> 
						<th>Название</th> 
						<th>Описание</th> 
						<th>Цена</th> 
						<th>Действие</th> 
					</tr> 
					<?php 
						$link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysqli_error());
                        $result = mysqli_query($link, "SELECT * FROM our_production ORDER BY title ASC");                 
						while ($row = mysqli_fetch_array ($result) ) {
					?> 
					<tr> 
						<td><?php echo $row['title'] ?></td> 
						<td><?php echo $row['count'] ?></td> 
						<td><?php echo $row['price'] ?> ₽</td> 
						<td><a href="products.php?page=products&action=add&id=<?php echo $row['id'] ?>">Добавить в корзину</a></td> 
					</tr> 
					<?php 
						} 
					?>
					</table>
				</div>
				<div id="sidebar"> 
					<h1>Корзина</h1> 
					<?php 
						if(isset($_SESSION['cart'])){ 
						$sql="SELECT * FROM our_production WHERE id IN ("; 
						foreach($_SESSION['cart'] as $id => $value) { 
							$sql.=$id.","; 
						}
						$sql=substr($sql, 0, -1).") ORDER BY title ASC"; 
						$link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
						$query=mysqli_query($link, $sql);
						while($row=mysqli_fetch_array($query)){ 
					?>
					<p><?php echo $row['title'] ?> x <?php echo $_SESSION['cart'][$row['id']]['quantity'] ?></p> 
					<?php 
						} 
					?> 
					<hr/> 
                <a href="cart.php?page=cart">Перейти в корзину</a> 
                <br><br>
                <a href="intropage.php?page=cart">Вернуться назад</a> 
                <?php 
                    }else{ 
                        echo "<p>Ваша корзина пуста.</p>"; 
                    } 
                ?>
			</div>
		</div>
	</body>
</html>