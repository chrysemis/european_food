<?php 
function get_recipe_html($id, $recipe) {
	$item = "<div class='col-md-4'>
			<figure><a href='recipe.php?id=$id'>
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