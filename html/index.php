<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./static/styles/styles.css" />
    <link rel="stylesheet" href="./static/styles/universal-classes.css" />
    <script src="./static/scripts/questioning.js"></script>
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
      <table class="questions-table">
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
      </table>
      <div class="modal d-none">
        <div class="modal-header top-radius">
          <span>Choose number of players</span>
          <button
            class="btn btn-close close-question-btn"
            onclick="triggerQuestion()"
          >
            X
          </button>
        </div>
      </div>
      <div class="modal question-container d-none">
        <div class="modal-header question-header w-100 top-radius">
          <span>CATEGORY</span>
          <button
            class="btn btn-close close-question-btn"
            onclick="triggerQuestion()"
          >
            X
          </button>
        </div>
        <div class="question-text w-100 flex-center bottom-radius">
          <table>
            <tbody>
              <tr>
                <td colspan="2">Dafuck question how is the wow?</td>
              </tr>
              <tr>
                <td class="w-50">Answer 1</td>
                <td class="w-50">
                  <button class="btn answer-btn" onclick="handlePoints(5)">
                    A
                  </button>
                </td>
              </tr>
              <tr>
                <td class="w-50">Answer 2</td>
                <td class="w-50"><button class="btn answer-btn">B</button></td>
              </tr>
              <tr>
                <td class="w-50">Answer 3</td>
                <td class="w-50"><button class="btn answer-btn">C</button></td>
              </tr>
              <tr>
                <td class="w-50">Answer 4</td>
                <td class="w-50"><button class="btn answer-btn">D</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
<?php 
  $db = null;
?>