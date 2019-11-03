<?php

namespace cenotia\components\modal;

use Yii;
use yii\web\AssetBundle;

class RemoteModalAsset extends AssetBundle
{
     public $sourcePath = '@vendor/cenotia/yii2-remote-modal/assets';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
   
   public $css = [
	'css/remote-modal.css'
   ];
    
    public $js = [
	'js/remote-modal.js'
    ];


}
