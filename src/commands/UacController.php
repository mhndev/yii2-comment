<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 12:23 PM
 */
namespace mhndev\yii2Comment\commands;

use mhndev\yii2Comment\uac\rules\OwnCommentRule;
use Yii;
use yii\console\Controller;


/**
 * Class UacController
 * @package mhndev\yii2Comment\commands
 */
class UacController extends Controller
{


    public function actionInit()
    {
        $auth = Yii::$app->authManager;


        $admin = $auth->getRole('admin');

        if($admin == null){
            $admin = $auth->createRole('admin');
            $auth->add($admin);
        }


        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'Create a comment';
        $auth->add($createComment);


        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = 'Delete Agency';
        $auth->add($deleteComment);


        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = 'Update Comment';
        $auth->add($updateComment);


        $rule = new OwnCommentRule;
        $auth->add($rule);

        $updateOwnComment = $auth->createPermission('updateOwnComment');
        $updateOwnComment->description = 'Update own Agency';
        $updateOwnComment->ruleName = $rule->name;
        $auth->add($updateOwnComment);


        $commentOwner = $auth->createRole('commentOwner');
        $auth->add($commentOwner);

        $auth->addChild($updateOwnComment, $updateComment);


        $auth->addChild($commentOwner, $updateOwnComment);


        $commentAdmin = $auth->createRole('commentAdmin');
        $auth->add($commentAdmin);




        $auth->addChild($admin, $commentAdmin);
        $auth->addChild($commentAdmin, $updateComment);
        $auth->addChild($commentAdmin, $deleteComment);
        $auth->addChild($commentAdmin, $commentOwner);


        $auth->assign($commentOwner, 2);
        $auth->assign($commentAdmin, 1);
    }
}
