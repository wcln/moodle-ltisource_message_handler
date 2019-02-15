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
 * @copyright  2019 Colin Bernard {@link https://wcln.ca}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


/**
 * Implementation of before_launch callback. (https://docs.moodle.org/dev/Callbacks)
 *
 * Injects a script to launch.php which writes an LTI message handler script
 * to view.php.
 *
 * The message handler script (js/message_handler.js) accepts messages from within an LTI
 * iframe and allows resizing the iframe and other functionality.
 *
 * Parameters are not used, but could be used to modify the function to only output the script
 * for certain conditions.
 *
 * @param  string $instance
 * @param  string $endpoint
 * @param  array $requestparams
 */
function ltisource_message_handler_before_launch($instance, $endpoint, $requestparams) {
  echo '<script>'.file_get_contents('source/message_handler/js/script_injector.js').'</script>';
}
