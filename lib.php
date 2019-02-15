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
 * Internal library for WCLN LTI Source Plugin.
 *
 * @package    ltisource_message_handler
 * @copyright  2019 Colin Bernard {@link http://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/*
 * Called before LTI content is launched.
 * Outputs a script to the LTI iFrame which outputs another script to the parent window.
 * The final outputted script will be used to receive messages from within the iFrame and will affect elements outside the iFrame.
 * The purpose of this function is to circumvent cross origin policies.
 */
function ltisource_message_handler_before_launch($instance, $endpoint, $requestparams) {
  global $CFG;
  echo '<script>'.file_get_contents("$CFG->wwwroot/mod/lti/source/message_handler/js/message_handler.js").'</script>';
}
