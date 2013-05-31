<?php
require_once __DIR__ . '/getsong_core.php';

header("Content-Type: application/json; charset=utf-8");
echo json_encode(array('songs' => $total_songs));
?>
