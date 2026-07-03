<?php

$file = __DIR__ . '/sisterPresence_v1.5.0.apk';

if (! file_exists($file)) {
    http_response_code(404);
    echo 'File not found.';
    exit;
}

header('Content-Type: application/vnd.android.package-archive');
header('Content-Disposition: attachment; filename="sisterPresence_v1.5.0.apk"');
header('Content-Length: ' . filesize($file));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: private, no-transform');

readfile($file);
