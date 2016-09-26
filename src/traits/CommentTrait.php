<?php
namespace mhndev\yii2Comment\traits;
use mhndev\yii2Comment\interfaces\iComment;
use mhndev\yii2Comment\interfaces\iCommentableEntity;
use Yii;

/**
 * Class CommentTrait
 * @package mhndev\yii2Comment\traits
 */
trait CommentTrait
{

    /**
     * @return iCommentableEntity
     */
    public function getEntity()
    {
        return $this->hasOne($this->entity , ['id'=>$this->entity_id]);
    }


    /**
     * @return iComment
     */
    public function getParent()
    {
        return $this->hasOne(self::class, ['parent_id'=>'id']);
    }


    /**
     * @param $comment
     * @return mixed
     * @throws \Exception
     */
    public function getAllCommentReplies($comment)
    {
        $items = static::find()->where(['=','parent_id',$comment->{$comment->primaryKey()[0]}])->all();

        return $items;
    }


    /**
     * @param $user_id
     * @param $text
     * @return iComment
     */
    public function reply($text, $user_id = null)
    {
        if(is_null($user_id)){
            $user_id = Yii::$app->user->identity->id;
        }

        $comment = new self([
            'user_id' => $user_id,
            'entity' => $this->entity,
            'entity_id' => $this->entity_id,
            'text'      => $text,
            'parent_id' => $this->{$this->primaryKey()[0]},
            'depth'     => $this->depth + 1,
        ]);

        $comment->save();

        return $comment;
    }
}
