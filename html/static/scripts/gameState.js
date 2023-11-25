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
