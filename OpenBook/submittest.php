<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TestSubmitted</title>
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
	<div id="container">
	<!--/*************************************************************/-->
	<?php
    $submittedAnswers = $_POST;
    include 'mysqlConnection.php';
    $questions = getQuestions($_GET['id']);


    $totalScore = array_sum(array_column($questions, 'points'));
    echo "<h4>Total Points {$totalScore}</h4>";

    $pointsEarned = 0;
    foreach ($questions as $question) {
        if ($submittedAnswers[$question['question_id']] === $question['answer']) {
            $pointsEarned+=$question['points'];
        }
    }

    // Insert and store the db in record
    echo "<h4>Points Earned {$pointsEarned}</h4>";
?>
	</div>

</body>
</html>
