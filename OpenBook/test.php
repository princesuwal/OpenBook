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
				<li class="dropdown"><div class="glow-on-hover"><a href="logout.php" style="color:#ffffff">Logout</a></div></li>
			</ul>
		</div>
		
		<div class="arrow-right"><a href="index.html"><div id="homeimg"></div></a></div>
	</header>
	<div id="container">
	<!--/*************************************************************/-->
	<h1>Now Taking Test</h1>
		
		<?php
            include 'mysqlConnection.php';
            $testId = $_GET['id'];
            $questions = getQuestions($testId);
            echo <<<OUT
<ul>
<form action="submittest.php?id=$testId" method="post"
OUT;

            foreach ($questions as $question    ) {
                $category = $question['title'];
                $questionId = $question['question_id'];

                echo '<li>';
                if ($question['code'] === 'MC') {
                    preg_match('/.*?(?=<)/', $question['content'], $questionText);
                    preg_match_all('/(?<=<\d>).*?(?:(?!<).)*/', $question['content'], $answers);


                    $questionText = $questionText[0];
                    echo "<h5>Question: {$questionText} ($category)</h5>";
                    echo "<select name=\"{$questionId}\">";
                    $answers = $answers[0];
                    foreach ($answers as $answer) {
                        echo "<option value=\"$answer\">$answer</option>";
                    }
                    echo '</select>';
                } else {
                    $questionText = $question['content'];
                    echo <<<OUT
<h5>Question: {$questionText} ($category)</h5>
<input id="question-{$questionId}" name="{$questionId}" type="text" />
OUT;
                }
                echo '</li>';
            }
            echo <<<OUT
</ul>

<input type="submit">
</form>
OUT;
        ?>

	</div>

</body>
</html>
