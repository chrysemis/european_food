<?php 

function all_recipes_array() {
	include("connection.php");

	try {
		$results = $db->query("SELECT recipe_id, title, category, imageUrl FROM recipes");	
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}

	$recipes = $results->fetchAll(PDO::FETCH_ASSOC);
	return $recipes;
}

function random_recipes_array() {
	include("connection.php");

	try {
		$results = $db->query(
			"SELECT recipe_id, title, category, imageUrl 
			FROM recipes
			ORDER BY RAND()
			LIMIT 3"
			);	
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}

	$recipes = $results->fetchAll(PDO::FETCH_ASSOC);
	return $recipes;
}

function single_recipe_array($id) {
	include("connection.php");

	try {
		$results = $db->prepare("SELECT title, category, imageUrl, description FROM recipes
		/*	JOIN recipes_ingredients ON recipes.recipe_id = recipes_ingredients.recipe_id */
			WHERE  recipe_id = ?");	
		// bindParam binds id to the ? mark above
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}

	$recipe = $results->fetch();

	if (empty($recipe)) return $recipe;

	try {
		$results = $db->prepare("SELECT ingredient FROM recipes_ingredients
		/*	JOIN recipes_ingredients ON recipes.recipe_id = recipes_ingredients.recipe_id */
			WHERE  recipe_id = ?");	
		// bindParam binds id to the ? mark above
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}
	while($row = $results->fetch(PDO::FETCH_ASSOC)) {
		$recipe["ingredients"][] = $row["ingredient"];
	};

	try {
		$results = $db->prepare("SELECT method_step FROM recipes_method
		/*	JOIN recipes_ingredients ON recipes.recipe_id = recipes_ingredients.recipe_id */
			WHERE  recipe_id = ?");	
		// bindParam binds id to the ? mark above
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}
	while($row = $results->fetch(PDO::FETCH_ASSOC)) {
		$recipe["method"][] = $row["method_step"];
	};

	return $recipe;
}

function get_recipe_html($recipe) {
	$item = "<div class='col-md-4'>
			<figure><a href='recipe.php?id=" . $recipe["recipe_id"] . "'>
			<img src='" 
				. $recipe["imageUrl"] 
				."' class='img-responsive' alt='" 
				. $recipe["title"] 
				."' />
			<figcaption>" . $recipe["title"] . "</figcaption>
			</a></figure>
			</div>";
 	return $item;
}

function array_category($recipes, $category) {
	 
	$output = array();
	foreach ($recipes as $id => $recipe) {
		if ($category == null OR strtolower($category) == strtolower($recipe["category"])) {
			$sort = $recipe["title"];
			// $sort = ltrim($sort, "The ");
			$output[$id] = $sort;
		}
	}

	asort($output);
	return array_keys($output);
}

function subitems_list($subitems) {
 	foreach ($subitems as $subitem) {
	 echo "<li>$subitem</li>";
	}
}