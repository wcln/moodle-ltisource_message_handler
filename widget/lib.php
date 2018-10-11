<?php
function ltisource_widget_myCustomRequest($data) {
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
        'Widget handled',
        $data->messageid,
        $data->messagetype
    );

    echo $responsexml->asXML();
}

function ltisource_widget_get_types() {
    $types   = array();
    $types[] = (object) array(
        'modclass' => MOD_CLASS_ACTIVITY,
        'type'     => 'lti&amp;type=widget',
        'typestr'  => get_string('addwidget', 'ltisource_widget'),
        'help'     => get_string('addwidget_help', 'ltisource_widget'),
    );
    return $types;
}

function ltisource_widget_add_instance_hook() {
    // Do custom work here.
    // echo '<script>alert()</script>';
    // echo 'test';
}
