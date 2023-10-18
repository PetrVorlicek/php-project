const triggerQuestion = (questionText, answerText) => {
  const questionContainer = document.querySelector(".question-container");
  const questionTextHolder = document.querySelector(".question-text");
  const answerTextHolder = document.querySelector(".answer-text");

  if (questionContainer.classList.contains("d-block")) {
    questionContainer.classList.add("d-none");
    questionContainer.classList.remove("d-block");
    questionTextHolder.textContent = "";
    answerTextHolder.textContent = "";
  } else {
    questionContainer.classList.add("d-block");
    questionContainer.classList.remove("d-none");
    questionTextHolder.textContent = questionText;
    answerTextHolder.textContent = answerText;
  }
};
