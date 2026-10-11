<?php
header("Content-Type: application/json; charset=UTF-8");

$json_data = file_get_contents("php://input");

if ($json_data) {
    $file_name = "hasil_ujian.json";
    $existing_data = file_exists($file_name) ? json_decode(file_get_contents($file_name), true) : [];
    $new_entry = json_decode($json_data, true);
    $existing_data[] = $new_entry;

    file_put_contents($file_name, json_encode($existing_data, JSON_PRETTY_PRINT));

    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Data berhasil disimpan"]);
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Tidak ada data yang diterima"]);
}
?>