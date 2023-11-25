const handleGreet = (payload) => {
  // This should handle the connection to game lobby
  gameState["player"] = payload["player"];
  gameState["players"] = payload["allPlayers"];
};

const handleError = () => {
  // This should redirect to previous page
  // TODO make this better :D

  window.location.href = `http://${ENV_ADRESS}`;
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
