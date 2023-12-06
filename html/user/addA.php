<?php
$title = "add quiz";
$site = "add quiz";
include "./templates/php-home-header.php"; ?>


<div class="row justify-content-center px-2 card">
	<div class="col-md-12 mt-3">

		<!-- Pagination -->
		<nav aria-label="Page navigation container pt-3">
			<h1>Přidání nového kvízu</h1>
			<ul class="pagination">
				<li class="page-item" id="page-item1"><a class="page-link" href="#page1" onclick="showPage(1)">Kategorie 1</a></li>
				<li class="page-item" id="page-item2"><a class="page-link" href="#page2" onclick="showPage(2)">Kategorie 2</a></li>
				<li class="page-item" id="page-item3"><a class="page-link" href="#page3" onclick="showPage(3)">Kategorie 3</a></li>
				<li class="page-item" id="page-item4"><a class="page-link" href="#page4" onclick="showPage(4)">Kategorie 4</a></li>
				<li class="page-item" id="page-item5"><a class="page-link" href="#page5" onclick="showPage(5)">Kategorie 5</a></li>
			</ul>
		</nav>

		<form>
			<div class="container"> <!-- Konteknery kategorii-->

				<!-- Content containers -->
				<div class="container page-container" id="page1"> <!-- kategorie 1 -->
					<div class="mb-3">
						<h2><label for="categoryName" class="form-label">Název kategorie 1:</label></h2>
						<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
					</div>



					<!-- Question 1 -->
					<div class="mb-3">
						<h4><label for="question1" class="form-label">Otázka 1</label></h4>
						<input type="text" class="form-control" id="question1" placeholder="Text otázky" required>
						<label for="answer1" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer1" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question2" class="form-label">Otázka 2</label></h4>
						<input type="text" class="form-control" id="question2" placeholder="Text otázky" required>
						<label for="answer2" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer2" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question3" class="form-label">Otázka 3</label></h4>
						<input type="text" class="form-control" id="question3" placeholder="Text otázky" required>
						<label for="answer3" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer3" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question4" class="form-label">Otázka 4</label></h4>
						<input type="text" class="form-control" id="question4" placeholder="Text otázky" required>
						<label for="answer4" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer4" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question5" class="form-label">Otázka 5</label></h4>
						<input type="text" class="form-control" id="question5" placeholder="Text otázky" required>
						<label for="answer5" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer5" placeholder="Odpověď" required>
					</div>
				</div>

				<div class="container page-container" id="page2" style="display: none;"> <!-- kategorie 2 -->
					<div class="mb-3">
						<h2><label for="categoryName" class="form-label">Název kategorie 2:</label></h2>
						<input type="text" class="form-control" id="categoryName" placeholder="Název kategorie" required>
					</div>



					<!-- Question 1 -->
					<div class="mb-3">
						<h4><label for="question1" class="form-label">Otázka 1</label></h4>
						<input type="text" class="form-control" id="question1" placeholder="Text otázky" required>
						<label for="answer1" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer1" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question2" class="form-label">Otázka 2</label></h4>
						<input type="text" class="form-control" id="question2" placeholder="Text otázky" required>
						<label for="answer2" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer2" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question3" class="form-label">Otázka 3</label></h4>
						<input type="text" class="form-control" id="question3" placeholder="Text otázky" required>
						<label for="answer3" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer3" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question4" class="form-label">Otázka 4</label></h4>
						<input type="text" class="form-control" id="question4" placeholder="Text otázky" required>
						<label for="answer4" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer4" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question5" class="form-label">Otázka 5</label></h4>
						<input type="text" class="form-control" id="question5" placeholder="Text otázky" required>
						<label for="answer5" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer5" placeholder="Odpověď" required>
					</div>
				</div>

				<div class="container page-container" id="page3" style="display: none;"> <!-- kategorie 3 -->
					<div class="mb-3">
						<h2><label for="categoryName" class="form-label">Název kategorie 3:</label></h2>
						<input type="text" class="form-control" id="categoryName" placeholder="Název kategorie" required>
					</div>



					<!-- Question 1 -->
					<div class="mb-3">
						<h4><label for="question1" class="form-label">Otázka 1</label></h4>
						<input type="text" class="form-control" id="question1" placeholder="Text otázky" required>
						<label for="answer1" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer1" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question2" class="form-label">Otázka 2</label></h4>
						<input type="text" class="form-control" id="question2" placeholder="Text otázky" required>
						<label for="answer2" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer2" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question3" class="form-label">Otázka 3</label></h4>
						<input type="text" class="form-control" id="question3" placeholder="Text otázky" required>
						<label for="answer3" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer3" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question4" class="form-label">Otázka 4</label></h4>
						<input type="text" class="form-control" id="question4" placeholder="Text otázky" required>
						<label for="answer4" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer4" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question5" class="form-label">Otázka 5</label></h4>
						<input type="text" class="form-control" id="question5" placeholder="Text otázky" required>
						<label for="answer5" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer5" placeholder="Odpověď" required>
					</div>
				</div>

				<div class="container page-container" id="page4" style="display: none;"> <!-- kategorie 4 -->
					<div class="mb-3">
						<h2><label for="categoryName" class="form-label">Název kategorie 4:</label></h2>
						<input type="text" class="form-control" id="categoryName" placeholder="Název kategorie" required>
					</div>



					<!-- Question 1 -->
					<div class="mb-3">
						<h4><label for="question1" class="form-label">Otázka 1</label></h4>
						<input type="text" class="form-control" id="question1" placeholder="Text otázky" required>
						<label for="answer1" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer1" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question2" class="form-label">Otázka 2</label></h4>
						<input type="text" class="form-control" id="question2" placeholder="Text otázky" required>
						<label for="answer2" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer2" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question3" class="form-label">Otázka 3</label></h4>
						<input type="text" class="form-control" id="question3" placeholder="Text otázky" required>
						<label for="answer3" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer3" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question4" class="form-label">Otázka 4</label></h4>
						<input type="text" class="form-control" id="question4" placeholder="Text otázky" required>
						<label for="answer4" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer4" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question5" class="form-label">Otázka 5</label></h4>
						<input type="text" class="form-control" id="question5" placeholder="Text otázky" required>
						<label for="answer5" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer5" placeholder="Odpověď" required>
					</div>
				</div>

				<div class="container page-container" id="page5" style="display: none;"> <!-- kategorie 5 -->
					<div class="mb-3">
						<h2><label for="categoryName" class="form-label">Název kategorie 5:</label></h2>
						<input type="text" class="form-control" id="categoryName" placeholder="Název kategorie" required>
					</div>



					<!-- Question 1 -->
					<div class="mb-3">
						<h4><label for="question1" class="form-label">Otázka 1</label></h4>
						<input type="text" class="form-control" id="question1" placeholder="Text otázky" required>
						<label for="answer1" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer1" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question2" class="form-label">Otázka 2</label></h4>
						<input type="text" class="form-control" id="question2" placeholder="Text otázky" required>
						<label for="answer2" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer2" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question3" class="form-label">Otázka 3</label></h4>
						<input type="text" class="form-control" id="question3" placeholder="Text otázky" required>
						<label for="answer3" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer3" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question4" class="form-label">Otázka 4</label></h4>
						<input type="text" class="form-control" id="question4" placeholder="Text otázky" required>
						<label for="answer4" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer4" placeholder="Odpověď" required>
					</div>

					<div class="mb-3">
						<h4><label for="question5" class="form-label">Otázka 5</label></h4>
						<input type="text" class="form-control" id="question5" placeholder="Text otázky" required>
						<label for="answer5" class="form-label">Odpověď</label>
						<input type="text" class="form-control" id="answer5" placeholder="Odpověď" required>
					</div>
				</div>

			</div>

			<div class="container pb-5">
				<button type="submit" class="btn btn-primary mt-3">Vytvořit nový kvíz</button>
			</div>
		</form>
	</div>
</div>

<script>
	function showPage(pageNumber) {
		const containers = document.querySelectorAll('.page-container');
		containers.forEach(container => {
			container.style.display = 'none';
		});

		const Itemcontainers = document.querySelectorAll('.page-item');
		Itemcontainers.forEach(container => {
			container.classList.remove("active");
		});

		const pageId = 'page' + pageNumber;
		const pageItem = "page-item" + pageNumber;
		const pageContainer = document.getElementById(pageId);
		const pageItemContainer = document.getElementById(pageItem);

		if (pageContainer) {
			pageContainer.style.display = 'block';
		}

		if (pageItemContainer) {
			pageItemContainer.classList.add("active");
		}
	}

	// Show the initial page (optional)
	showPage(1);
</script>

<?php include "./templates/php-footer.php"; ?>