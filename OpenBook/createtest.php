<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
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
				<li class="dropdown"><div class="glow-on-hover"><a href="index.html" style="color:#ffffff">Logout</a></div></li>
			</ul>
		</div>
		
		<div class="arrow-right"><a href="index.html"><div id="homeimg"></div></a></div>
	</header>
	
	<?php
		$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to server!");
		if(isset($_POST['createTestSubmit'])){
			session_start();
			$questionsetid = $_POST['testid'];
			$questionsettitle = $_POST['testtitle'];

			$entryqry = "Insert into questionset values('$questionsetid', '$questionsettitle')";
			mysqli_query($db, $entryqry) or die("Problem creating new Question Set!");
		

	
		}
			$qry = "SELECT DISTINCT title FROM question";
			$result = mysqli_query($db, $qry);
			$titles = array();
	
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
				//echo $row["title"];
					array_push($titles, $row["title"]);
				}
			}
		
		//mysqli_close($db);
	?>
	
	
	<div id="container">
	<!--/*************************************************************/-->
		<div id="createtest">
			<h1>Create a test:</h1>
		<div id = "titleselect">
			<form method="POST">
				<label for="titles">Choose from title:</label>
				<select name = "titles">
					<?php
						for($i = 0; $i < count($titles); $i++){
							echo "<option name=\"titleoption\" value='$titles[$i]'>".$titles[$i]."</option>";
						}

					?>
				</select>
				<input type="radio" name="questiontype" value="WA" checked="checked">Word Answer</radio>&nbsp;&nbsp;&nbsp;
				<input type="radio" name="questiontype" value="MC">Multiple Choice</radio>&nbsp;&nbsp;
				<button type="submit" name="search">Go-></button>
			</form>
			<div class="donetestwrapper">
				<a href="professor.php" class="btn-flip" data-back="Go Back" data-front="Done"></a>
			</div>
		</div>
		<div id="questionlist">
			<?php
				$output = NULL;
				if(isset($_POST['search'])){
					//$db = mysqli_connect('mars.cs.qc.cuny.edu', 'supr1424', '23371424', 'supr1424') or die("Cannot connect to server!");
					
					$selected = $_POST['titles'];
					$type = $_POST['questiontype'];
					
					$qidqry = "Select questionset_id from questionset order by questionset_id desc limit 1";
					$qidresult = mysqli_query($db, $qidqry);
					$qresult = mysqli_fetch_assoc($qidresult);
					
					if($qresult){
						$qsetid = $qresult['questionset_id'];
					}else{
						$qsetid = 1;
					}

					
				
					$qry1 = "SELECT * FROM question WHERE title LIKE '$selected%' AND question_type LIKE '$type' AND question_id NOT IN(
								SELECT question_id FROM questionset_question where questionset_id = '$qsetid')";
					$result1 = mysqli_query($db, $qry1);
					
					echo "<h2>Title:  $selected</h2>";
					$n = 0;
			?>
			
				<form method="POST" action="addtotest.php">
			
			<?php
					if($result1->num_rows > 0){
						while($row = $result1->fetch_assoc()){
							if($n%2 == 0){
								echo "<div class = \"evendisplay\">";
			?>
					
						<button type="submit" name="addtotest" class="addtotestbtn">Add</button>
						
			<?php
									echo "<input type=\"text\" name=\"qid\" value=\"".$row['question_id']."\" readonly style=\"display: none;\">";
									echo "<input type=\"text\" name=\"qsetid\" value=\"".$qsetid."\" readonly style=\"display: none;\">";
									echo substr($row['content'],0,70);
			?>			<div class="pointsdiv">
							<input type="number" name="points" min="1.0" step=".5" class="points" value="1.0">
							<label for="points"> Points</label>
						</div>
			<?php
								echo "</div>";
							}else{
								echo "<div class = \"odddisplay\">";
			?>
						<button type="submit" name="addtotest" class="addtotestbtn">Add</button>
			<?php					
									echo "<input type=\"text\" name=\"qid\" value=\"".$row['question_id']."\" readonly style=\"display: none;\">";
									echo "<input type=\"text\" name=\"qsetid\" value=\"".$qsetid."\" readonly style=\"display: none;\">";
									echo substr($row['content'],0,70);
			?>			<div class="pointsdiv">
							<input type="number" name="points" min="1.0" step=".5" class="points" value="1.0">
							<label for="points"> Points</label>
						</div>
			<?php
								echo "</div>";
							}
							$n++;
						}
					}else{
						echo("No result");
					}	
					
					mysqli_close($db);
				}
			?>
			</form>
		</div>
			
		</div>
	</div>
</body>
</html>
