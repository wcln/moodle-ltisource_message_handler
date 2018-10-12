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

function ltisource_wcln_myCustomRequest($data) {
    $data->body;         // The raw LTI request XML body.
    $data->xml;          // A SimpleXMLElement of the XML body.
    $data->messageid;    // The value of the <imsx_messageIdentifier> element in the request.
    $data->messagetype;  // The message type.
    $data->consumerkey;  // OAuth consumer key.
    $data->sharedsecret; // The shared secret used to verify the request body.

    // Do your custom work here.

    // Throw exceptions on error, they will be sent back appropriately.

    // When done, echo out your response XML.
    $responsexml = lti_get_response_xml(
        'success',
        'wcln handled',
        $data->messageid,
        $data->messagetype
    );

    echo $responsexml->asXML();
}

function ltisource_wcln_get_types() {
    $types   = array();
    $types[] = (object) array(
        'modclass' => MOD_CLASS_ACTIVITY,
        'type'     => 'lti&amp;type=wcln',
        'typestr'  => get_string('addwcln', 'ltisource_wcln'),
        'help'     => get_string('addwcln_help', 'ltisource_wcln'),
    );
    return $types;
}

function ltisource_wcln_add_instance_hook() {
    // Do custom work here.
    // echo '<script>alert()</script>';
    // echo 'test';
}

function ltisource_wcln_before_launch() {
  echo '<script>
      var script = window.parent.document.createElement("script");
      script.type = "text/JavaScript";
      script.innerHTML = \'\' +
      \'document.getElementById("contentframe").style.border = "none";\' +
      \'window.addEventListener("message", function(event) {\' +
        \'document.getElementById("contentframe").height=event.data;\' +
        \'document.getElementById("contentframe").style.height=event.data +"px";\' +
        \'window.document.body.scrollTop = window.document.documentElement.scrollTop = 0;\' +
      \'});\';
      window.parent.document.body.appendChild(script);
    </script>';
}
