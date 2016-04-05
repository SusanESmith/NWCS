<?php
//Susan Smith
//CSCI 4000
//Assignment 4
//March 24, 2016
	require_once('nwcsdatabase.php');


//add inventory test
$queryAddInv='INSERT INTO addInvTest VALUES';
$statement1=$db->prepare($queryStudent);
$statement1->bindValue(':major_id',$major_id);
$statement1->execute();
$student=$statement1->fetchAll();
//$major_name=$student['majorName'];
$statement1->closeCursor();

$query2='SELECT majorName FROM major WHERE majorID=:major_id';
$statement2=$db->prepare($query2);
$statement2->bindValue(':major_id',$major_id);
$statement2->execute();
$majorName=$statement2->fetch();
//$major_name=$student['majorName'];
$statement2->closeCursor();

	//get all majors on the left
	$query='SELECT * FROM major ORDER BY majorName;';
	$statement=$db->prepare($query);
	$statement->execute();
	$major=$statement->fetchAll();
	$statement->closeCursor();

	//get students for select major
	/*$queryStudent = "SELECT * FROM student
				WHERE majorID = :major_id
							ORDER BY studentID";

	$statement3 = $db->prepare($queryStudent);
	//safer
	$statement3->bindValue(':major_id',$major_id);
	$statement3->execute();
	$students = $statement3->fetchAll();
	$statement3->closeCursor();*/


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Susan Smith's Kung Fu School</title>
<meta charset="utf-8">
<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
<header><h1>Susan Smith's Kung Fu School - Students</h1></header>

<main>
	<h1>Student List</h1>
	<aside>
			<h2>Majors</h2>
			<nav>
			<ul>
				<!--majors displayed-->
			<?php foreach ($major as $m):?>
				<li><a href="?major_id=
					<?php echo $m['majorID'];?>">
					<?php echo $m['majorName']."<br>" ?></a></li>
			<?php endforeach; ?>
			</ul>
		</nav>
	</aside>
	<section>
			<h2><?php echo $majorName['majorName']; ?></h2>

			<table cellpadding="0" style="width: 100%">
			   <tr>
				  <td><b>Student ID</b></td>
				  <td><b>First Name</b></td>
				  <td><b>Last Name</b></td>
					<td><b>Gender</b></td>
					<td></td>
			   </tr>
			   <?php
			   foreach ($student as $s)
				{
			   ?>
			   <tr>
					 <!--student data-->
				  <td><?php echo $s['studentID']; ?></td>
				  <td><?php echo $s['firstName']; ?></td>
				  <td><?php echo $s['lastName']; ?></td>
					<td><?php echo $s['gender']; ?></td>

					<td>
						<!--delete form link-->
							<form action="susan_smith_delete_student.php" method="post" id="delete_student_form">
									<input type="hidden" name="student_id" value="<?php echo $s['studentID']?>">
									<input type="submit" value="Delete">
							</form>
					</td>
				 </tr>
			   <?php
			   }
			   ?>
			</table>
			<p><a href="susan_smith_add_student_form.php">Add Student </a></p>
			<p><a href="susan_smith_major_list.php">List/Add Major </a></p>
	</section>
</main>

<footer><p>&copy; 2020 Susan Smith Kung Fu School</p></footer>
</body>

</html>
