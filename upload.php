<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Zorg ervoor dat deze map bestaat
        $uploadFile = $uploadDir . basename($_FILES['video']['name']);

        // Probeer het bestand te verplaatsen
        if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
            // Geef een succesvolle JSON-reactie terug
            echo json_encode(['message' => 'Opname succesvol geüpload']);
        } else {
            // Fout bij het verplaatsen van het bestand
            http_response_code(500);
            echo json_encode(['message' => 'Fout bij het uploaden van de video']);
        }
    } else {
        // Ongeldig upload
        http_response_code(400);
        echo json_encode(['message' => 'Ongeldige upload']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Methode niet toegestaan']);
}
?>