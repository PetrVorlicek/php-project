
<?php 
    $title="add quiz";
    $site="add quiz";
    include "./templates/php-home-header.php"; ?>


<div class="row justify-content-center text-white">
<div class="col-md-8">
  <h2 class="mb-4">Přidání nového kvízu</h2>

  <form id="quizForm">
    

    <!-- Loop through categories and questions -->
    <div id="questionsContainer">
      <!-- Category 1 -->
      

      <div class="mb-5">
        <h4>Kategorie 1</h4>
        <div class="mb-4">
            <label for="categoryName" class="form-label">Název kategorie 1</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 1 (10 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 2 (20 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 3 (30 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 4 (40 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 5 (50 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <!-- Repeat similar structure for other questions in Category 1 -->
      </div>

      <div class="mb-5">
        <h4>Kategorie 2</h4>
        <div class="mb-4">
            <label for="categoryName" class="form-label">Název kategorie 2</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 1 (10 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 2 (20 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 3 (30 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 4 (40 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 5 (50 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <!-- Repeat similar structure for other questions in Category 1 -->
      </div>

      <div class="mb-5">
        <h4>Kategorie 3</h4>
        <div class="mb-4">
            <label for="categoryName" class="form-label">Název kategorie 3</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 1 (10 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 2 (20 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 3 (30 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 4 (40 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 5 (50 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <!-- Repeat similar structure for other questions in Category 1 -->
      </div>

      <div class="mb-5">
        <h4>Kategorie 4</h4>
        <div class="mb-4">
            <label for="categoryName" class="form-label">Název kategorie 4</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 1 (10 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 2 (20 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 3 (30 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 4 (40 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 5 (50 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <!-- Repeat similar structure for other questions in Category 1 -->
      </div>

      <div class="mb-5">
        <h4>Kategorie 5</h4>
        <div class="mb-4">
            <label for="categoryName" class="form-label">Název kategorie 5</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 1 (10 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 2 (20 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 3 (30 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 4 (40 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <div class="mb-4">
          <label for="question1" class="form-label">Otázka 5 (50 bodů)</label>
          <input type="text" class="form-control" id="question1" name="question1" required>
          <label for="answer1" class="form-label">Správná odpověď</label>
          <input type="text" class="form-control" id="answer1" name="answer1" required>
        </div>
        <!-- Repeat similar structure for other questions in Category 1 -->
      </div>

      <!-- Repeat similar structure for other categories -->

    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit Quiz</button>
  </form>
</div>
</div>
<?php include "./templates/php-footer.php"; ?>