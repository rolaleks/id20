<?php

namespace app\controllers;

use app\models\DataSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\Pagination;
use yii\db\Query;

class SiteController extends Controller
{
    public function init()
    {

    }

    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DataSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dateList = $searchModel->dateList(\Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dateList' => $dateList,
        ]);

    }


}
