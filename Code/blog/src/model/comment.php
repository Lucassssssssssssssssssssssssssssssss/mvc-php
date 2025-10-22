<?php

namespace Application\Model\Comment;

require_once('src/lib/database.php');

class Comment
{
    public string $id; 
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
}

class CommentRepository
{
    public \DatabaseConnection $connection;

    function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->frenchCreationDate = $row['french_creation_date'];
            $comment->comment = $row['comment'];

            $comments[] = $comment;
        }

        return $comments;
    }

    function createComment(string $post, string $author, string $comment)
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function getComment(string $id): Comment
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, 
            DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date
            FROM comments WHERE id = ?"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();

        $comment = new Comment();
        $comment->id = $row['id'];
        $comment->author = $row['author'];
        $comment->frenchCreationDate = $row['french_creation_date'];
        $comment->comment = $row['comment'];

        return $comment;
    }

    public function updateComment(string $id, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE comments SET author = ?, comment = ? WHERE id = ?"
        );
        $affectedLines = $statement->execute([$author, $comment, $id]);

        return ($affectedLines > 0);
    }
}


