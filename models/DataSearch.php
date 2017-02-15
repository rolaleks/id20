<?php


namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class DataSearch extends Data
{

    public $count_month;
    public $month;
    public $year;


    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['year'], 'integer', 'max' => 3000],
                [['month'], 'integer', 'max' => 12],
            ]
        );
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Data::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'card_number' => $this->card_number,
            'YEAR(date)'  => $this->year,
            'MONTH(date)' => $this->month,
        ]);

        return $dataProvider;
    }

    /**
     * Prepares list of data grouped by month
     *
     * @param array $params
     *
     * @return app\models\Data[]
     */
    public function dateList($params)
    {

        $this->load($params);

        $result = DataSearch::find()->andFilterWhere([
            'card_number' => $this->card_number,
        ])->select(['COUNT(*) AS count_month', 'date'])->andFilterWhere([
            'card_number' => $this->card_number,
            'YEAR(date)'  => $this->year,
            'MONTH(date)' => $this->month,
        ])->groupBy('YEAR(date), MONTH(date)')->orderBy("date DESC")->all()
        ;

        return $result;


    }

    /**
     * Counts number of data in year provided
     *
     * @param array $dateList
     * @param int   $year
     *
     * @return int
     */
    public static function getYearCount($dateList = [], $year = 0)
    {
        $count_year = 0;
        foreach ($dateList as $month) {
            $month_year = \Yii::$app->formatter->asDate($month->date, 'yyyy');
            if ($year == $month_year) {
                $count_year += intval($month->count_month);
            }
        }

        return $count_year;
    }
    
}