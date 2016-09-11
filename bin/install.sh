#!/bin/bash

cwd=${PWD}


source='/vendor/mhndev/yii2-comment/src/config/behaviors.php'
destination='/config/comment.php'


#echo $cwd$source
#echo $cwd$destination
cp $cwd$source $cwd$destination
