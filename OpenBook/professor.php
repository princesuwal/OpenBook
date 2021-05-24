<?php
session_start();
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href = "cs/style.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
	<header>
		<div id="navbar">
			<ul>
				<li class="dropdown">
					<a href="#">Teachers <div class="down-arrow"></div></a>
					<div class="dropdown-content">
						<a href="https://ssologin.cuny.edu/cuny.html" target="_blank">Blackboard</a>
						<a href="https://cunyfirst.cuny.edu/" target="_blank">CUNYfirst</a>
					</div>
				
				</li>
				
				<li class="dropdown"><a href="#">Students <div class="down-arrow"></div></a>
					<div class="dropdown-content">
						<a href="https://ssologin.cuny.edu/cuny.html" target="_blank">Blackboard</a>
						<a href="https://www.w3schools.com/" target="_blank">W3Schools</a>
						<a href="https://learn.zybooks.com/" target="_blank">zyBooks</a>
					</div>
				</li>
				<li class="dropdown"><a href="about.html">About</a></li>
				<li class="dropdown"><div class="glow-on-hover"><a href="logout.php" style="color:#ffffff">Logout</a></div></li>
			</ul>
		</div>
		
		<div class="arrow-right"><a href="index.html"><div id="homeimg"></div></a></div>
	</header>
	<?php
		$id = $_SESSION['user_id'];
	
		$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to Server!");
		$qry = "SELECT * FROM appuser WHERE user_id = '$id'";
		$result = mysqli_query($db, $qry);
		
		if($result->num_rows > 0){
			$user = mysqli_fetch_assoc($result);
			$uname = $user['login'];
		}
	?>

	<div id="welcomediv" >
		Welcome,<?php echo($uname); ?>
	</div>
	<div id="container">
	<!--/*************************************************************/-->
			<div id="leftdiv">
				<?php
					$tests = "Select * from questionset";
					$testlist = mysqli_query($db, $tests); 
					
					if($testlist->num_rows > 0){
						echo "<table>";
						echo("<tr><td><b>Test no.</b></td><td><b>Title</b></td><td>No. Questions</td></tr>");
						$count = 1;
							while($test = mysqli_fetch_assoc($testlist)){
								$testid = $test['questionset_id'];
								$questionquery = "Select count(questionset_id) as questioncount from questionset_question where questionset_id = '$testid'";
								$questionresult = mysqli_query($db, $questionquery);
								if($questionresult->num_rows > 0){
									$no_ques = mysqli_fetch_assoc($questionresult);
									$no_question = $no_ques['questioncount'];
								}else{
									$no_question = 0;
								}
								echo("<tr><td>".$count."</td><td>".$test['title']."</td><td>".$no_question."</td></tr>");
								$count++;
							}
						echo "</table>";
					}
				else{
					echo "<table>";
						echo("<tr><td><b>Test no.</b></td><td><b>Title</b></td><td>No. Questions</td></tr>");
					echo "</table>";
				}
				?>
			</div>
			
			<div id="rightdiv">
				<?php
					$newtestid = "select questionset_id from questionset order by questionset_id desc limit 1";
					$testidresult = mysqli_query($db, $newtestid);
					if($testidresult->num_rows > 0){
						$newid = mysqli_fetch_assoc($testidresult);
						$nexttestid = $newid['questionset_id'];
						$nexttestid += 1;
					}else{
						$nexttestid = 1;
					}
				?>
				<h2 style="color: #000000;">Create new test: </h2>
				<form method="POST" action="createtest.php">
					<label for="testid">Test No.: </label>
					<input type="text" name="testid" value="<?php echo($nexttestid); ?>" readonly><br>
					<label for="testtitle">Test Title: </label>
					<input type="text" name="testtitle" required> <br>
					<input type="submit" name="createTestSubmit" value="Create test" class="createtestbtn">
				</form>
				
				<div id = "newQuestiondiv">
					<div class="newQuestionwrapper">
					<div class="link_wrapper">
						<form action="newquestion.php">
							<input type="submit" class="enterbutton" value="Add New Question" >
						</form>
						<span id="showalert" style="font-size: 18px; color: #00B3FF; font-weight: bold;"></span>
				  	</div>
				</div>
				</div>
			</div>
	</div>
	<?php
	mysqli_close($db);
	?>

</body>
</html>
