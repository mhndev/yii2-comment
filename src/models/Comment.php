<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 9:52 AM
 */
namespace mhndev\yii2Comment\models;

use yii\db\ActiveRecord;

/**
 * Class Term
 * @package mhndev\yii2Comment\Entities
 */
class Comment extends ActiveRecord
{


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
     * @return ActiveRecord
     */
    public function getEntity()
    {
        return $this->hasOne($this->entity , ['id'=>$this->entity_id]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::class, ['parent_id'=>'id']);
    }


    /**
     * @param $writer
     * @param $text
     * @return Comment
     */
    public function reply($writer, $text)
    {
        $comment = new self([
            'writer' => $writer,
            'entity' => $this->entity,
            'entity_id' => $this->entity_id,
            'text'      => $text
        ]);

        $comment->save();

        return $comment;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(!empty($this->parent_id)) {

            $parent = $this->getParent();

            if (!empty($parent->path)){
                $this->path = $parent->path . '' . $parent->id;
            }
            else{
                $this->path = $parent->id;
            }
        }

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
