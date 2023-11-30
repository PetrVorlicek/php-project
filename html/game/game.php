<?php
  // Get environment variables
  require __DIR__."/../../vendor/autoload.php";
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../", ".env");
  $dotenv->load();

  // Connect to DB
  $db = connectDB();

  $title="Vítejte!";
  $site="Úvodní stránka";
  include "./templates/php-home-header.php"; ?>


  

  <div class="container">

    <div class="flex-center">

      
      <div class="wait-for-turn-text position-absolute d-flex align-items-center justiy-content-center">
        <div class="me-3 text-white fw-bold fs-4 wait-for-turn-state text-center">Čeká se na soupeře</div>
      </div>

      <div class="questions-holder w-100 border-radius text-center">
        <div id="player-name" class="player-info fw-bold rounded flex-center">NAME</div>
        <div id="player-points" class="player-info fw-bold rounded flex-center">POINTS</div>
        <div class="player-info fw-bold rounded flex-center"> VS </div>
        <div id="opposite-name" class="player-info fw-bold rounded flex-center">NAME</div>
        <div id="opposite-points" class="player-info fw-bold rounded flex-center">POINTS</div>

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

        <?php foreach ($categoryData as $category) : ?>
          <div class="question-container category-buttons category-<?= $category["name"]; ?>-btns">

            <?php for ($j = 1; $j < 6; $j++) : ?>
              <button class="btn btn-question w-100 mb-1 invisible <?= $category["name"]; ?>-<?= $j; ?>" onclick='triggerQuestion("<?= $category["name"]; ?>", <?= $j; ?>)' data-bs-toggle="modal" data-bs-target="#game-modal">
                <?= $pointData[$j - 1]["point_value"] ?>
              </button>
            <?php endfor; ?>

          </div>
        <?php endforeach; ?>
      </div>

      <div class="modal fade" id="game-modal" tabindex="-1" aria-labelledby="game-modal-label" data-bs-keyboard="false" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 fw-bold text-dark" id="game-modal-label"></h1>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center"></div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

<?php
$db = null;
?>

<?php include "./templates/php-footer.php"; ?>