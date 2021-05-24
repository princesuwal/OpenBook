<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Question</title>
	<link rel="stylesheet" type="text/css" href = "cs/style.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
	
	
	<!-------------------------------------------------------------------------------->
	<script>
		function showTabs(evt, divid){
			var i, tabs, questions;
			tabs = document.getElementsByClassName("tabs");
			for(i = 0; i < tabs.length; i++){
				tabs[i].style.display = "none";
			}
			questions = document.getElementsByClassName("question-type");
			for(i = 0; i < questions.length; i++){
				questions[i].className = questions[i].className.replace(" active", "");
			}
			document.getElementById(divid).style.display = "block";
			evt.currentTarget.className += " active";
		}
		
		function checkChecked(){
			var radios = document.getElementsByClassName('Checked');
			for(var i = 0; i < radios.length; i++){
				if(radios[i].checked){
					return true;	
				}
			}
			document.getElementById('showalert').innerHTML = "Choose an answer!";
			return false;
		}
 
	</script>	
	<!--------------------------------------------------------------------------------->
	
	
	<div id="container">
		<h1>Create a question:</h1>
		
		
		<div class="topwrapper">
				<a href="professor.php" class="btn-flip" data-back="Exit" data-front="Cancel"></a>
		</div>
	<!--/*************************************************************/-->
		<div id="question-in">
			<div class = "buttonsline">
				<button class ="question-type" onClick="showTabs(event, 'multiplechoice')"><b>Multiple Choice</b></button>
				<button class ="question-type" onClick="showTabs(event, 'wordanswer')"><b>Word Answer</b></button>
			</div>
		</div>
		
		<div id = "multiplechoice" class = "tabs">
			<form id = "mcform" method = "POST" action="enterquestion.php">
				<div class="questiontitle">
					<label for="title"><b>Title:</b></label>
					<input type="text" name="title" class="tinputbox" required>
				</div>
				
				<label for="question"><b>Question:</b></label>
				<br>
				
				<input type="text" name="question" class="qinputbox" required>
				<br>
				
				<label for="choice1"><b>Choice 1:</b></label>
				<input type="text" name="choice1" class="inputbox" required>
				<input type="radio" name="checked" value="c1" class="Checked">
				<br>
				
				<label for="choice2"><b>Choice 2:</b></label>
				<input type="text" name="choice2" class="inputbox">
				<input type="radio" name="checked" value="c2" class="Checked">
				<br>
				
				<label for="choice3"><b>Choice 3:</b></label>
				<input type="text" name="choice3" class="inputbox">
				<input type="radio" name="checked" value="c3" class="Checked">
				<br>
				
				<label for="choice4"><b>Choice 4:</b></label>
				<input type="text" name="choice4" class="inputbox">
				<input type="radio" name="checked" value="c4" class="Checked">
				<br>
				
				<div class="wrapper">
					<div class="link_wrapper">
						<input type="submit" class="enterbutton" value="Enter" name="mcEnter" onClick="return checkChecked();">
						<span id="showalert" style="font-size: 18px; color: #00B3FF; font-weight: bold;"></span>
						<div class="icon">
					  		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
								<path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
					  		</svg>
						</div>
				  	</div>
				</div>
			</form>
		</div>
		
		<div id = "wordanswer" class = "tabs">
			<form id = "waform" method="POST" action="enterquestion.php">
				<div class="questiontitle">
					<label for="title"><b>Title:</b></label>
					<input type="text" name="title" class="tinputbox" required>
				</div>
				
				<label for="question"><b>Question:</b></label><br>
				<input type="text" name="question" class="qinputbox" required>
				<label for="choice1"><b>Answer:</b></label>
				<input type="text" name="answer" class="inputbox" required><br>
				<div class="wrapper">
					<div class="link_wrapper">
						<input type="submit" class="enterbutton" value="Enter" name="waEnter">
						<div class="icon">
					  		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 268.832 268.832">
								<path d="M265.17 125.577l-80-80c-4.88-4.88-12.796-4.88-17.677 0-4.882 4.882-4.882 12.796 0 17.678l58.66 58.66H12.5c-6.903 0-12.5 5.598-12.5 12.5 0 6.903 5.597 12.5 12.5 12.5h213.654l-58.66 58.662c-4.88 4.882-4.88 12.796 0 17.678 2.44 2.44 5.64 3.66 8.84 3.66s6.398-1.22 8.84-3.66l79.997-80c4.883-4.882 4.883-12.796 0-17.678z"/>
					  		</svg>
						</div>
				  	</div>
				</div>
			</form>
		</div>
	
<?php
	$db = mysqli_connect("mars.cs.qc.cuny.edu", "supr1424", "23371424", "supr1424") or die("Cannot connect to the server!!");
?>
		
	
	</div>
	
</body>
</html>
