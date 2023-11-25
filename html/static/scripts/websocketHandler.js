// Websocket Connection

const conn = new WebSocket(`ws://${ENV_ADRESS}:8081`);
conn.onopen = function (msg) {
  /*TODO remove*/
};

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
