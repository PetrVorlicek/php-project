const playerInfo = {
  name: "playerName",
  points: 0,
};

const triggerQuestion = () => {
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