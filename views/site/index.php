<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\DataSearch;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $searchModel  app\models\DataSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $dateList     [] app\models\Data
 *
 */

?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-3">
            <ul>
                <li><?= Html::a("Все", ['/']); ?></li>
                <?php
                $last_year = 0;
                foreach ($dateList as $date) {
                    $year = \Yii::$app->formatter->asDate($date->date, 'yyyy');
                    $month = \Yii::$app->formatter->asDate($date->date, 'MMMM');
                    $month_formatted = \Yii::$app->formatter->asDate($date->date, 'MM');
                    if ($year != $last_year) {
                        $count_year = DataSearch::getYearCount($dateList, $year);
                        ?>
                        <li><?= Html::a($year . " ({$count_year})", Url::current([$searchModel->formName() => ["year" => $year, "month" => null]])); ?></li>
                        <?php
                    }
                    ?>
                    <li class="month"><?= Html::a($month . " ({$date->count_month})", Url::current([$searchModel->formName() => ["year" => $year, "month" => $month_formatted]])) ?></li>
                    <?php
                    $last_year = $year;
                }
                ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'columns'      => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'card_number',
                    'date',
                    'volume',
                    'service',
                    'address_id',
                ],
            ]); ?>

        </div>

    </div>

</div>
