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

  // Add the event listener.
  monitorLtiMessages();

  /**
   * Handles incoming messages.
   * @param  {object} e A message event.
   */
  function ltiMessageHandler(e) {

    // Parse the message into an object.
    var message = JSON.parse(e.data);

    // Retrieve the LTI iframe.
    var iframe = document.getElementById('contentframe');

    switch (message.subject) {

      // Update the height of the iframe.
      case 'lti.frameResize':
        var height = message.height;
        if (height <= 0) {
          height = 1;
        }
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
  }

  /**
   * Adds an event listener to the window to listen for LTI messages.
   */
  function monitorLtiMessages() {

    // Listen for all messages to this window.
    window.addEventListener('message', function(e) {

      var iframe = $('#contentframe')[0];

      // Check if the incoming message is from the LTI iframe.
      if (iframe.contentWindow === e.source) {

        // Handle the message.
        ltiMessageHandler(e);
      }
    });
  }
});
