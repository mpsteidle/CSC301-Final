<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $_POST['name'];
	$region = $_POST['region'];
	$description = $_POST['description'];
	$difficulty = $_POST['difficulty'];
    
    if($name != null) {
        $sql = file_get_contents('sql/editFish.sql');
        $params = array(
            'name' => $name,
            'region' => $region,
			'description' => $description
        );
        $statement = $database->prepare($sql);
        $statement->execute($params);
		
		$sql = file_get_contents('sql/editFishDifficulty.sql');
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