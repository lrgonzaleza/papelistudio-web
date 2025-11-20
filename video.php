<?php
session_start();

if (!isset($_SESSION['usuario'])) {
http_response_code(403);
exit('Acceso denegado');
}

$video = basename($_GET['v']);
$file = __DIR__ . "/videos/" . $video;

if (file_exists($file)) {
header("Content-Type: video/mp4");
header("Content-Disposition: inline");
readfile($file);
exit;
} else {
http_response_code(404);
echo "Video no encontrado";
}
?>
