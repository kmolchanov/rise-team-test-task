<?php
namespace frontend\controllers;

use yii\filters\ContentNegotiator;
use yii\web\Response;
use frontend\models\NoteSearch;

class NoteController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\models\Note';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['view']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['options']);

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new NoteSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
