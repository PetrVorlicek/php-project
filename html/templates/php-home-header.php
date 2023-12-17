<!DOCTYPE html>
<html lang="cs">

<head>
	<title>ČZU RISK!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.8">
	<link rel="stylesheet" href="../static/styles/universal-classes.css">
	<link rel="stylesheet" href="../static/styles/styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="./static/favicon.ico" rel="icon" type="image/x-icon">



	<?php if ($_SERVER['REQUEST_URI'] == "/play") : ?>
		<script>
			// Load environment adress
			const ENV_LOCAL = "<?= $_ENV['LOCAL_DEV'] ?>" === "True" ? true : false;
			const ENV_DNS = "<?= $_ENV['DNS'] ?>" === "True" ? true : false;
			const check = "<?= $_ENV['PUBLIC_IP'] ?>";

			let ENV_ADRESS = "";
			if (ENV_LOCAL) {
				ENV_ADRESS = "localhost";
			} else if (ENV_DNS) {
				ENV_ADRESS = "<?= $_ENV['DOMAIN'] ?>";
			} else {
				ENV_ADRESS = "<?= $_ENV['PUBLIC_IP'] ?>";
			}
		</script>
		<script src="../static/scripts/gameState.js"></script>
		<script src="../static/scripts/uiRenderer.js"></script>
		<script src="../static/scripts/gameStateHandler.js"></script>
		<script src="../static/scripts/websocketHandler.js"></script>

	<?php endif; ?>

</head>

<body>
	<header class="pt-5">
		<div class="warning-bar text-center pt-1 fw-bold">
			<p>Tato stránka je pouze semestrální projekt na předmět Client Side techonologie. <a class="text-decoration-underline text-white" href="https://github.com/PetrVorlicek/php-project/tree/droplet_env">Odkaz na zdrojový kód.</a></p>
		</div>
		<a href="./" class="text-decoration-none">
			<div class="container pt-5 text-white">
				<h1>
					<span class="nadpis-cast1">ČZU</span>
					<span class="nadpis-cast2">Riskuj!</span>
				</h1>
			</div>
		</a>
		<?php include "./templates/php-nav.php"; ?>
	</header>
	<section class="container pt-5 pb-5">
		<!-- DON'T ADD ANYTHING BELLOW -->