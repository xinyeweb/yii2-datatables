<?php
/**
 * Created by PhpStorm.
 * User: hoter.zhang
 * Date: 2018/1/17
 * Time: 14:57
 */

namespace xinyeweb\datatables;


use yii\web\AssetBundle;

class DataTablesAsset extends AssetBundle
{

    public $sourcePath = '@bower/datatables';

    public $css = [
        'media/css/jquery.dataTables.css'
    ];

    public $js = [
        'media/js/jquery.dataTables.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}