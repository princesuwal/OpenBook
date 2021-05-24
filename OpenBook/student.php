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
		$id = $_GET['id'];
	
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
		
	<?php
		mysqli_close($db);
	?>
	</div>
	<div id="container">
	<!--/*************************************************************/-->
	<?php
        include 'mysqlConnection.php';
    ?>

    <h1>
        Available Tests
    </h1>

    <div>

        <?php


        $mysqli = getMysqlConnnection();
        // Perform query
        if ($result = $mysqli->query("SELECT * FROM questionset")) {
            $tests = $result->fetch_all(MYSQLI_ASSOC);

            echo '<ul>';

            foreach ($tests as $test) {
                echo <<<OUT
<li><a href="test.php?id={$test['questionset_id']}">{$test['title']}</a></li>
OUT;
            }
        }

        echo '</ul>';

        $mysqli->close();

        ?>
	</div>

</body>
</html>
