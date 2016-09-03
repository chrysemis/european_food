<?php 

include("inc/data.php");
include("inc/functions.php");

$pageTitle = "All Recipes";
$section = null;

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

include("inc/header.php"); 
?>

<h1><?php 
if ($section != null) {
	echo "<a href='recipes.php'>All recipes</a> &gt; ";
}
echo $pageTitle; ?></h1>
<div class="container-fluid">
 	<div class="row">
 		<?php 
 		$categories = array_category($recipes, $section);
 		foreach ($categories as $id) {
 			echo get_recipe_html($id, $recipes[$id]);
 		}
 		?>
	 </div> <!-- row -->
</div> <!-- cont-fluid -->
	


<?php include("inc/footer.php");  

     