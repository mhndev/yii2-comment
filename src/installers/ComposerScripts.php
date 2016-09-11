<?php

namespace mhndev\yii2Comment\installers;

use Composer\Script\Event;

/**
 * Class ComposerScripts
 * @package mhndev\yii2Comment\installers
 */
class ComposerScripts
{
    /**
     * Handle the post-install Composer event.
     *
     * @param  \Composer\Script\Event  $event
     * @return void
     */
    public static function postInstall(Event $event)
    {
        $sourcePath = $event->getComposer()->getConfig()->get('vendor-dir').'/mhndev/yii2-comment/config/behaviors.php';


        $destinationPath = $event->getComposer()->getConfig()->get('vendor-dir').'/../config/comment.php';

        copy($sourcePath, $destinationPath);
    }

}
