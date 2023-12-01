<?php
$title = "Tým";
$site = "O nás:";
include "./templates/php-home-header.php"; ?>
<div class="text-break container text-white">
	<h3>
		Tato stránka popisuje tento web, jeho idea a strukturu.
	</h3>


	<h3>
		Idea webu:
	</h3>

	<p>
		Myšlenkou hry Riskuj je vytvořit zábavnou a poutavou hru, která prověří znalosti a dovednosti hráčů v různých tématech souvisejících s Českou zemědělskou univerzitou. Hra je inspirována populárním americkým kvízem Jeopardy! který se vysílá od roku 1964 a stal se kulturním fenoménem, či českou hrou Riskuj! kterou začala v roce 1994 vysílat televize Nova. ČZU Risk! se řídí podobným formátem, kdy v tabulce jsou otázky v různých kategoriích a hodnotách a hráči vybírají dle kategorie a počtu bodů.
	</p>

	<p>
		Uživatelé webu mohou nejel hrát kvízy připravené naším týmem, ale také hrát kvízy jiných hráču a své vlastní kvízy vytvářet.
	</p>


	<h3>
		Struktura webu
	</h3>

	<p>
		Tento web se skládá z následujících stránek:
	</p>

	<p>
		<a href="./" class="btn btn-light">/</a> <span class="fs-2 ms-4">Hlavní stránka webu</span>
	</p>
	<p>Na hlavní stránce webu se zobrazují především dostupné kvízy.</p>

	<p>
		<a href="./about" class="btn btn-light">/about</a> <span class="fs-2 ms-4">Informace o webu</span>
	<p>
	</p>To je stránka na kterou se právě díváte</p>

	<p>
		<a href="./homepage" class="btn btn-light">/homepage</a> <span class="fs-2 ms-4">Profil uživatele</span>
	</p>
	<p>Na této stránce jsou vidět informace o zvoleném uživateli jako počet bodů a počet výher, jsou zde také vidět kvízy vytvořené uživatelem.</p>

	<p>
		<a href="./register" class="btn btn-light">/register</a> <span class="fs-2 ms-4">Registrace</span>
	</p>
	<p>Formulář pro registraci uživatele.</p>

	<p>
		<a href="./login" class="btn btn-light">/login</a> <span class="fs-2 ms-4">Přihlášení</span>
	</p>
	<p>Formulář pro přihlášení uživatele.</p>

	<p>
		<a href="./add" class="btn btn-light">/add</a> <span class="fs-2 ms-4">Přidání kvízu</span>
	</p>
	<p>Na této stránce si může uživatel vytvořit svůj vlastní kvíz.</p>
	<p class="fs-2 text-bold">A/B testování</p>
	<p>Na stránce pro vytvoření kvízu bylo provedeno AB testování.</p>
	<p>V první verzi (A) je využito stránkování pro zobrazení / skrytí kategorií, v druhé verzi (B) je využit BS5 Accordion, což umožní rozbalení jednotlivých kategorií.</p>
	<p>
		<a href="./add" class="btn btn-light">VERZE A</a> 
		<a href="./addB" class="btn btn-light ms-4">VERZE B</a> 
	</p>



	<p>
		<a href="./play" class="btn btn-light">/play</a> <span class="fs-2 ms-4">Kvíz</span>
	</p>
	<p>Na této stránce by mělo být možné kvíz hrát, ale kvůli použití jiné databáze než využívá KIT tato stránka momentálně vůbec nefunguje.</p>




</div>
<?php include "./templates/php-footer.php"; ?>