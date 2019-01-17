<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Корзина</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="container"> 
		<div id="main"> 
<?php 
    if(isset($_POST['submit'])){ 
		if (!empty($_POST['quantity'])) {
        foreach($_POST['quantity'] as $key => $val) { 
            if($val==0) { 
                $_SESSION['cart'][$key]['quantity'] = $val;
            }else{ 
                $_SESSION['cart'][$key]['quantity'] = $val; 
            }
        } 
    }}
?>
<?php 
    if(isset($_POST['clear'])){  
	if (!empty($_POST['quantity'])) {
        foreach($_POST['quantity'] as $key => $val) { 
            if($val!=0) { 
				unset($_SESSION['cart'][$key]); 
            }else{ 
				unset($_SESSION['cart'][$key]);
            }
        } 
    }}
?>

			<h1>Корзина</h1> 
			<form method="post" action="cart.php?page=cart"> 
				<table> 
          			<tr> 
            			<th>Название</th> 
            			<th>Количество</th> 
            			<th>Цена</th> 
            			<th>Сумма</th> 
        			</tr> 
        			<?php
           			 	$sql="SELECT * FROM our_production WHERE id IN ("; 
                    		foreach($_SESSION['cart'] as $id => $value) { 
                        		$sql.=$id.","; 
                    		} 
                    	$sql=substr($sql, 0, -1).") ORDER BY title ASC"; 
                    	$link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
                    	$query=mysqli_query($link, $sql); 
                    	$products = '';
                    	$totalprice=0; 
                    	while($row=mysqli_fetch_array($query)){ 
                    		$products = $products.' '.$row['title'];
                        	$subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
                       	 	$totalprice+=$subtotal; 
                    	?> 
                        <tr> 
                            <td><?php echo $row['title'] ?></td> 
                            <td><input  name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td> 
                            <td><?php echo $row['price'] ?>₽</td> 
                            <td><?php echo $_SESSION['cart'][$row['id']]['quantity']*$row['price'] ?>₽</td> 
                        </tr> 
                    <?php 
                    }
        ?>
                    <tr> 
                        <td colspan="4">К оплате: <?php echo $totalprice ?> ₽</td> 
                    </tr> 
        		</table> 
   				<br/> 
    			<button type="submit" name="submit">Обновить корзину</button> 
    			<?php 
    				if(isset($_POST['buy'])){ 
          				$link = mysqli_connect('localhost', 'root', '', 'bsbd1') or die(mysql_error());
    					$query = mysqli_query($link, '$sql'); 
    					$sql = mysqli_query($link, "INSERT INTO `orders` (`user`, `product`, `price`) 
                        VALUES ('".$_SESSION['session_username']."','".$products."','".$totalprice."')");
                        if ($sql) {
        					echo "Заказ оформлен!";
    					} else {
        					echo "Произошла ошибка.";
    					}
    				}
				?> 
    			<button type="submit" name="buy">Оформить заказ</button> 
				<button type="submit" name="clear">Очистить</button> 
    			<a href="products.php?page=products">Вернуться к заказу</a> 
			</form> 
			<br/> 
		</div>
    </div>
</body>
</html>