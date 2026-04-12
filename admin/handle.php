<?php

if (isset($_POST['fileName']) && $_POST['fileData'])
{ echo 'v'; exit;
    // Save uploaded file
    $uploadDir = 'movie/';
    file_put_contents(
        $uploadDir. $_POST['fileName'],
        base64_decode($_POST['fileData'])
    );

    // Done
    echo "Success";
}

//$encoded_file = $_POST['file'];
//$decoded_file = base64_decode($encoded_file);
/* Now you can copy the uploaded file to your server. */
//file_put_contents('a.mp4', $decoded_file);

?>
