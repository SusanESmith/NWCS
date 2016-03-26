<?php



//db connection
	$dsn='mysql:host=localhost; dbname=bruno';
	$username='root';
	$password='yEKmgRWvpP';


//PDO object
	try{
		$db=new PDO($dsn, $username, $password);
			//echo "Success";
	}catch(PDOException $e){
		$error=$e->getMessage();
		include('nwcsdberror.php');
		exit();
	}
 ?>
