<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get domain name and IP address from form submission
    $domain_name = $_POST['domainname'];
    $ip_address = $_POST['ipaddress'];

    // Classify the IP address
    $ipClass = classifyIP($ip_address);

    if ($ipClass === null) {
        echo "Invalid IP Address. Please try again.";
    } else {
        // Prepare SQL query to insert record into the table with IP class
        $sql = "INSERT INTO dnsrecords (domainname, ipaddress, ipclass) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sss", $domain_name, $ip_address, $ipClass);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    
    // Close the connection
    $conn->close();
}

// Function to classify IP address based on the first octet
function classifyIP($ip_address) {
    $octets = explode('.', $ip_address);
    
    if (count($octets) !== 4) return null;

    foreach ($octets as $octet) {
        if (!is_numeric($octet) || $octet < 0 || $octet > 255) {
            return null;  // Invalid IP Address
        }
    }

    $firstOctet = (int) $octets[0];

    if ($firstOctet >= 1 && $firstOctet <= 126) return "A";
    if ($firstOctet >= 128 && $firstOctet <= 191) return "B";
    if ($firstOctet >= 192 && $firstOctet <= 223) return "C";
    if ($firstOctet >= 224 && $firstOctet <= 239) return "D";
    if ($firstOctet >= 240 && $firstOctet <= 255) return "E";

    return null;
}
?>
