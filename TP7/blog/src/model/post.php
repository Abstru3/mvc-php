<?php

class Post
{
    public string $title;
    public string $content;
    public string $author;
    public string $frenchCreationDate;

    public function __construct(string $title, string $content, string $author, string $frenchCreationDate)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->frenchCreationDate = $frenchCreationDate;
    }
}

function getPosts(): array
{
    $database = postDbConnect();
    $statement = $database->query(
        "SELECT title, content, author, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC"
    );

    $posts = [];
    while (($row = $statement->fetch())) {
        $post = new Post(
            $row['title'],
            $row['content'],
            $row['author'],
            $row['french_creation_date']
        );

        $posts[] = $post;
    }

    return $posts;
}

function postDbConnect(): PDO
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');

    return $database;
}
