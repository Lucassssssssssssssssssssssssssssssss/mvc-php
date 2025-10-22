<?php

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/post.php');

use Application\Model\Post\PostRepository;
use Application\Model\Comment\CommentRepository;

function post(string $identifier)
{
    $connection = new DatabaseConnection();

    $postRepository = new PostRepository();
    $postRepository->connection = $connection;
    $post = $postRepository->getPost($identifier);

    $commentRepository = new CommentRepository();
    $commentRepository->connection = $connection;
    $comments = $commentRepository->getComments($identifier);

    require('templates/post.php');
}

function editComment(string $id, string $postId)
{
    $connection = new DatabaseConnection();

    $commentRepository = new CommentRepository();
    $commentRepository->connection = $connection;
    $comment = $commentRepository->getComment($id);

    require('templates/editComment.php');
}

function updateComment(string $id, string $postId, array $input)
{
    $connection = new DatabaseConnection();

    $commentRepository = new CommentRepository();
    $commentRepository->connection = $connection;

    $success = $commentRepository->updateComment($id, $input['author'], $input['comment']);

    if ($success) {
        header('Location: index.php?action=post&id=' . $postId);
    } else {
        throw new Exception('Impossible de mettre à jour le commentaire.');
    }
}
    
