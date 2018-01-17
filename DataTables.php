<?php
/**
 * Created by PhpStorm.
 * User: hoter.zhang
 * Date: 2018/1/17
 * Time: 15:00
 */

namespace xinyeweb\datatables;


use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class DataTables extends GridView {

    public $options = [];

    public $tableOptions = ["class"=>"table table-striped table-bordered","cellspacing"=>"0", "width"=>"100%"];

    public $clientOptions = [];

    public function run()
    {
        //GridView
        $clientOptions = $this->getClientOptions();
        $view = $this->getView();
        $id = $this->tableOptions['id'];

        //Bootstrap3
        DataTablesBootstrapAsset::register($view);

        //TableTools Asset if needed
        if (isset($clientOptions["tableTools"]) || (isset($clientOptions["dom"]) && strpos($clientOptions["dom"], 'T')>=0)){
            $tableTools = DataTablesTableToolsAsset::register($view);
            //SWF copy and download path overwrite
            $clientOptions["tableTools"]["sSwfPath"] = $tableTools->baseUrl."/swf/copy_csv_xls_pdf.swf";
        }
        $options = Json::encode($clientOptions);
        $view->registerJs("jQuery('#$id').DataTable($options);");

        //base list view run
        if ($this->showOnEmpty || $this->dataProvider->getCount() > 0) {
            $content = preg_replace_callback("/{\\w+}/", function ($matches) {
                $content = $this->renderSection($matches[0]);
                return $content === false ? $matches[0] : $content;
            }, $this->layout);
        } else {
            $content = $this->renderEmpty();
        }
        $tag = ArrayHelper::remove($this->options, 'tag', 'div');
        echo Html::tag($tag, $content, $this->options);
    }

    public function init()
    {
        parent::init();

        //disable filter model by grid view
        $this->filterModel = null;

        //disable sort by grid view
        $this->dataProvider->sort = false;

        //disable pagination by grid view
        $this->dataProvider->pagination = false;

        //layout showing only items
        $this->layout = "{items}";

        //the table id must be set
        if (!isset($this->tableOptions['id'])) {
            $this->tableOptions['id'] = 'datatables_'.$this->getId();
        }
    }

    protected function getClientOptions()
    {
        return $this->clientOptions;
    }

    public function renderTableBody()
    {
        $models = array_values($this->dataProvider->getModels());
        if (count($models) === 0) {
            return "<tbody>\n</tbody>";
        } else {
            return parent::renderTableBody();
        }
    }
}