<?php
// Connexion à la base de données
try {
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des 5 derniers billets
$statement = $database->query(
    "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
);

$posts = []; // Initialisation du tableau

while ($row = $statement->fetch()) {
    $post = [
        'title' => $row['titre'],
        'french_creation_date' => $row['date_creation_fr'],
        'content' => $row['contenu'],
    ];
    $posts[] = $post; // Ajout du post au tableau
}

// Inclusion du fichier template pour afficher les données
require('templates/homepage.php');

?>
