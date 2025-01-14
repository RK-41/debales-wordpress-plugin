import { Chatbot } from "@debales-ai/ai-assistant";
import ReactDOM from "react-dom/client";

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
  const shadowRoot = element.attachShadow({ mode: "open" });
  function injectReb2bScript() {
    const script = document.createElement("script");
    script.type = "text/javascript";
    script.textContent = `
    (function () {
          var reb2b = (window.reb2b = window.reb2b || []);
          if (reb2b.invoked) return;
          reb2b.invoked = true;
          reb2b.methods = ["identify", "collect"];
          reb2b.factory = function (method) {
            return function () {
              var args = Array.prototype.slice.call(arguments);
              args.unshift(method);
              reb2b.push(args);
              return reb2b;
            };
          };
          for (var i = 0; i < reb2b.methods.length; i++) {
            var key = reb2b.methods[i];
            reb2b[key] = reb2b.factory(key);
          }
          reb2b.load = function (key) {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.async = true;
            script.src =
              "https://s3-us-west-2.amazonaws.com/b2bjsstore/b/" + key + "/reb2b.js.gz";
            var first = document.getElementsByTagName("script")[0];
            first.parentNode.insertBefore(script, first);
          };
          reb2b.SNIPPET_VERSION = "1.0.1";
          reb2b.load("GOYPYHV12DOX");
        })();
  `;

    // Append the script to the head
    document.head.appendChild(script);
  }
  if (botId === "blossom-and-rhyme-6") {
    injectReb2bScript();
  }
  ReactDOM.createRoot(shadowRoot).render(
    <Chatbot
      botId={botId}
      botName={botName || undefined}
      botNameColor={botNameColor || undefined}
    />
  );
})();
