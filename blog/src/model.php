<?php
function getPosts() {
    // Connexion à la base de données
    try {
        $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    // Récupération des 5 derniers billets
    $statement = $database->query(
        "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
    );
    
    $posts = [];
    while ($row = $statement->fetch()) {
        $post = [
            'title' => $row['title'],
            'creation_date_fr' => $row['creation_date_fr'],
            'content' => $row['content'],
        ];
        $posts[] = $post;
    }
    
    return $posts;
}
