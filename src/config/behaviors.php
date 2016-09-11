<?php

return [

    \mhndev\yii2Comment\controllers\CommentController::class => [
        'access'=> [
            'class'=>yii\filters\AccessControl::class,
            'only'=>['create-comment','delete-comment','update-comment','list-comments'],
            'rules'=>[
                [
                    'allow'=>true,
                    'actions'=>['create-post','delete-post','update-post','list-comments'],
                    'roles' =>['admin','commentAdmin']
                ]
            ]
        ],


        'authenticator' => [
            'class' => yii\filters\auth\CompositeAuth::className(),
            'authMethods' => [
                yii\filters\auth\HttpBasicAuth::className(),
                yii\filters\auth\HttpBearerAuth::className(),
                yii\filters\auth\QueryParamAuth::className(),
            ],
        ]
    ],




];
