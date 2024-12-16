<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the domain name to delete from the URL
    if (isset($_GET['domainName']) && !empty($_GET['domainName'])) {
        $domainName = $_GET['domainName'];

        // SQL query to delete the record using a prepared statement to prevent SQL injection
        $sql = "DELETE FROM dnsrecords WHERE DomainName = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param("s", $domainName);  // 's' is for string type

            // Execute the statement
            if ($stmt->execute()) {
                echo "Record for domain '$domainName' deleted successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid domain name.";
    }

    // Close the connection
    $conn->close();
}
?>
