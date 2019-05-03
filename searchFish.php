<?php
include('config.php');

$sql = file_get_contents('sql/getFish.sql');
$params = array();
$statement = $database->prepare($sql);
$statement->execute();

$fishs = $statement->fetchAll(PDO::FETCH_ASSOC);

$sql = file_get_contents('sql/getRegions.sql');
$params = array();
$statement = $database->prepare($sql);
$statement->execute();

$regions = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
    
    if($name != null) {
        $sql = file_get_contents('sql/deleteFish.sql');
        $param = array (
			'name' => $name
		);

		$statement = $database->prepare($sql);
        $statement->execute($param);
        
      header('location: searchFish.php');
      die();
    }
}
?>

<!DOCTYPE html>
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

	<div>
		<h1>Freshwater Fish Index</h1>
		<?php foreach ($regions as $region) : ?>
		<button class="collapsible"><?php echo $region['region'] ?></button>
		<div class="content">
				<!-- DISPLAY REGIONS -->
			<?php foreach($fishs as $fish) : ?>
					<!-- DISPLAY REGIONS FISH -->
				<?php if ($fish['region'] == $region['region']): ?>
				<button class="collapsible"><?php echo $fish['name'] ?></button>
					<div class="content">
							<!--DELETE BUTTON -->
						<span title="Delete">
						<form action="" method="POST" style="float:right">
							<input type="hidden" name="name" value="<?php echo $fish['name'] ?>">
							<input type="image" name='submit' src="delete.svg" class="deleteButton" alt='Delete' border="0">
							
						</form>
						</span>
							<!-- EDIT BUTTON -->
						<span title="Edit">	
						<form action="editFish.php" method="POST" style="float:right">
							<input type="hidden" name="name" value="<?php echo $fish['name'] ?>">
							<input type="hidden" name="region" value="<?php echo $fish['region'] ?>">
							<input type="hidden" name="description" value="<?php echo $fish['description'] ?>">
							<input type="hidden" name="difficulty" value="<?php echo $fish['difficulty'] ?>">
							<input type="image" name='submit' src="edit.svg" class="deleteButton" alt='Edit' border="0">
						</form>
						</span>
					<div style="">
							<!-- FISH DESCRIPTION -->
						<?php echo $fish['description'] ?>
						<br><br>Care Difficulty: <?php echo $fish['difficulty'] ?>
					</div>
					</div>
				<?php endif ?>
			<?php endforeach; ?>
		</div>
	    <?php endforeach; ?>

    
    <a href="addAFish.php?action=add">+ Add a Fish</a><br>
	</div>
	
	<script>
	var coll = document.getElementsByClassName("collapsible");
	var i;

for (i = 0; i < coll.length; i++) {
	coll[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var content = this.nextElementSibling;
		if (content.style.display === "block") {
			content.style.display = "none";
		} else {
			content.style.display = "block";
		}
	});
}
	</script>
</body>
</html>