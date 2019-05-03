<?php
include('config.php');

$sql = file_get_contents('sql/getRegions.sql');
$params = array();
$statement = $database->prepare($sql);
$statement->execute();

$regions = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Edit Fish</title>
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
		<h1>Edit Fish</h1>
		<form action="editFishAssistant.php" method="POST">
			<div>
				<label>Species Name:</label>
				<input type="text" value="<?php echo $_POST['name']?>" disabled="disabled"/>
				<input type="hidden" name="name" value="<?php echo $_POST['name']?>"/>
			</div>
			<div>
				<label>Location of Origin:</label>
				<select name="region">
					<?php if ($_POST['region']=="North America") : ?>
						<option selected="selected" value="North America">North America</option>
					<?php else : ?>
						<option value="North America">North America</option>
					<?php endif ?>
					
					<?php if ($_POST['region']=="South America") : ?>
						<option selected="selected" value="South America">South America</option>
					<?php else : ?>
						<option value="South America">South America</option>
					<?php endif ?>
					
					<?php if ($_POST['region']=="Central America") : ?>
						<option selected="selected" value="Central America">Central America</option>
					<?php else : ?>
						<option value="Central America">Central America</option>
					<?php endif ?>
					
					<?php if ($_POST['region']=="Africa") : ?>
						<option selected="selected" value="Africa">Africa</option>
					<?php else : ?>
						<option value="Africa">Africa</option>
					<?php endif ?>
					
					<?php if ($_POST['region']=="Asia") : ?>
						<option selected="selected" value="Asia">Asia</option>
					<?php else : ?>
						<option value="Asia">Asia</option>
					<?php endif ?>
				</select>
				<label>Difficulty of Care</label>
				<select name="difficulty">
					<?php if ($_POST['difficulty']=="Easy") : ?>
						<option selected="selected" value="Easy">Easy</option>
					<?php else : ?>
						<option value="Easy">Easy</option>
					<?php endif ?>
					
					<?php if ($_POST['difficulty']=="Intermediate") : ?>
						<option selected="selected" value="Intermediate">Intermediate</option>
					<?php else : ?>
						<option value="Intermediate">Intermediate</option>
					<?php endif ?>
					
					<?php if ($_POST['difficulty']=="Difficult") : ?>
						<option selected="selected" value="Difficult">Difficult</option>
					<?php else : ?>
						<option value="Difficult">Difficult</option>
					<?php endif ?>
				</select>
			</div>
			<div>
				<label>Description:</label>
				<textarea cols="60" rows="10" name="description" class="descriptionbox"><?php echo $_POST['description']?></textarea>
			</div>
			<div>
				<input type="submit"/>
				<input type="reset"/>
			</div>
		</form>
	</div>
</body>
</html>