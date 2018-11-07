<?php
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
 * Version details.
 *
 * @package    ltisource_wcln
 * @copyright  2018 Colin Bernard {@link http://bclearningnetwork.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Set to the current endpoint of the WCLN LTI provider.
define('WCLN_ENDPOINT', 'https://bclearningnetwork.com/local/LTI/request.php');

/*
 * Called before LTI content is launched.
 * Outputs a script to the LTI iFrame which outputs another script to the parent window.
 * The final outputted script will be used to receive messages from within the iFrame and will affect elements outside the iFrame.
 * The purpose of this function is to circumvent cross origin policies.
 */
function ltisource_wcln_before_launch($instance, $endpoint, $requestparams) {

  // Only output the script and change the iFrame if the endpoint is going to WCLN.
  // We don't want to affect other LTI content.
  if ($endpoint == constant('WCLN_ENDPOINT')) {
    echo '<script>
        var script = window.parent.document.createElement("script");
        script.type = "text/JavaScript";
        script.innerHTML = \'\' +
        \'var iframe = document.getElementById("contentframe");\' +
        \'iframe.style.border = "none";\' +
        \'iframe.setAttribute("scrolling", "no");\' +
        \'window.addEventListener("message", resizeIframe);\' +
        \'function resizeIframe() {\' +
          \'document.getElementById("contentframe").height=event.data;\' +
          \'document.getElementById("contentframe").style.height=event.data +"px";\' +
          \'window.document.body.scrollTop = window.document.documentElement.scrollTop = 0;\' +
        \'}\';
        window.parent.document.body.appendChild(script);
      </script>';
  }
}
