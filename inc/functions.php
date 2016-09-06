<?php 
function get_recipes_count($category = null, $search = null) {
	$category = strtolower($category);
	include("connection.php");

	try {
		$sql = "SELECT COUNT(recipe_id) FROM recipes";
		if (!empty($search)) {
			$result = $db->prepare(
				$sql
				. " WHERE title LIKE ?"
				);
				$result->bindValue(1, '%'.$search.'%', PDO::PARAM_STR);	
		} else if (!empty($category)) {
			$result = $db->prepare(
			$sql 
			. " WHERE LOWER(category) = ?"
			);
			$result->bindParam(1, $category, PDO::PARAM_STR);
		} else {
			$result = $db->prepare($sql);
		}
		$result->execute();
	} catch (Exception $e) {
		echo "Bad query.";
	}

	$count = $result->fetchColumn(0);
	return $count;
}

function all_recipes_array($limit = null, $offset = 0) {
	include("connection.php");
 
 	try {
		$sql = "SELECT recipe_id, title, category, imageUrl 
				FROM recipes
				ORDER BY title";
		if (is_integer($limit)) {
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindParam(1, $limit, PDO::PARAM_INT);
			$results->bindParam(2, $offset, PDO::PARAM_INT);
		} else {
			$results = $db->prepare($sql);
		}	
		$results->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}

	$recipes = $results->fetchAll(PDO::FETCH_ASSOC);
	return $recipes;
}

function category_recipes_array($category, $limit = null, $offset = 0) {
	include("connection.php");
	$category = strtolower($category);
 	try {
	 	$sql = "SELECT recipe_id, title, category, imageUrl
	 		FROM recipes
	 		WHERE LOWER(category) = ?
	 		ORDER BY title";
			if (is_integer($limit)) {
				$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
				$results->bindParam(1, $category, PDO::PARAM_STR);
				$results->bindParam(2, $limit, PDO::PARAM_INT);
				$results->bindParam(3, $offset, PDO::PARAM_INT);
			} else {
		$results = $db->prepare($sql);
		$results->bindParam(1, $category, PDO::PARAM_STR);
		}
		$results->execute();
	 } catch (Exception $e) {
	 	echo "could not return query";
	 } 
	 $recipes = $results->fetchAll(PDO::FETCH_ASSOC);
	 return $recipes;
}

function search_recipes_array($search, $limit = null, $offset = 0) {
	include("connection.php");
  	try {
	 	$sql = "SELECT recipe_id, title, category, imageUrl
	 		FROM recipes
	 		WHERE title LIKE ?
	 		ORDER BY title";
			if (is_integer($limit)) {
				$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
				$results->bindValue(1, "%".$search."%", PDO::PARAM_STR);
				$results->bindValue(2, $limit, PDO::PARAM_INT);
				$results->bindValue(3, $offset, PDO::PARAM_INT);
			} else {
		$results = $db->prepare($sql);
		$results->bindValue(1, "%".$search."%", PDO::PARAM_STR);
		}
		$results->execute();
	 } catch (Exception $e) {
	 	echo "could not return query";
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
		$results = $db->prepare(
			"SELECT title, category, imageUrl, description FROM recipes
		/*	JOIN recipes_ingredients ON recipes.recipe_id = recipes_ingredients.recipe_id */
			WHERE  recipe_id = ?");	
		// bindParam binds id to the ? mark above
		$results->bindParam(1, $id, PDO::PARAM_INT);
		$results->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve results";
		exit;
	}

	$recipe = $results->fetch(PDO::FETCH_ASSOC);

	if (empty($recipe)) return $recipe;

	try {
		$result = $db->prepare("SELECT ingredient FROM recipes_ingredients
		/*	JOIN recipes_ingredients ON recipes.recipe_id = recipes_ingredients.recipe_id */
			WHERE  recipe_id = ?");	
		// bindParam binds id to the ? mark above
		$result->bindParam(1, $id, PDO::PARAM_INT);
		$result->execute();
	} catch (Exception $e) {
		echo "Unable to retrieve details";
		echo $e;
	}
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
	$output = "<div class='col-md-4'>"
			. "<figure><a href='recipe.php?id=" . $recipe["recipe_id"] . "'>"
			. "<img src='" . $recipe["imageUrl"] . "' class='img-responsive' alt='" 
			. $recipe["title"] ."' />"
			. "<figcaption>" . $recipe["title"] . "</figcaption>"
			. "</a></figure></div>";
	return $output;
 }

function subitems_list($subitems) {
 	foreach ($subitems as $subitem) {
	 echo "<li>$subitem</li>";
	}
}

// function array_category($category) {
//     $output = array();
    
//     foreach ($recipes as $id => $item) {
//         if ($category == null OR strtolower($category) == strtolower($item["category"])) {
//             $sort = $item["title"];
//             $output[$id] = $sort;            
//         }
//     }
    
//     asort($output);
//     return array_keys($output);
// }