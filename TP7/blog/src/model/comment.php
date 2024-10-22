<?php

<<<<<<< HEAD
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
=======
function getComments(string $post)
>>>>>>> 1e7d5234d0d7d6f83326626b8c31af3a5e09b2dc
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
    );
    $statement->execute([$post]);

    $comments = [];
    while (($row = $statement->fetch())) {
<<<<<<< HEAD
        $comment = new Comment(
            $row['author'],
            $row['french_creation_date'],
            $row['comment']
        );
=======
        $comment = [
            'author' => $row['author'],
            'french_creation_date' => $row['french_creation_date'],
            'comment' => $row['comment'],
        ];
>>>>>>> 1e7d5234d0d7d6f83326626b8c31af3a5e09b2dc

        $comments[] = $comment;
    }

    return $comments;
}

<<<<<<< HEAD
function createComment(string $post, string $author, string $comment): bool
=======
function createComment(string $post, string $author, string $comment)
>>>>>>> 1e7d5234d0d7d6f83326626b8c31af3a5e09b2dc
{
    $database = commentDbConnect();
    $statement = $database->prepare(
        'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
    );
    $affectedLines = $statement->execute([$post, $author, $comment]);

    return ($affectedLines > 0);
}

<<<<<<< HEAD
function commentDbConnect(): PDO
=======
function commentDbConnect()
>>>>>>> 1e7d5234d0d7d6f83326626b8c31af3a5e09b2dc
{
    $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'blog', 'password');

    return $database;
}
