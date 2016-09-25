<?php

namespace mhndev\yii2Comment;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Module as BaseModule;
use yii\console\Application as ConsoleApplication;

/**
 * Class Module
 * @package mhndev\yii2Comment
 */
class Module extends BaseModule implements BootstrapInterface
{

    public $db = 'db';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'mhndev\yii2Comment\controllers';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::setAlias('commentModulePath', Yii::getAlias('@vendor'));
    }

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'mhndev\yii2Comment\commands';
        }
    }
}
