<?php

    $secret_key = "FLWSECK-3e2d8a48e2af6a62d31fb53b07a57108-19b61e75471vt-X";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/transactions?from=2025-12-26&currency=NGN");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;

?>
