// Game State
let gameState = {
  player: "",
  players: [],
  currentPlayer: {
    player: "",
    points: 0,
    onTurn: false,
  },
  oppositePlayer: {
    player: "",
    points: 0,
    onTurn: false,
  },
  gameState: {
    isOver: false,
    usedQuestions: [],
  },
};
let gameReady = false;
let lastTriggered = {
  categoryName: "",
  pointID: "",
};

const conn = new WebSocket("ws://localhost:8091");
conn.onopen = function (msg) {};

conn.onmessage = function (msg) {
  // Parse and handle valid message
  const parsedMessage = JSON.parse(msg.data);
  if (parsedMessage["type"] !== undefined) {
    messageHandler(parsedMessage["type"], parsedMessage["payload"]);
  }
};

const messageHandler = (type, payload) => {
  // Function to handle messages from the server

  switch (type) {
    case "greet":
      handleGreet(payload);
      break;
    case "error":
      handleError();
      break;
    case "warning":
      handleWarning(payload);
      break;
    case "gameStart":
      handleGameStart(payload);
      break;
    case "question":
      handleQuestion(payload);
      break;
    case "answer":
      handleAnswer(payload);
      break;
    case "state":
      handleState(payload);
      break;
    default:
      console.log(`Unknown message: ${type}:\t${payload}`);
      break;
  }

  handleRedraw();
};

const handleGreet = (payload) => {
  // This should handle the connection to game lobby
  gameState["player"] = payload["player"];
  gameState["players"] = payload["allPlayers"];
};

const handleError = () => {
  // This should redirect to previous page
  // TODO make this better :D
  window.location.href = "http://localhost";
};

const handleWarning = (payload) => {
  // This should say that the game ended prematurely
  gameState["players"];
  gameReady = false;
};

const handleGameStart = (payload) => {
  // This should initiate the game / game state
  handleState(payload["payload"]);
  gameReady = true;
};

const handleQuestion = (payload) => {
  // This should return the question data (question, answers)
  showQuestion(payload["question"], payload["answers"]);
};

const handleAnswer = (payload) => {
  // This should inform the player if his answer was sucessfull
  // Probabbly not needed, because points should be handled by ws server and state
  if (payload["player"] === gameState["player"]) {
    gameState["currentPlayer"]["points"] += payload["points"];
  }
};

const handleState = (payload) => {
  // This should update the game state and handle game end
  gameState["currentPlayer"] = payload["currentPlayer"];
  gameState["oppositePlayer"] = payload["oppositePlayer"];
  gameState["gameState"] = payload["gameState"];
  console.log(gameState["gameState"]);
  console.log(payload["gameState"]);
};

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
  }

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

const answerQuestion = (answer) => {
  const answerMessage = {
    type: "answerQuestion",
    payload: {
      player: gameState["player"],
      categoryName: lastTriggered["categoryName"],
      pointID: lastTriggered["pointID"],
      answer: answer,
    },
  };

  // Reset modal
  const gameModalBody = document.querySelector(".modal-body");
  const gameModalFooter = document.querySelector(".modal-footer");
  const gameModalTitle = document.querySelector(".modal-title");
  gameModalTitle.innerText = "";
  gameModalBody.innerHTML = "";
  gameModalFooter.innerHTML = "";

  const parsedMessage = JSON.stringify(answerMessage);
  conn.send(parsedMessage);
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

const triggerQuestion = (categoryName, questionID) => {
  lastTriggered["categoryName"] = categoryName;
  lastTriggered["pointID"] = questionID.toString();

  const questionMessage = {
    type: "getQuestion",
    payload: {
      player: gameState["player"],
      categoryName: lastTriggered["categoryName"],
      pointID: lastTriggered["pointID"],
    },
  };

  const parsedMessage = JSON.stringify(questionMessage);
  conn.send(parsedMessage);
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
