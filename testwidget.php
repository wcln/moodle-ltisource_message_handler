<?php

$url = 'https://bclearningnetwork.com/mod/lti/service.php';
$data =
  '<?xml version="1.0" encoding="UTF-8"?>
  <imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
      <imsx_POXHeader>
          <imsx_POXRequestHeaderInfo>
              <imsx_version>V1.0</imsx_version>
              <imsx_messageIdentifier>999998123</imsx_messageIdentifier>
          </imsx_POXRequestHeaderInfo>
      </imsx_POXHeader>
      <imsx_POXBody>
          <myCustomRequest><!-- LOOK HERE! -->
              <myRecord><!-- This can be named whatever you want -->
                  <sourcedGUID>
                      <sourcedId>3124567</sourcedId>
                  </sourcedGUID>
                  <!-- You custom data in XML format -->
              </myRecord>
          </myCustomRequest>
      </imsx_POXBody>
  </imsx_POXEnvelopeRequest>';

$options = array(
  'http' => array(
    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
    'method' => 'POST',
    'content' => $data
  )
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === false) { /* Handle error */ }

var_dump($result);
