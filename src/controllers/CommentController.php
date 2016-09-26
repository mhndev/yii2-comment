<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 10:48 AM
 */
namespace mhndev\yii2Comment\controllers;

use mhndev\yii2Comment\interfaces\iComment;
use mhndev\yii2Comment\models\Comment;
use Yii;
use yii\web\Controller;

/**
 * Class CommentController
 * @package mhndev\yii2TaxonomyTerm\controllers
 */
class CommentController extends Controller
{
    /**
     * @var array
     */
    protected static $config;

    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors =  parent::behaviors();
        self::$config = include Yii::getAlias('@app').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'comment.php';

        return array_merge($behaviors, self::$config[static::class]);
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $data = Yii::$app->request->post();
        $entityClass =self::$config['entities'][strtolower($data['entity'])];

        $entity = $entityClass::findOne($data['entity_id']);
        $comment = $entity->comment($data['text']);

        $comment->entity = $this->classNameWithNamespaceFromClassName($comment->entity);

        return $comment;
    }


    /**
     *
     */
    public function actionList()
    {

    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionShow($id)
    {
        $commentClass = self::$config['commentClass'];

        $comment = $commentClass::findOne($id);
        $comment->entity = $this->classNameWithNamespaceFromClassName($comment->entity);

        return $comment;
    }

    /**
     * @param $id
     */
    public function actionUpdate($id)
    {
        $data = Yii::$app->request->post();

        $commentClass = self::$config['commentClass'];

        $comment = $commentClass::findOne($id);

        $comment->setAttributes($data);

        $comment->save();

        $comment->entity = $this->classNameWithNamespaceFromClassName($comment->entity);

        return $comment;

    }


    /**
     *
     */
    public function actionDelete($id)
    {
        $commentClass = self::$config['commentClass'];

        $comment = $commentClass::findOne($id);

        $comment->delete();
    }



    /**
     *
     */
    public function actionDeleteMultiple()
    {
        $commentClass = self::$config['commentClass'];

        $commentClass::deleteAll(['in', $commentClass::primaryKey() , Yii::$app->request->post()['ids'] ]);
    }


    /**
     *
     */
    public function actionReply($id)
    {
        $data = Yii::$app->request->post();

        $commentClass = self::$config['commentClass'];

        /** @var iComment $comment */
        $comment = $commentClass::findOne($id);

        $newComment = $comment->reply($data['text']);
        $newComment->entity = $this->classNameWithNamespaceFromClassName($newComment->entity);

        return $newComment;
    }


    /**
     * @param $name
     * @return mixed
     */
    protected function getClassNameWithoutNamespace($name)
    {
        $path = explode('\\', $name);

        return array_pop($path);
    }


    /**
     * @param $name
     * @return int|string
     */
    protected function classNameWithNamespaceFromClassName($name)
    {
        foreach (self::$config['entities'] as $entityName => $entityClass){

            if($entityClass == $name){
                return $entityName;
            }
        }

        return false;
    }

}
