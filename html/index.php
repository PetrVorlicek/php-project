<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./styles/styles.css" />
    <link rel="stylesheet" href="./styles/universal-classes.css" />
    <script src="./scripts/questioning.js"></script>
  </head>
  <body>
    <div class="header flex-center">
      <nav class="main-nav">
        <?php for ($i = 1; $i < 10; $i++) : ?>
          <button class="btn btn-primary">
          <a>link <?=$i ?></a>
        </button>
        <?php endfor; ?>
      </nav>
    </div>

    <?php 
      // Connection to DB
      $hostname = "db";
      $dbname = "postgres";
      $username = "postgres";
      $password = "password";

      $dsn = "pgsql:host=$hostname;dbname=$dbname";
      $db = new PDO($dsn, $username, $password);

    ?>

    <div class="main-container flex-center">
      <table>
        <tbody>
          <tr class="player-row">
            <td>
              <div class="player-name flex-center">NAME</div>
            </td>
            <td>
              <div class="player-points flex-center">POINTS</div>
            </td>
          </tr>
          <tr class="category-row">
            <?php 
            $categoryQuery = $db->query("SELECT * FROM category");
            $categoryData = $categoryQuery->fetchall(PDO::FETCH_ASSOC);

            foreach ($categoryData as $category): ?>
            <td>
              <div class="category-name flex-center"><?=$category["name"] ?></div>
            </td>
            <?php endforeach; ?>
          </tr>
          
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

          $index = 0;
          // Rows
          foreach ($pointData as $points): ?>
            <tr>
              <?php for ($i = 1; $i < 6; $i++): ?>

                <td>
                  <button
                  class="btn btn-secondary"
                  onclick="triggerQuestion('<?php echo $questionData[$index]['question']; ?>', '<?php echo $questionData[$index]['answer']; ?>')">
                  <?=$points["point_value"]; ?> 
                  </button>
                </td>
              
              <?php $index += 5 ?>
              <?php endfor; ?>
            <?php $index -= 24 ?>
            </tr>
          <?php endforeach; ?>

        </tbody>
        <div class="question-container d-none">
          <div class="question-header">
            <button class="btn close-question-btn" onclick="triggerQuestion()">
              X
            </button>
          </div>
          <div class="question-text flex-center"></div>
          <div class="answer-text flex-center"></div>
        </div>
      </table>
    </div>
  </body>
</html>
<?php 
  $db = null;
?>