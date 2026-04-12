<?php
echo 'c'; exit;
function makeWebRequest()
{
    //URL where to send the data via POST
    $url = 'http://localhost/navicom/test3.php';

    //the actual data
    $xml = '<?xml version="1.0" encoding="UTF-8"?>' .
            '<test>' .
                'Hi there!' .
            '</test>';

    //prepare the HTTP Headers
    $content_type = 'text/xml';
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: ' . addslashes($content_type) .'\r\n'
                            . 'Content-Length: ' . strlen($xml) . '\r\n',
            'content' => $xml,
        ),
    );
    $context  = stream_context_create($options);

    /*send the data using a cURL-less method*/
    $result = file_get_contents($url, false, $context);
    echo 'file_get_contents<br/>';
    var_dump($result);
}

//call the function
makeWebRequest(); 


?>