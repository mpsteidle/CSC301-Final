<?php
include('config.php');

$sql = file_get_contents('sql/findFish.sql');
$params = array(
	'name' => $_GET['search']
	);
$statement = $database->prepare($sql);
$statement->execute($params);

$fish = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Freshwater Fish</title>
	<link rel="stylesheet" href="dark.css">
	
</head>
<body>

<nav>
	<div style="float: right">
		<form action="search.php" method="GET">
			<input type="text" name="search" placeholder="Search..">
		</form>
	</div>
</nav>
	<a href="searchFish.php"><h1> Freshwater Fish Index </h1></a>
	<div>
		<h1><?php echo $fish[0]['name'] ?> </h1>
		<h2><?php echo $fish[0]['region'] ?> </h2>
		<p><?php echo $fish[0]['description'] ?> </p>
		<p>Care Difficulty: <?php echo $fish[0]['difficulty'] ?> </p>
	<div>
</body>
