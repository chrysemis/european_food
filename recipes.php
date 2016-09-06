<?php 

include("inc/functions.php");
//$recipes = all_recipes_array();

$pageTitle = "All Recipes";
$section = null;
$search = null;
$items_per_page = 2;

if (isset($_GET["cat"])) {
	if ($_GET["cat"] == "bread") {
		$pageTitle = "Bread and pastry";
		$section = "bread";
	} else if ($_GET["cat"] == "mains") {
		$pageTitle = "Mains";
		$section = "mains";
	} else if ($_GET["cat"] == "sweets") {
		$pageTitle = "Sweets";
		$section = "sweets";
	} 
}

if (isset($_GET["s"])) {
	$search = filter_input(INPUT_GET, "s", FILTER_SANITIZE_STRING);
}

if (isset($_GET["pg"])) {
	$current_page = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
}

if (empty($current_page)) {
	$current_page = 1;
}

$total_items = get_recipes_count($section, $search);
$total_pages = 1;
$offset = 0;
if ($total_items > 0) {
	$total_pages = ceil($total_items / $items_per_page);

	//limit results in redirect
	$limit_results = "";
	if (!empty($search)) {
		$limit_results = "s=".urlencode(htmlspecialchars($search))."&";
	} else if (!empty($section)) {
		$limit_results = "cat=" . $section . "&";
	}

	//redirect too large page numbers to the last page 
	if ($current_page > $total_pages) {
		header("location:recipes.php?"
		. $limit_results
		. "pg=" . $total_pages);
	}
	//redirect too small page numbers to the first page 
		if ($current_page < 1) {
		header("location:recipes.php?"
		. $limit_results
		. "pg=1");
	}

	//determine the offset (number of items to skip) for the current page
	//for example: on page 3 with 8 items per page, the offset would be 16
	$offset = ($current_page - 1) * $items_per_page;

	$pagination = "<div class=\"pagination\">";
	$pagination .= "Pages: "; 
	for ($i = 1; $i <= $total_pages; $i++) {
		if ($i == $current_page) {
			$pagination .= " <span>$i</span>";
		} else {
			$pagination .= " <a href='recipes.php?";
			if (!empty($search)) {
				$pagination .= "s=".urlencode(htmlspecialchars($search))."&";
			} else if (!empty($section)) {
				$pagination .= "cat=".$section."&";
			}
			$pagination .= "pg=$i'>$i</a>";
		}
	}
	$pagination .= "</div>";
}

if (!empty($search)) {
	echo "searching";
	$recipes = search_recipes_array($search, $items_per_page, $offset);
} else if (empty($section)) {
  $recipes = all_recipes_array($items_per_page, $offset);
} else {
  $recipes = category_recipes_array($section, $items_per_page, $offset);
}

include("inc/header.php"); 
?>

<h1><?php 
if ($search != null) {
	echo "Search results for 
	\"".htmlspecialchars($search)."\"";
} else {
	if ($section != null) {
		echo "<a href='recipes.php'>All recipes</a> &gt; ";
	}
	echo $pageTitle; 
}
?></h1>	
<?php 
if ($total_items < 1) {
	echo "<p>No items were found matching this search term.</p>";
	echo "<p>Search again or "
	. "<a href=\"recipes.php\">browse the recipes.</a></p>";
	} else {
		echo $pagination;
?>
		    
<div class="container-fluid">
 	<div class="row">
 	<?php
     foreach ($recipes as $item) {
    	echo get_recipe_html($item);
 	 }  
		}
	?>

	
	</div> <!--row-->
</div> <!-- cont-fluid -->

<?php echo $pagination; ?>

<?php include("inc/footer.php");  

     