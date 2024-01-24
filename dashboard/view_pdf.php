<?php

// Get file path and name from query parameters
$file_name = isset($_GET['file_name']) ? $_GET['file_name'] : '';
$file_path_relative = isset($_GET['file_path']) ? $_GET['file_path'] : '';

// Get the absolute file path using __DIR__
$base_path = __DIR__;
$file_path_absolute = $base_path . '/' . $file_path_relative;

$content_type = "application/octet-stream";

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $file_path_relative . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');

// Read the file 
@readfile($file_path_absolute);
