const playerInfo = {
  name: "playerName",
  points: 0,
};

const triggerQuestion = (questionText) => {
  const questionContainer = document.querySelector(".question-container");
  const questionTextHolder = document.querySelector(".question-text");
  const questionHeader = document.querySelector(".question-header");

  if (questionContainer.classList.contains("d-block")) {
    questionContainer.classList.add("d-none");
    questionContainer.classList.remove("d-block");
    //questionTextHolder.textContent = "";
    //questionHeader.textContent = "";
  } else {
    questionContainer.classList.add("d-block");
    questionContainer.classList.remove("d-none");
    //questionTextHolder.textContent = questionText;
    //questionHeader.textContent = questionText;
  }
};

const handlePoints = (points) => {
  const pointsCointainer = document.querySelector(".player-points");
  //jako podminku dat spravnou odpoved
  if (playerInfo.points < 10) {
    playerInfo.points += points;
  } else {
    playerInfo.points -= points;
  }
  pointsCointainer.textContent = `Points: ${playerInfo.points}`;
  triggerQuestion();

};
