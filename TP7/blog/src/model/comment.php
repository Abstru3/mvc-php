<?php

class Comment
{
    public $author;
    public $frenchCreationDate;
    public $comment;

    public function __construct($author, $frenchCreationDate, $comment)
    {
        $this->author = $author;
        $this->frenchCreationDate = $frenchCreationDate;
        $this->comment = $comment;
    }
}

function getComments(string $post): array
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$post]);

    $comments = [];
    while (($row = $statement->fetch())) {
        $comment = new Comment(
            $row['author'],
            $row['french_creation_date'],
            $row['comment']
        );

        $comments[] = $comment;
    }

    return $comments;
}

function createComment(string $post, string $author, string $comment): bool
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

function commentDbConnect(): PDO
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');

    return $database;
}
