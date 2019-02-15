
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Injects two functions into consumer site which can receive messages from the consumer.
 *
 * @package    ltisource_message_handler
 * @copyright  2019 Colin Bernard {@link https://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

var messageHandlerScript = window.parent.document.createElement('script');
messageHandlerScript.type = 'text/javascript';
messageHandlerScript.innerHTML = 'monitorLtiMessages();' + ltiMessageHandler.toString() + monitorLtiMessages.toString();
window.parent.document.body.appendChild(messageHandlerScript);

/**
 * Handles incoming messages.
 * @param  {[object]} e A message event.
 */
function ltiMessageHandler(e) {

  try {
    var message = JSON.parse(e.data);
    switch (message.subject) {
      case 'lti.frameResize':
        let height = message.height;
        if (height <= 0) height = 1;

        let iframe = document.getElementById('contentframe');
        if (iframe) {
          if (typeof height === 'number') {
            height = height + 'px';
          }
          iframe.height = height;
          iframe.style.height = height;
          iframe.style.border = 'none';
        }
        break;

      case 'lti.scrollToTop':
        $('html, body').animate({
          scrollTop: $('#contentframe').offset().top
         }, 'fast');
        break;
    }
  } catch (err) {
    (console.error || console.log).call(console, 'invalid message received from');
  }
}

/**
 * Adds an event listener to the window to listen for LTI messages.
 */
function monitorLtiMessages() {
  window.addEventListener('message', function(e) {
    ltiMessageHandler(e);
  });
}
