<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 9/11/16
 * Time: 12:27 PM
 */
namespace mhndev\yii2Comment\uac\rules;

use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Class OwnCommentRule
 *
 * Checks if ownerID matches user passed via params
 *
 * @package app\modules\agency\uac\rules
 */
class OwnCommentRule extends Rule
{
    public $name = 'ownComment';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['comment']) ? $params['comment']->writer == $user : false;
    }
}
