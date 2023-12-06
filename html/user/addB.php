<?php
$title = "add quiz";
$site = "add quiz";
include "./templates/php-home-header.php"; ?>

<div class="row justify-content-center px-2 card">
	<div class=" mt-3">
		<form>
			<div class="container">
				<h1>Přidání nového kvízu</h1>
				<!-- Accordion Container -->
				<div class="accordion" id="categoryAccordion">

					<!-- Category 1 -->
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Kategorie 1
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordion">
							<div class="accordion-body">

								<div class="mb-3">
									<h2><label for="categoryName" class="form-label">Název kategorie 1:</label></h2>
									<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
								</div>

								<h2>Otázky</h2>

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
					</div>

					<!-- Category 2 -->
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								Kategorie 2
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo" data-bs-parent="#accordion">
							<div class="accordion-body">

								<div class="mb-3">
									<h2><label for="categoryName" class="form-label">Název kategorie 1:</label></h2>
									<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
								</div>

								<h2>Otázky</h2>

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
					</div>

					<!-- Category 3 -->
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
								Kategorie 3
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordion">
							<div class="accordion-body">

								<div class="mb-3">
									<h2><label for="categoryName" class="form-label">Název kategorie 3:</label></h2>
									<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
								</div>

								<h2>Otázky</h2>

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
					</div>

					<!-- Category 4 -->
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingFour">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
								Kategorie 4
							</button>
						</h2>
						<div id="collapseFour" class="accordion-collapse collapse " aria-labelledby="headingFour" data-bs-parent="#accordion">
							<div class="accordion-body">

								<div class="mb-3">
									<h2><label for="categoryName" class="form-label">Název kategorie 4:</label></h2>
									<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
								</div>

								<h2>Otázky</h2>

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
					</div>

					<!-- Category 5 -->
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingFive">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
								Kategorie 5
							</button>
						</h2>
						<div id="collapseFive" class="accordion-collapse collapse " aria-labelledby="headingFive" data-bs-parent="#accordion">
							<div class="accordion-body">

								<div class="mb-3">
									<h2><label for="categoryName" class="form-label">Název kategorie 5:</label></h2>
									<input type="text" class="form-control" id="categoryName1" placeholder="Název kategorie" required>
								</div>

								<h2>Otázky</h2>

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
					</div>
				</div>

				<div class="container pb-5">
					<button type="submit" class="btn btn-primary mt-3">Vytvořit nový kvíz</button>
				</div>
			</div>

	</div>
</div>
<?php include "./templates/php-footer.php"; ?>