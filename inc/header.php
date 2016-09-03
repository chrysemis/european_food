<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Dekko" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Arima+Madurai:500" rel="stylesheet"> 
		<link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
 
		<div>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> 
						</button>
						<a class="navbar-brand" href="#">European Cuisine</a>
					</div> <!--navbar-header-->
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="index.php">Home</a></li>
								 <li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Recipes
									<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="recipes.php?cat=bread">Bread</a></li>
										<li><a href="recipes.php?cat=mains">Mains</a></li>
										<li><a href="recipes.php?cat=sweets">Sweets</a></li>
 									</ul>
								</li> 
							<li><a href="ingredients-list.php">Ingredients</a></li>
							<li><a href="#about">About</a></li> 
						</ul>
					</div> <!--navbar-collapse-->
				</div> <!--cont-fluid-->
			</nav>
		</div>
					
		<div id="content"> 