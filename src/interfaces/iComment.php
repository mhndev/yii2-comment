<?php

namespace mhndev\yii2Comment\interfaces;

/**
 * Interface iComment
 * @package mhndev\yii2Comment\interfaces
 */
interface iComment
{
    /**
     * @return mixed
     */
    public function getEntity();

    /**
     * @return mixed
     */
    public function getParent();


    /**
     * @param $comment
     * @return array of iComment|mixed
     * @throws \Exception
     */
    public function getAllCommentReplies($comment);


    /**
     * @param $user_id
     * @param $text
     * @return iComment
     */
    public function reply($text, $user_id = null);
}
