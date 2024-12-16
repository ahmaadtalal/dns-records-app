<?php
include 'db_connect.php'; // Include your database connection file

if ($conn === false) {
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

$sql = "SELECT DomainName, IPAddress, IPClass FROM dnsrecords";
$result = $conn->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row; // Add the row data to the records array
    }
} else {
    $records[] = ["message" => "No records found."];
}

header('Content-Type: application/json');
echo json_encode($records);

$conn->close();
?>
