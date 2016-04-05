
<!DOCTYPE html>
<html lang="en">
<!--Susan Smith Assignment 4 3/24/16-->
<head>
<title>NWCS Database Error</title>
<meta charset="utf-8">
<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<header><h1>NWCS Database Error</h1></header>

	<main>
		<!--database connection error-->
	   <h2>Database Error</h2>
     <p><?php echo "There was an error connecting to the database.<br><br>Error Message: ". $error; ?></p>
	</main>

	<footer>
		<p class="right">

			&copy; <?php echo date("Y"); ?> North Willow Convenience Stores
		</p>
	</footer>

</body>

</html>
