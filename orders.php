<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Заказы</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="container"> 
		<div id="main"> 
            <h1>Заказы</h1> 
            <table> 
                <tr> 
                    <th>ID</th> 
                    <th>Пользователь</th> 
                    <th>Товар</th>
                    <th>Цена</th> 
                </tr> 
                <?php   
                    $link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
                    $result = mysqli_query($link, 'SELECT * FROM orders ORDER BY user ASC'); 
                    while ($row = mysqli_fetch_array ($result) ) { 
                ?> 
                <tr> 
                    <td><?php echo $row['id'] ?></td> 
                    <td><?php echo $row['user'] ?></td> 
                    <td><?php echo $row['product'] ?></td> 
                    <td><?php echo $row['price'] ?> ₽</td> 
                </tr>
                <?php 
                    } 
                ?>
            </table>
            <br>
            <a href="intropage.php?page=products">Вернуться в личный кабинет</a> 
		</div>
    </div>
</body>
</html>