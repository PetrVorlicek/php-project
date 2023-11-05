<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../static/styles/universal-classes.css" />
  <link rel="stylesheet" href="../static/styles/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <script src="../static/scripts/questioning.js"></script>
</head>

<body>

  <?php
  // Connection to DB
  $db = connectDB();
  ?>

  <div class="container">
    <div class="header flex-center w-100 pt-2">
      <nav class="main-nav w-100 d-flex mb-4">
        <?php for ($i = 1; $i < 5; $i++) : ?>
          <button class="btn btn-primary" class="btn btn-primary" onclick="showStarterModal()" data-bs-toggle="modal" data-bs-target="#game-modal">
            <a>Players <?= $i ?></a>
          </button>
        <?php endfor; ?>
      </nav>
    </div>

    <div class="flex-center">
      <div class="questions-holder w-100 border-radius">
        <script>
          // FRONTEND websocket script
          var conn = new WebSocket('ws://localhost:8091');
          conn.onopen = function(e) {
              console.log("Connection established!");
          };

          conn.onmessage = function(e) {
              console.log(e.data);
          };

        </script>
        <div class="player-name player-info fw-bold rounded flex-center">NAME</div>
        <div class="player-points player-info fw-bold rounded flex-center">POINTS</div>

        <?php
        $categoryQuery = $db->query("SELECT * FROM category");
        $categoryData = $categoryQuery->fetchall(PDO::FETCH_ASSOC);
        foreach ($categoryData as $category) : ?>
          <div class="category-name fw-bold rounded flex-center"><?= $category["name"] ?></div>
        <?php endforeach; ?>

        <?php
        // Populate form with questions
        $questionQuery = $db->query("SELECT 
                                      category.name AS category, 
                                      point_category.point_value AS points,
                                      question.question AS question, 
                                      answer.answer_text AS answer
                                      FROM question 
                                      JOIN answer ON
                                      question.r_answer_id = answer.id
                                      JOIN category ON
                                      question.category_id = category.id
                                      JOIN point_category ON 
                                      question.point_category_id = point_category.id
                                      ");
        $questionData = $questionQuery->fetchall(PDO::FETCH_ASSOC);
        $pointQuery = $db->query("SELECT * FROM point_category");
        $pointData = $pointQuery->fetchall(PDO::FETCH_ASSOC);
        $index = 0; ?>

        <?php for ($i = 1; $i < 6; $i++) : ?>
          <div class="category-buttons category-<?= $i; ?>-btns">

            <?php for ($n = 1; $n < 6; $n++) : ?>
              <button class="btn btn-question w-100 mb-1" onclick="triggerQuestion()" data-bs-toggle="modal" data-bs-target="#game-modal">
                1
              </button>
            <?php endfor; ?>

          </div>
        <?php endfor; ?>
      </div>

      <div class="modal fade" id="game-modal" tabindex="-1" aria-labelledby="game-modal-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 fw-bold" id="game-modal-label"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>


<?php
$db = null;
?>