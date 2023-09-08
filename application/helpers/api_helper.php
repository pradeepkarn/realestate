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

    // print_r($obj->search);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $obj->link,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $obj->search,
        CURLOPT_HTTPHEADER => array(
            'Cookie: ci_session=fc5ed6f7c1596f83b4d5531e3532e94fb8c10446'
        ),
    ));

    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
    }

    // Close cURL session
    curl_close($curl);

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
