const handleRedraw = () => {
  const playerPointsDiv = document.querySelector("#player-points");
  const playerNameDiv = document.querySelector("#player-name");
  const oppositePointsDiv = document.querySelector("#opposite-points");
  const oppositeNameDiv = document.querySelector("#opposite-name");
  playerPointsDiv.innerText = gameState["currentPlayer"]["points"];
  playerNameDiv.innerText = gameState["currentPlayer"]["player"];
  oppositePointsDiv.innerText = gameState["oppositePlayer"]["points"];
  oppositeNameDiv.innerText = gameState["oppositePlayer"]["player"];

  while (document.readyState === "loading") {
    //Wait for document to load
  } // TODO probably not needed anymore - check it

  renderCurrentUI(gameState, gameReady);
  renderInvisible(gameState["gameState"]["usedQuestions"]);
};

const renderCurrentUI = (state, ready) => {
  // Renders question field depending on the state of the game depending on player view
  const buttonQuestion = document.querySelectorAll(".btn-question");
  const waitState = document.querySelector(".wait-for-turn-state");

  if (!state["currentPlayer"]["onTurn"]) {
    buttonQuestion.forEach((element) => element.classList.add("invisible"));
    waitState.classList.remove("d-none");
  } else {
    buttonQuestion.forEach((element) => element.classList.remove("invisible"));
    waitState.classList.add("d-none");
  }

  if (!ready) {
    waitState.innerText = "Čeká se na druhého hráče. ";
    buttonQuestion.forEach((element) => element.classList.add("invisible"));
    waitState.classList.remove("d-none");
    return;
  } else {
    waitState.innerText = "Druhý hráč na tahu! ";
  }
};

const renderInvisible = (questionArray) => {
  // Used questions are rendered as invisible
  questionArray.forEach((question) => {
    const usedQuestion = document.querySelector(
      `.${question[0]}-${question[1]}`
    );
    usedQuestion.classList.add("invisible");
  });
};

const showQuestion = (question, answers) => {
  const questionTextHolder = document.querySelector(".question-text");
  const questionHeader = document.querySelector("#game-modalLabel");
  const gameModalBody = document.querySelector(".modal-body");
  const gameModalFooter = document.querySelector(".modal-footer");
  const gameModalTitle = document.querySelector(".modal-title");

  gameModalTitle.innerText = `Choose answer`;

  gameModalBody.innerHTML = `
  <table>
  <tbody>
    <tr>
      <td colspan="2" class="fw-bold text-dark">${question}</td>
    </tr>
    <tr>
      <td class="w-50 text-dark">Answer 1</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary" data-bs-dismiss="modal" onclick="answerQuestion('${answers[0]}')">
          ${answers[0]}
        </button>
      </td>
    </tr>
    <tr>
      <td class="w-50 text-dark">Answer 2</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary" data-bs-dismiss="modal" onclick="answerQuestion('${answers[1]}')">
          ${answers[1]}
        </button>
      </td>
    </tr>
    <tr>
      <td class="w-50 text-dark">Answer 3</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary" data-bs-dismiss="modal" onclick="answerQuestion('${answers[2]}')">
          ${answers[2]}
        </button>
      </td>
    </tr>
    <tr>
      <td class="w-50 text-dark">Answer 4</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary" data-bs-dismiss="modal" onclick="answerQuestion('${answers[3]}')">
          ${answers[3]}
        </button>
      </td>
    </tr>
  </tbody>
  </table>`;
  gameModalFooter.innerHTML = ``;
};

const showStarterModal = (questionText) => {
  const gameModalBody = document.querySelector(".modal-body");
  const gameModalFooter = document.querySelector(".modal-footer");
  const gameModalTitle = document.querySelector(".modal-title");

  gameModalTitle.innerText = `Choose number of players`;

  gameModalBody.innerHTML = `
    <button class="btn btn-secondary me-2">1 Player</button>
    <button class="btn btn-secondary me-2">2 Players</button>
    <button class="btn btn-secondary">3 Players</button>`;

  gameModalFooter.innerHTML = `
    <button
    type="button"
    class="btn btn-secondary"
    data-bs-dismiss="modal"
    >
    Close
    </button>
    <button type="button" class="btn btn-primary">
        Save changes
    </button>`;
};
