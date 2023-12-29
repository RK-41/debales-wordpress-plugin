<?php
/*
 * Plugin Name:       Debales Chatbot
 * Plugin URI:        https://debales.ai/
 * Description:       This plugin will help you to integrate Debales Chatbot in your website.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Debales AI
 * Author URI:        https://debales.ai/
 * License:           Custom
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://debales.ai/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

define('chatbox_api', 'https://saas.brainlox.com');
$api_key = get_option('debales_chatbot_bot_id');

define('api_key', $api_key);


function debales_chatbot_settings_page()
{
    add_options_page(
        'Debales Chatbot Settings',
        'Debales Chatbot',
        'manage_options',
        'debales-chatbot-settings',
        'debales_chatbot_settings_form'
    );
}
add_action('admin_menu', 'debales_chatbot_settings_page');

function debales_chatbot_settings_form()
{
?>
    <div class="wrap">
        <h2>Custom Chatbot Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('debales-chatbot-settings-group'); ?>
            <?php do_settings_sections('debales-chatbot-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">BOT ID</th>
                    <td>
                        <input type="text" name="debales_chatbot_bot_id" value="<?php echo esc_attr(get_option('debales_chatbot_bot_id')); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function debales_chatbot_register_settings()
{
    register_setting(
        'debales-chatbot-settings-group',
        'debales_chatbot_bot_id'
    );
}
add_action('admin_init', 'debales_chatbot_register_settings');


function addchatbotinfooter()
{

    if (api_key != '') {

    ?>
        <style>
            .frame-content {
                display: block;
                border: none;
                position: fixed;
                inset: auto 0px 0px auto;
                /* width: 450px; */
                height: 647px;
                max-height: 100%;
                opacity: 1;
                color-scheme: none;
                background: none transparent !important;
                margin: 0px;
                max-width: 100vw;
                transform: translateY(0px);
                transition: none 0s ease 0s !important;
                visibility: visible;
                z-index: 999999999 !important;
            }

            #debales-chat-button {
                position: fixed;
                width: 112px;
                height: 140px;
                bottom: 12px;
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                pointer-events: none;
                z-index: 1;
                right: 0px;
            }

            #debales-chat-button:not(.sidebar) .buttonWave {
                position: absolute;
                z-index: -1;
                width: 60px;
                height: 60px;
            }

            #debales-chat-button:not(.sidebar).clicked .buttonWave::after {
                animation: 0.5s ease-out 0s 1 normal none running buttonWave;
            }


            #button-body {
                display: inherit;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                justify-content: center;
                pointer-events: initial;
                position: relative;
                background-color: transparent;
                border: none;
            }

            button#debalesSentButton {
                background-color: transparent;
            }

            #debales-chat-button img {
                width: 80px;
            }

            #debales-chat-button button i.for-closed.active {
                transform: translateX(0px);
            }

            #debales-chat-button button i.for-closed {
                transform: translateX(-10px);
            }

            #debales-chat-button button i.active {
                opacity: 1;
            }

            #debales-chat-button button i {
                height: 26px;
                width: 26px;
                position: absolute;
                opacity: 0;
                transition: all 0.2s ease-in-out 0s;
                display: flex;
                -webkit-box-align: center;
                align-items: center;
                -webkit-box-pack: center;
                /* justify-content: center; */
            }

            i {
                user-select: none;
            }

            #debales-chat-button button i.type1 svg {
                fill: currentcolor;
            }

            svg {
                width: 24px;
                height: 24px;
            }

            #debales-chat-button button i.type1::after {
                content: "";
                position: absolute;
                width: 68px;
                height: 68px;
                border-radius: 32px;
                background: rgb(255, 255, 255);
                transition: all 0.2s ease-in-out 0s;
                transform: scale(0);
                right: -18px;
            }

            #debales-chat-button button i.for-closed.active {
                transform: translateX(0px);
            }

            .message.message-operator.bots-quick-replies {
                display: none;
            }

            #debales-chat-button button i.for-closed {
                transform: translateX(-10px);
            }

            #debales-chat-button button i.type2 {
                width: 32px;
                height: 32px;
            }

            #button button i.type1.for-opened {
                width: 31px;
                height: 28px;
            }

            #debales-chat-button button i.for-opened {
                transform: translateX(10px);
            }

            button,
            button.material-icons {
                background: none;
                border: 0px;
                color: inherit;
                font-style: inherit;
                font-variant: inherit;
                font-weight: inherit;
                font-stretch: inherit;
                font-size: inherit;
                font-family: inherit;
                line-height: normal;
                overflow: visible;
                padding: 0px;
                user-select: none;
                outline: none;
                cursor: pointer;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }


            #debales-chat-button button i.type2 svg {
                width: 32px;
                height: 32px;
                fill: rgb(0, 125, 252);
                transform: scale(0);
            }

            svg:not(:root) {
                overflow-clip-margin: content-box;
                overflow: hidden;
            }

            body:not(.mobile) #button button:not(.disabled):hover i.type1 svg,
            body:not(.mobile) #button button:not(.disabled):focus i.type1 svg {
                transform: scale(1.4);
            }

            body:not(.mobile) #button button:not(.disabled):hover i.type1::after,
            body:not(.mobile) #button button:not(.disabled):focus i.type1::after {
                transform: scale(1);
            }

            #debales-chat-button button i.for-closed.active {
                transform: translateX(0px);
            }

            .chat.chrome,
            .start-group.chrome {
                box-shadow: rgba(0, 18, 46, 0.16) 0px 8px 36px 0px;
            }

            .chat {
                max-height: calc(100% - 47px);
                display: flex;
                flex-direction: column;
            }

            .debalesAiBotText.dealbottyping {
                max-width: 100%;
            }

            .chat,
            .start-group {
                width: 400px;
                position: fixed;
                bottom: 26px;
                pointer-events: auto;
                box-shadow: rgba(0, 18, 46, 0.16) 0px 8px 22px 0px;
                overflow: hidden;
                z-index: 999;
                right: 0px;
                left: auto;
                background-color: white;
            }

            .message-operator.bots-quick-replies {
                width: 85%;
                background-color: rgb(255, 255, 255);
                margin-top: 0px;
                float: right;
            }

            .message-operator.bots-quick-replies .button-wrapper {
                margin-top: 0px;
                display: flex;
                flex-wrap: wrap;
                -webkit-box-pack: end;
                justify-content: flex-end;
                width: 100%;
                border: none;
            }

            .message-operator img {
                object-fit: cover;
                width: 38px;
                height: 38px;
            }


            .message {
                padding: 20px;
                border-radius: 0px;
                margin: 0px;
                font-size: 15px;
                line-height: 20px;
                overflow-wrap: break-word;
                display: inline-block;
                max-width: 100%;
                clear: both;
                position: relative;
                transition: margin 0.28s ease-in-out 0s;
            }

            .input-group {
                padding: 0px 27px 0px;
                position: relative;
                background: rgb(255, 255, 255);
                z-index: 3;
                flex: 0 0 auto;
                border-radius: 8px;
                margin-top: 14px;
            }

            .input-group .footer-input-wrapper,
            .input-group .footer-icons-wrapper {
                transition: all 0.5s ease-in-out 0s;
                opacity: 1;
                transform: translateY(0px);
            }

            textarea {
                border: 0px;
                width: 100%;
                font-size: 17px;
                margin: 12px 0px 12px;
                resize: none;
                line-height: 24px;
                overflow: hidden;
                -webkit-box-flex: 1;
                -ms-flex: 1 0 0px;
                flex: 1 0 0;
            }

            .debales-send-icon {
                width: 26px;
                height: 26px;
                -webkit-box-flex: 0;
                -ms-flex: 0 0 26px;
                flex: 0 0 26px;
                -webkit-backface-visibility: hidden;
                -webkit-transition: all .3s;
                transition: all .3s;
                cursor: pointer !important;
                padding: 0 !important;
                border-width: 0 !important
            }

            hr {
                margin: 0px;
                border-width: 0px 0px 1px;
                border-top-style: initial;
                border-right-style: initial;
                border-left-style: initial;
                border-top-color: initial;
                border-right-color: initial;
                border-left-color: initial;
                border-image: initial;
                border-bottom-style: solid;
                border-bottom-color: rgb(219, 223, 230);
            }

            #debales-conversation-group {
                padding: 0px 0px;
                height: 357px;
                overflow: hidden auto;
                background: rgb(255, 255, 255);
                transition: all 0.3s ease 0s;
                max-height: 357px;
                min-height: 160px;
                flex: 0 1 auto;
                border-radius: 8px;
            }

            .message-operator.bots-quick-replies button {
                font-size: 15px;
                padding: 8px 16px;
                border: 1px solid;
                border-radius: 20px;
                margin: 3px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                min-width: inherit;
            }

            .offline-message span.online::before {
                content: "";
                display: block;
                width: 8px;
                height: 8px;
                position: absolute;
                top: calc(50% - 4px);
                background: rgb(88, 183, 67);
                border-radius: 50%;
                left: 0px;
            }

            .no-clip-path .offline-message {
                padding: 14px 28px 20px;
            }

            .offline-message span {
                z-index: 2;
                position: relative;
                display: inline-block;
                font-size: 16px;
            }

            .message-operator.message-with-buttons .button-wrapper,
            .message-operator .message-with-buttons .button-wrapper,
            .message-operator.bots-quick-replies .button-wrapper {
                background: rgb(255, 255, 255);
                width: 100%;
                margin-top: 10px;
                /* border-width: 0px 1px 1px;
                border-right-style: solid;
                border-bottom-style: solid;
                border-left-style: solid;
                border-right-color: rgb(235, 238, 240);
                border-bottom-color: rgb(235, 238, 240);
                border-left-color: rgb(235, 238, 240);*/
                border-image: initial;
                border-bottom-left-radius: 20px;
                border-bottom-right-radius: 20px;
                border-top-style: initial;
                border-top-color: initial;
                position: relative;
            }

            #debales-chat-button button i.for-opened.active {
                transform: translateX(0px);
            }

            .message-operator.bots-quick-replies .sent {
                font-size: 15px;
                padding: 8px 16px;
                border: none;
                border-radius: 20px;
                margin: 3px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                min-width: inherit;
            }

            .message-operator.message-with-buttons .sent,
            .message-operator .message-with-buttons .sent,
            .message-operator.bots-quick-replies .sent {
                margin: 0px auto;
                min-width: 100%;
                display: block;
                font-size: 16px;
                line-height: 19px;
                padding: 8px 16px;
                color: rgb(0, 125, 252);
                background: #f2f9ff;
                position: relative;
                z-index: 2;
                outline: none;
                border-radius: 20px;
                font-weight: normal;
            }


            .chat-header {
                padding: 1px 30px 36px;
                position: relative;
                z-index: 4;
                flex: 0 0 auto;
                background-color: #9CA67F;
                text-align: center;
            }

            .avatars-wrapper {
                width: 52px;
                height: 52px;
                margin: 0px 18px 0px 0px;
                float: left;
            }

            .chat h2.oneline {
                margin-top: 0px;
                line-height: 52px;
                min-height: 52px;
                margin-bottom: 10px;
            }

            .chat h2 {
                font-size: 19px;
                font-weight: bold;
                color: currentcolor;
                margin: 4px 0px 0px;
                padding: 0px;
                display: inline-block;
                position: relative;
                max-width: bold;
                text-overflow: ellipsis;
                overflow: hidden;
                vertical-align: bottom;
                text-align: center;

            }

            .chat h2 .emoji {
                width: 31px;
                height: 31px;
            }

            button.material-icons.exit-chat,
            label.material-icons.exit-chat {
                margin-right: -3px;
            }

            button.material-icons.options,
            button.material-icons.exit-chat,
            label.material-icons.options,
            label.material-icons.exit-chat {
                z-index: unset;
            }

            button.material-icons,
            label.material-icons {
                position: relative;
                z-index: 1;
                margin: 15px 0px 8px 11px;
                float: right;
            }

            button.material-icons.options::before,
            button.material-icons.exit-chat::before,
            label.material-icons.options::before,
            label.material-icons.exit-chat::before {
                background: rgba(0, 36, 92, 0.16);
            }

            button.material-icons::before,
            label.material-icons::before {
                content: "";
                position: absolute;
                background: rgb(239, 242, 246);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                z-index: -1;
                transition: all 0.16s ease-in-out 0s;
                transform: scale(0);
                top: calc(50% - 20px);
                left: calc(50% - 20px);
            }

            button.material-icons svg#ic-minimize,
            button.material-icons svg.options-icon,
            label.material-icons svg#ic-minimize,
            label.material-icons svg.options-icon {
                fill: currentcolor;
            }


            element.style {}

            .tidio-1s5t5ku span {
                background: rgb(255, 255, 255);
                padding: 6px 8px;
                border-radius: 2px;
                box-shadow: rgba(0, 18, 46, 0.32) 0px 2px 8px 0px;
                font-size: 13px;
                position: absolute;
                opacity: 0;
                pointer-events: none;
                white-space: nowrap;
                transition: all 0.16s ease-in-out 0s;
                z-index: 1;
                right: calc(100% + 10px);
                top: 50%;
                transform: translate(5px, -50%);
                color: rgb(6, 19, 43);
            }

            .debalesAiSentText:before {
                content: '';
                background-image: url('<?php echo plugin_dir_url(__DIR__); ?>debales-chatbot/reply.png');
                width: 32px;
                height: 32px;
                display: block;
                background-repeat: no-repeat;
                position: absolute;
                background-size: contain;
                left: 23px;
                top: 19px;
            }

            .offline-message {
                margin: 18px -28px 0px;
                color: currentcolor;
                width: calc(100% + 56px);
                padding: 14px 28px 7px;
                position: relative;
                background-size: 100% calc(100% + 12px);
                z-index: 1;
            }

            .no-clip-path .offline-message {
                padding: 14px 28px 20px;
            }

            .offline-message span.online {
                padding-left: 20px;
            }

            .no-clip-path .offline-message::after {
                content: "";
                position: absolute;
                width: calc(100% + 10px);
                bottom: -8px;
                left: -5px;
                border-image-source: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzNzIgMTUiPgogIDxwYXRoIGQ9Ik0zNDkuOCAxLjRDMzM0LjUuNCAzMTguNSAwIDMwMiAwaC0yLjVjLTkuMSAwLTE4LjQuMS0yNy44LjQtMzQuNSAxLTY4LjMgMy0xMDIuMyA0LjctMTQgLjUtMjggMS4yLTQxLjUgMS42Qzg0IDcuNyA0MS42IDUuMyAwIDIuMnY4LjRjNDEuNiAzIDg0IDUuMyAxMjguMiA0LjEgMTMuNS0uNCAyNy41LTEuMSA0MS41LTEuNiAzMy45LTEuNyA2Ny44LTMuNiAxMDIuMy00LjcgOS40LS4zIDE4LjctLjQgMjcuOC0uNGgyLjVjMTYuNSAwIDMyLjQuNCA0Ny44IDEuNCA4LjQuMyAxNS42LjcgMjIgMS4yVjIuMmMtNi41LS41LTEzLjgtLjUtMjIuMy0uOHoiIGZpbGw9IiNmZmYiLz4KPC9zdmc+Cg==);
                border-image-slice: 0 0 100%;
                border-image-width: 0 0 15px;
                border-image-repeat: stretch;
                border-width: 0px 0px 15px;
                border-bottom-style: solid;
                border-color: initial;
                border-top-style: initial;
                border-left-style: initial;
                border-right-style: initial;
            }

            .input-group .footer-input-wrapper,
            .input-group .footer-icons-wrapper {
                transition: all 0.5s ease-in-out 0s;
                opacity: 1;
                transform: translateY(0px);
            }

            .debales-send-icon:hover svg path {
                fill: #9ca67f;
            }

            .message-operator {
                color: rgb(6, 19, 43);
                background: rgb(240, 242, 247);
                float: left;
                display: flex;
                width: auto;
                text-align: left
            }

            .message span.message-content {
                white-space: pre-line;
                margin: 4px 10px !important;
            }

            #debales-chatContainer {
                transition: all 0.3s ease-in-out;
                right: -300px;

            }

            .onlyBubble {
                display: none;
                transition: all 0.3s ease-in-out;
            }

            .open {
                display: block;
                transition: all 0.3s ease-in-out;
            }

            #debales-chatContainer.open {
                right: 0;
            }

            .footer-input-wrapper {
                width: 100%;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }

            .debales-send-icon path {
                fill: grey;
            }

            .clicked {
                display: none !important;
            }

            #button:not(.sidebar).clicked .buttonWave::after {
                animation: 0.5s ease-out 0s 1 normal none running buttonWave;
            }

            #button:not(.sidebar) .buttonWave::after {
                content: "";
                position: absolute;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background-color: rgb(20, 127, 255);
                opacity: 0.5;
            }

            .debalesAiSentText {
                display: block;
                font-size: 16px;
                padding: 20px 20px 20px 70px;
                color: #000;
                background: #ffffff;
                z-index: 2;
                outline: none;
                border-radius: 0;
                font-weight: normal;
                text-align: left;
                position: relative;
                width: 333px;
                float: left;
                /* max-width:100%; */
                word-break: break-word;
                /* min-height: 67px; */
            }

            button:focus {
                outline: 0px !important;
            }

            textarea#debales-chat-input:focus-visible {
                outline: none;
            }

            .debalesAiBotText {
                color: rgb(6, 19, 43);
                background: rgb(240, 242, 247);
                padding: 20px 20px 20px 70px;
                border-radius: 0;
                margin: 0px 0px;
                font-size: 15px;
                line-height: 20px;
                overflow-wrap: break-word;
                transition: margin 0.28s ease-in-out 0s;
                text-align: left;
                position: relative;
                width: 333px;
                float: left;
                max-width: 100%;
            }

            .chat-header ::-webkit-scrollbar {
                width: 6px;
            }

            .chat-header ::-webkit-scrollbar-thumb {
                background: #808080ba;
            }

            button#debales-minimize-button {
                background-color: transparent;
                transform: rotate(180deg);
                margin: 13px 0;
            }

            #debales-minimize-button svg {
                width: 17px;
                height: 24px;
            }

            .debalesAiBotText:before {
                content: '';
                background-image: url('<?php echo plugin_dir_url(__DIR__); ?>debales-chatbot/messege.png');
                width: 38px;
                height: 38px;
                display: block;
                background-repeat: no-repeat;
                position: absolute;
                background-size: contain;
                left: 22px;
                top: 16px;
            }

            .debalesAiBotText.dealbottyping:before {
                content: '';
                width: 0 !important;
                height: 0 !important;
            }

            .svgsent svg path {
                fill: grey;
            }




            div.chatbolltyping {
                margin: 0px;
                padding: 2px;
            }

            div.chatbolltyping span {
                width: 10px;
                height: 10px;
                background-color: #9ca67f;
                display: inline-block;
                margin: 1px;
                border-radius: 50%;
            }

            div.chatbolltyping span:nth-child(1) {
                animation: bounce 1s infinite;
            }

            div.chatbolltyping span:nth-child(2) {
                animation: bounce 1s infinite 0.2s;
            }

            div.chatbolltyping span:nth-child(3) {
                animation: bounce 1s infinite 0.4s;
            }

            @keyframes bounce {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(8px);
                }

                100% {
                    transform: translateY(0px);
                }
            }
        </style>
        <!---Chat Board Start-->
        <div class="chat-board chatbot chat new trending"></div>
        <div class="frame-content">
            <div class="widget-position-right sidebar-position-right onlyBubble" id="debales-chatContainer">

                <div class="chat no-clip-path chrome moveFromRight-enter-done">
                    <div class="chat-header project-online" style="color: rgb(255, 255, 255);">
                        <h2 class="oneline"><span>Chat with Bloom</span></h2>
                        <button class="material-icons exit-chat ripple tidio-1s5t5ku" id="debales-minimize-button" type="button" aria-label="Minimize" style="color: rgb(255, 255, 255);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <span>Minimize</span>
                        </button>
                        <div id="debales-conversation-group" role="log">
                            <div id="debalesAiMessages" aria-live="polite" aria-atomic="false" data-testid="messagesLog">
                                <div class="message message-operator">
                                    <img src="<?php echo plugin_dir_url(__DIR__); ?>debales-chatbot/messege.png">
                                    <span class="message-content">Hi, I am Bloom, how can I help you today?</span>
                                </div>
                                <div class="message message-operator bots-quick-replies">
                                    <div class="button-wrapper">

                                    </div>
                                </div>
                            </div>
                            <div id="debales-ai-conversation-scroll">
                                <div style="top: 0px; height: 55.8952px;"></div>
                            </div>
                        </div>
                        <div class="input-group ">
                            <hr>
                            <div class="drag-active-wrapper footer-input-wrapper">
                                <textarea id="debales-chat-input" rows="1" placeholder="Ask me anything" aria-label="New message" data-testid="newMessageTextarea"></textarea>

                                <button id="debalesSentButton" class="debales-send-icon" title="debalesSentButton" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve">
                                        <path fill="#d7d7d7" d="M22,11.7V12h-0.1c-0.1,1-17.7,9.5-18.8,9.1c-1.1-0.4,2.4-6.7,3-7.5C6.8,12.9,17.1,12,17.1,12H17c0,0,0-0.2,0-0.2c0,0,0,0,0,0c0-0.4-10.2-1-10.8-1.7c-0.6-0.7-4-7.1-3-7.5C4.3,2.1,22,10.5,22,11.7z"></path>
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="debales-chat-button" data-testid="widgetButton" class="chat-closed mobile-size__medium">
                <div class="buttonWave"></div>
                <button type="button" id="button-body" data-testid="widgetButtonBody" class="chrome" tabindex="0" aria-label="Open chat widget">
                    <img src="<?php echo plugin_dir_url(__DIR__); ?>debales-chatbot/messege.png">

                </button>
            </div>
        </div>

        <!---Chat Board End-->
        <script>
            const chatButton = document.getElementById("debales-chat-button");
            const chatContainer = document.getElementById("debales-chatContainer");
            const minimizeButton = document.getElementById("debales-minimize-button");
            const chatInput = document.getElementById("debales-chat-input");
            const chatMessages = document.getElementById("debales-conversation-group");
            const sendButton = document.getElementById("debalesSentButton");

            function chatTakeinput() {
                const message = chatInput.value;
                chatInput.value = "";

                let newMessage = document.createElement("div");
                newMessage.classList.add("debalesAiSentText");
                newMessage.textContent = message;
                chatMessages.appendChild(newMessage);

                newMessage.scrollIntoView();
                sendButton.classList.add("svgsent");

                let BotnewMessage = document.createElement("div");
                BotnewMessage.classList.add("debalesAiBotText");
                BotnewMessage.classList.add("dealbottyping");

                BotnewMessage.innerHTML = `<div class="chatbolltyping"><span></span><span></span><span></span></div>`;
                chatMessages.appendChild(BotnewMessage);

                setTimeout(function() {
                    var botresmessage = getResponseFromServer(message);

                    console.log(botresmessage);
                    document.querySelector(".dealbottyping").remove();
                    if (botresmessage == '') {
                        botresmessage = "I am facing some network issues. Can you please check your network and try again?";
                    }

                    let BotMessage = document.createElement("div");
                    BotMessage.classList.add("debalesAiBotText");
                    BotMessage.innerHTML = botresmessage;
                    chatMessages.appendChild(BotMessage);

                }, 500);
            }

            function getResponseFromServer(question) {
                var result = "";
                //var question=question;
                var session_ID = localStorage.getItem('debalesSessionID') || ""; // Use localStorage
                jQuery.ajax({
                    url: '<?php echo chatbox_api ?>/api/wordpress/ChatWithBot',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/json'
                    },
                    method: 'POST',
                    dataType: 'json',
                    async: false,
                    data: JSON.stringify({
                        "userMessage": question,
                        "sessionId": session_ID,
                        "nameSpace": "<?php echo api_key; ?>"
                    }),
                    success: function(res) {
                        console.log(res);
                        if (res.response != '') {
                            result = res.response;
                            localStorage.setItem("debalesSessionID", res.sessionId);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        //alert("some error");
                    }

                });
                console.log(result);
                //alert(result);
                return result;

            }

            if (chatButton) {
                chatButton.addEventListener("click", function() {
                    if (chatContainer) {
                        chatContainer.classList.add("open");
                        chatButton.classList.add("clicked");
                    }
                });
            }

            if (minimizeButton) {
                minimizeButton.addEventListener("click", function() {
                    if (chatContainer) {
                        chatContainer.classList.remove("open");
                        chatButton.classList.remove("clicked");
                    }
                });
            }

            if(chatInput){
                chatInput.addEventListener("input", function(event) {
                    if (event.target.value) {
                        sendButton.classList.add("svgsent");
                    } else {
                        sendButton.classList.remove("svgsent");
                    }
                });

                chatInput.addEventListener("keypress", function(event) {
                    if (event.keyCode === 13) {
                        chatTakeinput();
                    }
                });
            }

            if (sendButton) {
                sendButton.addEventListener("click", function() {
                    chatTakeinput();
                });
            }

            // delete session before unload
            window.addEventListener("beforeunload", function() {
                localStorage.removeItem("debalesSessionID");
            });
        </script>
<?php
    }
}


add_action('wp_footer', 'addchatbotinfooter');


?>