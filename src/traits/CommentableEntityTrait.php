<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 10:07 AM
 */
namespace mhndev\yii2Comment\traits;
use mhndev\yii2Comment\interfaces\iComment;
use mhndev\yii2Comment\models\Comment;
use MongoDB\BSON\ObjectID;
use Yii;

/**
 * Class CommentableEntityTrait
 * @package mhndev\yii2Comment\traits
 */
trait CommentableEntityTrait
{
    protected static $commentClass;

    protected static $userClass;


    public function init()
    {
        parent::init();

        $config = include Yii::getAlias('@app').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'comment.php';

        self::$commentClass = $config['commentClass'];
    }

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
     * @param iComment $comment
     * @throws \Exception
     */
    public function deleteComment(iComment $comment)
    {
        if($comment->entity != static::class || $comment->entity_id != $this->{$this->primaryKey()[0]}){
            $comment->delete();
        }
        else{
            throw new \Exception('The comment is not for Object with class '.static::class.' and with id '.$this->id);
        }
    }


    /**
     * @param $comment
     * @throws \Exception
     */
    public function deleteAllCommentReplies($comment)
    {
        if($comment->entity != static::class || $comment->entity_id != $this->{$this->primaryKey()[0]}){
            throw new \Exception('The comment is not for Object with class '.static::class.' and with id '.$this->id);
        }

        $commentClass = self::$commentClass;

        $commentClass::deleteAll(['parent_id'=>$comment->id]);
    }


    /**
     * @param $comment
     * @return mixed
     * @throws \Exception
     */
    public function getAllCommentReplies($comment)
    {
        if($comment->entity != static::class || $comment->entity_id != $this->{$this->primaryKey()[0]}){
            throw new \Exception('The comment is not for Object with class '.static::class.' and with id '.$this->id);
        }

        $commentClass = self::$commentClass;

        $items = $commentClass::find()->where(['=','parent_id',$comment->{$comment->primaryKey()[0]}])->all();

        return $items;
    }

    /**
     * @param $comment
     * @param $text
     * @return iComment
     */
    public function reply($comment, $text)
    {
        $commentClass = self::$commentClass;

        $newComment = new $commentClass;

        $newComment->entity = static::class;
        $newComment->entity_id = $this->{$this->primaryKey()[0]};
        $newComment->user_id = Yii::$app->user->identity->id;
        $newComment->text = $text;
        $newComment->parent_id = $comment->id;
        $newComment->depth = $comment->depth + 1;

        $newComment->save();

        return $newComment;
    }

    /**
     * @param $text
     * @return iComment
     */
    public function comment($text)
    {
        $id = $this->{$this->primaryKey()[0]};

        $commentClass = self::$commentClass;

        $newComment = new $commentClass;
        $newComment->entity = static::class;
        $newComment->entity_id = ($id instanceof ObjectID) ? $id->__toString() : $id;

        $newComment->user_id = Yii::$app->user->identity->id;
        $newComment->text = $text;
        $newComment->parent_id = null;
        $newComment->depth = 0;

        $newComment->save();

        return $newComment;
    }
}
