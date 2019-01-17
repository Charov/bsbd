<?php
	require_once 'connection.php';
	
	function mySession_start()
	{	
		if (isset($_COOKIE['SESSID'])) 
		{	

			global $con;
			$sess_id = $_COOKIE['SESSID'];
			$conn = mysqli_select_db($con, DB_NAME) or die("Cannot select DB");
			$acc=mysqli_query($con,"SELECT user_id FROM sessions WHERE session_id = :session_id");
		//	$stmt = $conn->prepare($sql);
		//	$stmt->execute([':session_id' => $session_id]);
		//	$acc = $stmt->fetch(PDO::FETCH_OBJ);

			if ($acc)
			{	

		//		$sess_update = 'UPDATE sessions SET session_date = :s_date, session_id = :s_id WHERE user_id = :user_id';
		//		$params_update = [ ':s_date' => date("Y-m-d H:i:s"), ':s_id' => $sess_id, ':user_id' => $acc->user_id];
		//		mysqli_query("UPDATE sessions SET ")
		//		$stmt = $db->prepare($sess_update);
		//		$stmt->execute($params_update);

				return true;
			}

			return false;

		}
	}

	function mySession_write($user_id)
	{
		$SESSID = uniqid();

		global $db;

		setcookie('SESSID', $SESSID, time()+60*60*24*30);
		$_COOKIE['SESSID'] = $SESSID;


		$sess_check = 'SELECT user_id FROM sessions WHERE user_id = :user_id';
		$stmt = $db->prepare($sess_check);
		$stmt->execute([':user_id' => $user_id]);
		$acc = $stmt->fetch(PDO::FETCH_OBJ);

		if ($acc)
		{
			$sess_update = 'UPDATE sessions SET session_date = :s_date, session_id = :s_id';
			$params_update = [ ':s_date' => date("Y-m-d H:i:s"), ':s_id' => $SESSID];
			$stmt = $db->prepare($sess_update);
			$stmt->execute($params_update);

			
			return;
		}

		$sql = 'INSERT INTO sessions(session_id, session_date, user_id) VALUES (:session_id, :session_date, :user_id)';
		$params = [ ':session_id' => $SESSID, ':session_date' => date("Y-m-d H:i:s"), ':user_id' => $user_id ];
		$stmt = $db->prepare($sql);
 		$stmt->execute($params);

	}

	function mySession_stop()
	{
		global $db;
		$SESSID = $_COOKIE['SESSID'];

		$sql = 'DELETE FROM sessions WHERE session_id = :sess_id';
		$stmt = $db->prepare($sql);
		$stmt->execute([':sess_id' => $SESSID]);

		setcookie('ACCID', '', time());
		setcookie('SESSID', '', time());
	}

?>