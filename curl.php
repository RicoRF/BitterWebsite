<?php

$postalCode = "e3a0f0";
$postalCode = str_replace(' ', '+', $postalCode);

$ch = curl_init("http://localhost/bitter/includes/Fedex/ValidatePostalCodeService/ValidatePostalCodeWebServiceClient.php?postalCode=".$postalCode."");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if(curl_error($ch)) {
    echo 'Error: '. curl_error($ch);
}
curl_close($ch);

echo $response;

?>