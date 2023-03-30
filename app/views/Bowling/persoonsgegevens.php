<?php

// Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=bowlingbrooklyn3', 'root', '');

// Check if a date has been submitted
$date = null;
if (isset($_POST['date'])) {
    $date = $_POST['date'];
}

// Retrieve data from the database
if ($date) {
    $stmt1 = $pdo->prepare('SELECT Id, voornaam, tussenvoegsel, achternaam, isVolwassen, createdAt FROM persoon WHERE Date(createdAt) = :date ORDER BY achternaam ASC');
    $stmt1->execute(['date' => $date]);
    $stmt2 = $pdo->prepare('SELECT Id, persoonId, mobiel, email FROM contact');
    $stmt2->execute();
} else {
    $stmt1 = $pdo->prepare('SELECT Id, voornaam, tussenvoegsel, achternaam, isVolwassen, createdAt FROM persoon ORDER BY achternaam ASC');
    $stmt1->execute();
    $stmt2 = $pdo->prepare('SELECT Id, persoonId, mobiel, email FROM contact');
    $stmt2->execute();
}

// Store the retrieved data in a variable
$persoon = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$contact = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Display the data in a table
echo '<h2><u>Overzicht Klanten</u></h2>';

// Add a form to select a date
echo '<form method="post">';
echo '<input type="date" name="date" value="' . ($date ?? '') . '" />';
echo '<input type="submit" value="Tonen" />';
echo '</form>';
if ($persoon) {
    echo '<table border>';
    echo '<tr><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Mobiel</th><th>E-mail</th><th>Volwassen</th></tr>';
    foreach ($persoon as $persoon_data) {
        echo '<tr>';
        echo '<td>' . $persoon_data['voornaam'] . '</td>';
        echo '<td>' . $persoon_data['tussenvoegsel'] . '</td>';
        echo '<td>' . $persoon_data['achternaam'] . '</td>';

        // Look for the mobile number associated with this person
        $mobiel = '';
        foreach ($contact as $contact_data) {
            if ($contact_data['persoonId'] == $persoon_data['Id']) {
                $mobiel = $contact_data['mobiel'];
                break;
            }
        }
        echo '<td>' . $mobiel . '</td>';

        // Look for the email address associated with this person
        $email = '';
        foreach ($contact as $contact_data) {
            if ($contact_data['persoonId'] == $persoon_data['Id']) {
                $email = $contact_data['email'];
                break;
            }
        }
        echo '<td>' . $email . '</td>';

        echo '<td>' . $persoon_data['isVolwassen'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'Er is geen informatie beschikbaar voor deze geselecteerde datum';
}
