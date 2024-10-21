<?php
// Initialize a cURL session
require_once("koneksi.php");
$ch = curl_init();

// Set the URL for the FHIR server endpoint
$url = "https://r4.smarthealthit.org/Organization";

// Set the options for the cURL session
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/fhir+json"
]);

// Execute the cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Decode the JSON response to a PHP array
    $data = json_decode($response, true);

    // Check if data was decoded successfully
    if (json_last_error() === JSON_ERROR_NONE) {
        // Print the fetched data
        for($a = 0; $a < 50; $a++){
            if($data['entry'][$a]['response']['status']=='200 OK'){
                $id_hospital = $data['entry'][$a]['resource']['id'];
                $name_hospital = $data['entry'][$a]['resource']['name'];
                $resourceType_hospital = $data['entry'][$a]['resource']['resourceType'];
                $line_hospital = $data['entry'][$a]['resource']['address'][0]['line'][0];
                $city_hospital = $data['entry'][$a]['resource']['address'][0]['city'];
                $state_hospital = $data['entry'][$a]['resource']['address'][0]['state'];
                $country_hospital = $data['entry'][$a]['resource']['address'][0]['country'];
                $postalCode_hospital = $data['entry'][$a]['resource']['address'][0]['postalCode'];
                $lastUpdated_hospital = $data['entry'][$a]['resource']['meta']['lastUpdated'];
                $telecom_hospital = $data['entry'][$a]['resource']['telecom'][0]['value'];
                if($data['entry'][$a]['resource']['active']){
                    $active_hospital = 'aktif';
                }
                else{
                    $active_hospital = 'nonaktif';
                }

                $sql1 = "SELECT * FROM hospital WHERE id_hospital = '$id_hospital'";
                $row1 = $db->prepare($sql1);
                $row1->execute();
                $hasil1 = $row1->fetchAll();
                if(!empty($hasil1)){
                    echo 'a';
                }
                else{
                    $sql = "INSERT INTO hospital (id_hospital, name_hospital, resourceType_hospital, line_hospital, city_hospital, state_hospital, country_hospital, postalCode_hospital, lastUpdated_hospital, telecom_hospital, active_hospital) 
                        VALUES (:id_hospital, :name_hospital, :resourceType_hospital, :line_hospital, :city_hospital, :state_hospital, :country_hospital, :postalCode_hospital, :lastUpdated_hospital, :telecom_hospital, :active_hospital)";
                    $stmt = $db->prepare($sql);

                    // bind parameter ke query
                    $params = array(
                        ":id_hospital" => $id_hospital,
                        ":name_hospital" => $name_hospital,
                        ":resourceType_hospital" => $resourceType_hospital,
                        ":line_hospital" => $line_hospital,
                        ":city_hospital" => $city_hospital,
                        ":state_hospital" => $state_hospital,
                        ":country_hospital" => $country_hospital,
                        ":postalCode_hospital" => $postalCode_hospital,
                        ":lastUpdated_hospital" => $lastUpdated_hospital,
                        ":telecom_hospital" => $telecom_hospital,
                        ":active_hospital" => $active_hospital
                    );
                    // eksekusi query untuk menyimpan ke database
                    $saved = $stmt->execute($params);
                    if($saved){
                        echo 'b';
                    }
                    else{
                        echo 'c';
                    }
                }
            }
            else{
                echo 'error from server';
            }
        }
    } else {
        echo 'JSON Decode Error: ' . json_last_error_msg();
    }
}

// Close the cURL session
curl_close($ch);
?>
