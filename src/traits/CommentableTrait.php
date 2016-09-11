<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 10:07 AM
 */
namespace mhndev\yii2Comment\traits;
use mhndev\yii2Comment\models\Comment;

/**
 * Class CommentTrait
 * @package mhndev\yii2Comment\traits
 */
trait CommentTrait
{


    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['entity'=>static::class, 'entity_id'=>$this->entity_id ]);
    }


    /**
     * @return int
     */
    public function deleteAllComments()
    {
        return Comment::deleteAll(['entity'=>static::class, 'entity_id'=>$this->entity_id ]);
    }

    /**
     * @param $id
     * @throws \Exception
     */
    public function deleteCommentById($id)
    {
        $comment = Comment::findOne(['id'=>$id]);

        if($comment->entity = static::class && $comment->entity_id == $this->id){
            $comment->delete();
        }
        else{
            throw new \Exception('The comment is not for Object with class '.static::class.' and with id '.$this->id);
        }
    }

    /**
     * @param Comment $comment
     * @throws \Exception
     */
    public function deleteComment(Comment $comment)
    {
        if($comment->entity = static::class && $comment->entity_id == $this->id){
            $comment->delete();
        }
        else{
            throw new \Exception('The comment is not for Object with class '.static::class.' and with id '.$this->id);
        }
    }
}
