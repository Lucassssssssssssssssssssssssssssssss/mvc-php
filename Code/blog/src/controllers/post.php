<?php

require_once('src/model.php');
require_once('src/model/comment.php');

function post(string $identifier)
{
    $repository = new PostRepository();
    $repository->getPost($identifier);
    $comments = getComments($identifier);

    require('templates/post.php');
}
