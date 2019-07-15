<?php
namespace frontend\controllers;

use yii\filters\ContentNegotiator;
use yii\web\Response;

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
}
