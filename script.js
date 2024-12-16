const correctPassword = "admin123";

// Password validation function
function checkPassword() {
    const inputPassword = document.getElementById("passwordInput").value;
    const errorElement = document.getElementById("passwordError");

    if (inputPassword === correctPassword) {
        errorElement.innerText = "";  // Clear any error
        window.location.href = "options.html";  // Navigate to another page
    } else {
        errorElement.innerText = "Incorrect password. Please try again.";
    }
}

// Add a new record
function addRecord() {
    const domain = document.getElementById("addDomain").value;
    const ip = document.getElementById("addIP").value;
    const addMessage = document.getElementById("addMessage");

    // Clear any previous messages
    addMessage.innerText = "";

    if (!domain || !ip) {
        addMessage.innerText = "Please provide both domain and IP.";
        return;
    }

    addMessage.innerText = `Added record: ${domain} -> ${ip}`;

    // Create a new list item for the record
    const recordsList = document.getElementById("recordsList");
    const recordItem = document.createElement("li");
    recordItem.textContent = `${domain} -> ${ip}`;

    recordsList.appendChild(recordItem);  // Add the new record to the list

    // Optionally, clear input fields after adding the record
    document.getElementById("addDomain").value = '';
    document.getElementById("addIP").value = '';
}

// Delete a record
function deleteRecord() {
    const domain = document.getElementById("deleteDomain").value;
    const deleteMessage = document.getElementById("deleteMessage");

    // Clear any previous messages
    deleteMessage.innerText = "";

    if (!domain) {
        deleteMessage.innerText = "Please provide a domain to delete.";
        return;
    }

    deleteMessage.innerText = `Deleted record for domain: ${domain}`;

    // Remove the record from the list
    const recordsList = document.getElementById("recordsList");
    const records = recordsList.getElementsByTagName("li");

    let recordDeleted = false;
    for (let i = 0; i < records.length; i++) {
        if (records[i].textContent.startsWith(domain)) {
            recordsList.removeChild(records[i]);
            recordDeleted = true;
            break;
        }
    }

    if (!recordDeleted) {
        deleteMessage.innerText = `No record found for domain: ${domain}`;
    }

    // Optionally, clear input field after deleting the record
    document.getElementById("deleteDomain").value = '';
}

// Display initial records
function displayRecords() {
    const recordsList = document.getElementById("recordsList");
    const records = [
        { domain: "google.com", ip: "8.8.8.8" },
        { domain: "example.com", ip: "93.184.216.34" }
    ];

    // Display records in a list
    recordsList.innerHTML = "<ul>" + records.map(r => `<li>${r.domain} -> ${r.ip}</li>`).join("") + "</ul>";
}

// Call displayRecords to initially display records on page load
window.onload = displayRecords;
