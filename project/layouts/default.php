<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="/project/webroot/css/style.css" />
	<link type="image/x-icon" href="/project/webroot/favicon.ico" rel="shortcut icon">
	<script src="https://kit.fontawesome.com/e5c7b755ae.js" crossorigin="anonymous"></script>
	<title><?php echo $title ?></title>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1D7373;">
		<a class="navbar-brand" href="/list" id="nav-title">CONFEES</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto ml-auto">
				<li class="nav-item pr-5">
					<a class="nav-link <?php if ($page->view === 'list/show') {
											echo "active";
										} ?> nav-buttons" href="/list">СПИСОК</a>
				</li>

				<li class="nav-item">
					<a class="nav-link <?php if ($page->view === 'conf/create') {
											echo "active";
										} ?> nav-buttons" href="/conf/create">СОЗДАТЬ</a>
				</li>
			</ul>
			<form method="get" action="/list" class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" name="pattern" value="<?php if ($_GET) echo $_GET["pattern"]; ?>" type="text" placeholder="Поиск" aria-label="Search" />
				<button class="btn btn-info my-2 my-sm-0" type="submit">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</form>
		</div>
	</nav>
	<?= $content ?>
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUEtd1SJtH0EjOC6B-cko0YYmB5A56A9s&callback=initMap&v=weekly" defer></script>
	<script src="/project/webroot/js/script.js"></script>
</body>

</html>