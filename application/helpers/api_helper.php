<?php
function get_api_data($obj)
{
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $obj->link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate verification (use with caution)

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Output the response
    if ($response) {
        $res = json_decode($response);
        if ($res->success == 1) {
            return $res->data;
        } else {
            return null;
        }
    } else {
        return null;
    }
}


function filter_api_data($obj)
{
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $obj->link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate verification (use with caution)

    // Set POST data
    $postFields = array(
        'search' => $obj->search, // Replace 'search' with the appropriate POST field name
        // Add other POST fields if needed
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Output the response
    if ($response) {
        $res = json_decode($response);
        if ($res->success == 1) {
            return $res->data;
        } else {
            return [];
        }
    } else {
        return [];
    }
}
