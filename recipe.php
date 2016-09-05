<?php 

include("inc/functions.php");

if (isset($_GET["id"])) {
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	$item = single_recipe_array($id);
}

if (empty($item)) {
	//redirection to all recipes
	header("location:recipes.php");
	exit;
}

$pageTitle = $item["title"];
$section = null;

include("inc/header.php"); 
?>

<div>
	<a href="recipes.php">All recipes</a>
	&gt; <a href="recipes.php?cat=<?php echo strtolower($item["category"]); ?>"><?php echo $item["category"]; ?></a>
	&gt;
	<?php echo $item["title"]; ?>
</div>

<h2><?php echo $item["title"]; ?></h2>
<p class="recipe-text" id="meal-information"><?php echo $item["description"]; ?></p>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<img src="<?php echo $item["imageUrl"]; ?>" alt="<?php echo $item["title"]; ?>" />
		</div> <!--col-->
		<div class="col-md-6">
			<h2>Ingredients:</h2>
			<ul>
				<?php 
				$ingredients = $item["ingredients"];
				subitems_list($ingredients);
				?>
			</ul>
		</div>  <!--col-->
	</div>  <!--row-->
</div> <!--container-fluid-->
				 
<div class="recipe">
	<h2 class="clear">Method:</h2>
	<ol>
		<?php 
		$method = $item["method"];
		subitems_list($method);
		?>
	</ol>
</div>  


<?php include("inc/footer.php");  
