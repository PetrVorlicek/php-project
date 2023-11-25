// Websocket Connection
document.addEventListener("DOMContentLoaded", (event) => {
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
});
