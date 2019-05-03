SELECT fish.*, fish_difficulty.difficulty
FROM fish
INNER JOIN fish_difficulty
ON fish.name = fish_difficulty.name
WHERE fish.name = :name