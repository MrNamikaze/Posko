<?php

// Set your FHIR endpoint and credentials
$base_url = 'https://your-epic-fhir-endpoint.com'; // Ganti dengan endpoint FHIR Anda
$client_id = '306f4ad0-98f7-4ad0-9e2b-93ffeee0388f'; // Ganti dengan Client ID Anda
$client_secret = '1093B4D3E218C34D5B7E37F5148EC28C2ED22E27'; // Ganti dengan Client Secret Anda

// Function to get access token
function getAccessToken($base_url, $client_id, $client_secret) {
    $url = $base_url . '/oauth2/token';
    $data = [
        'grant_type' => 'client_credentials',
        'client_id' => $client_id,
        'client_secret' => $client_secret
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

// Function to get hospital data
function getHospitalData($base_url, $access_token) {
    $url = $base_url . '/Patient'; // Ganti dengan resource yang sesuai jika perlu

    $options = [
        'http' => [
            'header' => "Authorization: Bearer $access_token\r\n" .
                        "Accept: application/fhir+json\r\n",
            'method' => 'GET',
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

// Main logic
$token_info = getAccessToken($base_url, $client_id, $client_secret);
$access_token = $token_info['access_token'];

$hospital_data = getHospitalData($base_url, $access_token);

// Display the hospital data
echo '<pre>';
print_r($hospital_data);
echo '</pre>';
?>
