<?php
/**
 * Created by PhpStorm.
 * User: hoter.zhang
 * Date: 2018/1/17
 * Time: 14:59
 */

namespace xinyeweb\datatables;


use yii\web\AssetBundle;

class DataTablesTableToolsAsset extends AssetBundle
{

    public $sourcePath = '@bower/datatables-tabletools';

    public $css = [
        "css/dataTables.tableTools.css",
    ];

    public $js = [
        "js/dataTables.tableTools.js",
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'xinyeweb\datatables\DataTablesAsset',
    ];
}