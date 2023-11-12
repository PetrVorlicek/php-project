const playerInfo = {
  name: "playerName",
  points: 0,
};

let playerName = "";

const conn = new WebSocket("ws://localhost:8091");
conn.onopen = function (msg) {
  console.log("Connection established!");
};

conn.onmessage = function (msg) {
  // Set player name on greet
  const parsedMessage = JSON.parse(msg.data);
  console.log(parsedMessage);
  if (
    parsedMessage["type"] !== undefined &&
    parsedMessage["type"] === "greet"
  ) {
    playerName = parsedMessage["payload"]["player"];
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
};

const handleGreet = (payload) => {
  // This should handle the connection to game lobby
};

const handleError = () => {
  // This should redirect to previous page
};

const handleWarning = (payload) => {
  // This should say that the game ended prematurely
};

const handleGameStart = (payload) => {
  // This should initiate the game / game state
};

const handleQuestion = (payload) => {
  // This should return the question data (question, answers)
};

const handleAnswer = (payload) => {
  // This should inform the player if his answer was sucessfull
};

const handleState = (payload) => {
  // This should update the game state and handle game end
};

const triggerQuestion = (categoryName, questionID) => {
  const questionTextHolder = document.querySelector(".question-text");
  const questionHeader = document.querySelector("#game-modalLabel");
  const gameModalBody = document.querySelector(".modal-body");
  const gameModalFooter = document.querySelector(".modal-footer");
  const gameModalTitle = document.querySelector(".modal-title");

  const questionMessage = {
    type: "getQuestion",
    payload: {
      player: playerName,
      categoryName: categoryName,
      pointID: questionID.toString(),
    },
  };

  const parsedMessage = JSON.stringify(questionMessage);
  conn.send(parsedMessage);
  /*gameModalTitle.innerText = `Choose answer`;

  gameModalBody.innerHTML = `
  <table>
  <tbody>
    <tr>
      <td colspan="2" class="fw-bold">Dafuck question how is the wow?</td>
    </tr>
    <tr>
      <td class="w-50">Answer 1</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary" data-bs-dismiss="modal" onclick="handlePoints(5)">
          A
        </button>
      </td>
    </tr>
    <tr>
      <td class="w-50">Answer 2</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary">B</button>
      </td>
    </tr>
    <tr>
      <td class="w-50">Answer 3</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary">C</button>
      </td>
    </tr>
    <tr>
      <td class="w-50">Answer 4</td>
      <td class="w-50">
        <button class="btn answer-btn btn-secondary">D</button>
      </td>
    </tr>
  </tbody>
</table>`;
  gameModalFooter.innerHTML = ``;*/
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

const handlePoints = (points) => {
  const pointsCointainer = document.querySelector(".player-points");
  //jako podminku dat spravnou odpoved
  if (true) {
    playerInfo.points += points;
    pointsCointainer.textContent = `Points: ${playerInfo.points}`;
    triggerQuestion();
  } else {
    playerInfo.points -= points;
    pointsCointainer.textContent = `Points: ${playerInfo.points}`;
    triggerQuestion();
  }
};
