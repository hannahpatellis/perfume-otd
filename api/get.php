<?php

// Set CORS headers
header('Access-Control-Allow-Origin: https://hannahap.com');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");

// Parfumo.com username to query
$parfumoUsername = "iconicos";

// hQuery.php is required for this script
// Autoload via Composer
require_once __DIR__ . '/../vendor/autoload.php';
use duzun\hQuery;

// Query your profile page
$docProfile = hQuery::fromUrl('https://www.parfumo.com/Users/'.$parfumoUsername, ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8']);

// If nothing is present in the $docProfile query (no current perfume is active or other error)
// then prepare $result array with "active" set to false
if($docProfile->find("div#i_wear_sidebar div.pgrid div.col div.name a") == "") {
    $result = [
        "active" => false
    ];
} else {
    // Select perfume page URL from profile page
    $perfumeURL = $docProfile->find("div#i_wear_sidebar div.pgrid div.col div.name a")->attr('href');

    // Query the perfume page itself
    $docPerfume = hQuery::fromUrl($perfumeURL, ['Accept' => 'text/html,application/xhtml+xml;q=0.9,*/*;q=0.8']);

    // Select the perfume name (and remove everything after the name) and the perfume brand
    // Trim whitespace from name and brand
    $perfumeName = $docPerfume->find("div.p_details_section h1.p_name_h1")->html();
    $perfumeName = strtok($perfumeName, "<");
    $perfumeName = trim($perfumeName);
    $perfumeBrand = $docPerfume->find("span.p_brand_name a:first-child span")->text();
    $perfumeBrand = trim($perfumeBrand);

    // Prepare an array of results
    $result = [
        "active" => true,
        "brand" => $perfumeBrand,
        "perfume" => $perfumeName,
        "url" => $perfumeURL
    ];
}

// Print the array as JSON to page
print_r(json_encode($result));

?>