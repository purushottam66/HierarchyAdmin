<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Check if the file exists before trying to load it
$jsonFilePath = APPPATH . 'assets/hierarchy.json';
if (file_exists($jsonFilePath)) {
    $config['hierarchy_json'] = json_decode(file_get_contents($jsonFilePath), true);
} else {
    $config['hierarchy_json'] = [];
}