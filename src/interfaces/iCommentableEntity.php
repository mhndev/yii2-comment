<?php
namespace mhndev\yii2Comment\interfaces;

/**
 * Interface iComment
 * @package mhndev\yii2Comment\interfaces
 */
interface iCommentableEntity
{
    /**
     * @return mixed
     */
    public function getComments();


    /**
     * @return int
     */
    public function deleteAllComments();

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteCommentById($id);

    /**
     * @param iComment $comment
     * @throws \Exception
     */
    public function deleteComment(iComment $comment);


    /**
     * @param $comment
     * @throws \Exception
     */
    public function deleteAllCommentReplies($comment);


    /**
     * @param $comment
     * @return mixed
     * @throws \Exception
     */
    public function getAllCommentReplies($comment);


    /**
     * @param $comment
     * @param $text
     * @return iComment
     */
    public function reply($comment, $text);

    /**
     * @param $text
     * @return iComment
     */
    public function comment($text);
}
