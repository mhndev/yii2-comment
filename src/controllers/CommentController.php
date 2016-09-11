<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 10:48 AM
 */
namespace mhndev\yii2Comment\controllers;

use mhndev\yii2Comment\models\Comment;
use yii\rest\ActiveController;

/**
 * Class CommentController
 * @package mhndev\yii2TaxonomyTerm\controllers
 */
class CommentController extends ActiveController
{

    /**
     * @var string
     */
    public $modelClass = Comment::class;

    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

}
