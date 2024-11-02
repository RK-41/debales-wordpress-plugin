import React from "react";
import ReactDOM from "react-dom/client";
import { Chatbot } from "@debales-ai/ai-assistant";
import 'swiper/css';
import 'swiper/css/navigation';

(function () {
  const element = document.getElementById("debales-ai-assistant");
  if (!element) {
    console.error("Could not find element with id 'debales-ai-assistant'");
    return;
  }

  // find the botId in the element's data-bot-id attribute
  const botId = element.getAttribute("data-bot-id");
  if (!botId) {
    console.error(
      "Could not find botId in element with id 'debales-ai-assistant'"
    );
    return;
  }
  // find the botId in the element's bot-name attribute
  const botName = element.getAttribute("data-bot-name");
  const botNameColor = element.getAttribute("data-bot-name-color");

  ReactDOM.createRoot(element).render(
    <React.StrictMode>
      <Chatbot
        botId={botId}
        botName={botName || undefined}
        botNameColor={botNameColor || undefined}
      />
      
    </React.StrictMode>
  );
})();
