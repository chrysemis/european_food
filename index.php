<?php 
include("inc/data.php");
include("inc/functions.php");

$pageTitle = "European Cuisine";

include("inc/header.php"); 
?>

<div class="container-fluid">
	<div class="row">
		<?php 
		$random = array_rand($recipes, 3);
 		foreach ($random as $id) {
 			echo get_recipe_html($id, $recipes[$id]);
 		};
 		?>
 	</div> <!-- row -->
</div> <!--container-fluid-->
<div class="about-section">
	<a href="about"></a>
	<p>I'm an expat currently living in England who recently discovered amazing world of coding and website development.</p>
	<p>I'm also a foodie who loves trying new interesting meals of various national cuisines. I've decided to join my two passions and build a small food blog.</p>
	<p>I will share here my favourite meals from the countries I'm related to in some way - Slovakia, Hungary, England and Italy.</p>
	<p>Contact:</p>
</div> <!-- about -->

<?php include("inc/footer.php"); 
