<?php
// src/model/post.php

class Post {
    public $title;
    public $frenchCreationDate;
    public $content;
    public $identifier;
}

class PostRepository
{
    public $database = null;

    public function getPosts()
    {
        $this->dbConnect();
        $statement = $this->database->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts");
        
        $posts = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];
            $posts[] = $post;
        }

        return $posts;
    }

    public function getPost($identifier)
    {
        $this->dbConnect();
        $statement = $this->database->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        $post = new Post();
        if ($row) {
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];
        }

        return $post;
    }

    private function dbConnect()
    {
        if ($this->database === null) {
            $this->database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
}
