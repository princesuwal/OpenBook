<?php
	$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to server");

	$qid = $_POST['qid'];
	$qsetid = $_POST['qsetid'];
	$points = $_POST['points'];
	
	$qry = "insert into questionset_question values('$qsetid', '$qid', '$points')";
	mysqli_query($db, $qry) or die("Error occured while adding question to database!");

	mysqli_close($db);
	header('location: createtest.php');

	
?>