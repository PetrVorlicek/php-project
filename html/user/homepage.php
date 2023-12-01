
<?php
$username = 'Admi Nistrátor';
$points = 986;
$games = 15;
$wins = 10;
?>

<?php
$title = "Uživatelský účet";
$site = "Profilová stránka";
include "./templates/php-home-header.php"; ?>
<div class="row justify-content-center px-2">

    <div class="col-md-8 card">

	<div class="container pt-4 text-center">
	
		<p class="fs-5">Statistiky uživatele: </p> <p class="fw-bolder fs-2"><?= $username; ?></p>


	    <div class="row pt-4">
        	<div class="col-md-4 ">

	            <h4>Počet bodů</h4>
        	    <p class="fw-bolder fs-4"><?= $points; ?></p>
	        </div>
            	<div class="col-md-4 ">

            		<h4>Počet her</h4>
            		<p class="fw-bolder fs-4"><?= $games; ?></p>
            	</div>
    	    	<div class="col-md-4 ">
	
        	    	<h4>Počet výher</h4>
	            	<p class="fw-bolder fs-4"><?= $wins; ?></p>
	       </div>
   	    </div>
        </div>
    </div>
</div>

    <div class="container mt-5 px-5 pb-3">
        <h2 class="mb-4 text-white">Seznam vašich kvízů</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">


	    <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inovacích v Zemědělství</h5>
                        <p class="card-text">Vytvořil: Admi Nistrátork</p>
                        <p class="card-text">Počet spuštění: 10</p>
                        <a href="./play" class="btn btn-primary">Spustit kvíz!</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Traktory</h5>
                        <p class="card-text">Vytvořil: Admi Nistrátor</p>
                        <p class="card-text">Počet spuštění: 0</p>
                        <a href="./play" class="btn btn-primary">Spustit kvíz!</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Test ovoce a zeleniny</h5>
                        <p class="card-text">Vytvořil: Admi Nistrátor</p>
                        <p class="card-text">Počet spuštění: 20</p>
                        <a href="./play" class="btn btn-primary">Spustit kvíz!</a>
                    </div>
                </div>
            </div>




	</div>
   </div>

<?php include "./templates/php-footer.php"; ?>

