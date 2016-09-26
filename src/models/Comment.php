<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 9:52 AM
 */
namespace mhndev\yii2Comment\models;

use mhndev\yii2Comment\traits\CommentTrait;
use yii\db\ActiveRecord;

/**
 * Class Term
 * @package mhndev\yii2Comment\Entities
 */
class Comment extends ActiveRecord
{
    use CommentTrait;


    /**
     * @return string
     */
    public static function tableName()
    {
        return 'comments';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['entity_id'], 'required'],
            [['entity'], 'required'],
            [['text'], 'required'],
            [['parent_id'], 'safe']
        ];
    }


    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert)
                $this->created_at = date('Y-m-d H:i:s');
            $this->updated_at = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }


    }



}
