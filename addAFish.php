<?php
include('config.php');

if(isset($_GET['action'])) {
    $action = $_GET['action'];
}
else {
   header('location: searchFish.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$region = $_POST['region'];
	$difficulty = $_POST['difficulty'];
	$description = $_POST['description'];
	
    
    if($action == 'add' && $name != null) {
        $sql = file_get_contents('sql/insertFish.sql');
        $params = array(
            'name' => $name,
            'region' => $region,
            'description' => $description
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
		
		 $sql = file_get_contents('sql/insertFishDifficulty.sql');
        $params = array(
            'name' => $name,
            'difficulty' => $difficulty
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
		
        header('location: searchFish.php');
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Add Fish</title>
	<link rel="stylesheet" href="dark.css">

</head>
<body>
<nav>
	<div style="float: right">
		<form action="search.php" method="GET">
			<input type="text" name="search" placeholder="Search.."/>
		</form>
	</div>
</nav>
	<a href="searchFish.php"><h1> Freshwater Fish Index </h1></a>
	<div>
		<h1>Add Fish</h1>
		<form action="" method="POST">
			<div>
				<label>Species Name:</label>
				<input type="text" name="name">
			</div>
			<div>
				<label>Location of Origin:</label>
				<select name="region">
					<option value="North America">North America</option>
					<option value="South America">South America</option>
					<option value="Central America">Central America</option>
					<option value="Africa">Africa</option>
					<option value="Asia">Asia</option>
				</select>
			</div>
			<div>
				<label>Difficulty of Care</label>
				<select name="difficulty">
					<option value="Easy">Easy</option>
					<option value="Intermediate">Intermediate</option>
					<option value="Difficult">Difficult</option>
				</select>
			</div>
			<div>
				<label>Description:</label>
				<textarea cols="60" rows="10" name="description" class="descriptionbox"></textarea>
			</div>
			<div>
				<input type="submit"/>&nbsp;
				<input type="reset"/>
			</div>
		</form>
	</div>
</body>
</html>