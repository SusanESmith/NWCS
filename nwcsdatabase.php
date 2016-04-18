<?php



//db connection
	$dsn='mysql:host=45.55.134.169; dbname=NWCS';
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
