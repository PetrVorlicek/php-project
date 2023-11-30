<?php 
    $title="Vítejte!";
    $site="Úvodní stránka";
    include "./templates/php-home-header.php"; ?>

    <div class="container px-5">
        <h2 class="mb-4 text-white">Seznam kvízů</h2>


	<div class="container">
		<a href="./add" class="btn btn-light">Přidat vlastní kvíz!</a>
	</div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">


            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kvíz Piva</h5>
                        <p class="card-text">Vytvořil: Pepa Mráček</p>
                        <p class="card-text">Počet spuštění: 123</p>
                        <a href="./play" class="btn btn-primary">Spustit kvíz!</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inovacích v Zemědělství</h5>
                        <p class="card-text">Vytvořil: Admi Nistrátor</p>
                        <p class="card-text">Počet spuštění: 10</p>
                        <a href="./play" class="btn btn-primary">Spustit kvíz!</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">České celebrity</h5>
                        <p class="card-text">Vytvořil: Karel Tomšík</p>
                        <p class="card-text">Počet spuštění: 4</p>
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
	<div class="container mt-5 mb-5">
		<a href="./add" class="btn btn-light">Přidat vlastní kvíz!</a>
	</div>

    </div>



</div>
<?php include "./templates/php-footer.php"; ?>