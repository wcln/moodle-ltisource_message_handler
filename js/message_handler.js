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
 * Contains functions which listen for incoming messages from an LTI provider.
 *
 * @package    ltisource_message_handler
 * @copyright  2019 Colin Bernard {@link https://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require(['jquery'], function($) {

  monitorLtiMessages();

  /**
   * Handles incoming messages.
   * @param  {object} e A message event.
   */
  function ltiMessageHandler(e) {

    try {
      let message = JSON.parse(e.data);
      let iframe = document.getElementById('contentframe');

      switch (message.subject) {

        // Update the height of the iframe.
        case 'lti.frameResize':
          let height = message.height;
          if (height <= 0) height = 1;

          if (iframe) {
            if (typeof height === 'number') {
              height = height + 'px';
            }
            iframe.height = height;
            iframe.style.height = height;
          }
          break;

        // Scroll to the top of the iframe.
        case 'lti.scrollToTop':
          $('html, body').animate({
            scrollTop: $('#contentframe').offset().top
           }, 'fast');
          break;

        // Remove the iframe border.
        case 'lti.removeBorder':
          if (iframe) {
            iframe.style.border = 'none';
          }
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
      console.log(e);
      ltiMessageHandler(e);
    });
  }
});
