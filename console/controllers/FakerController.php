<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use Faker\Factory;
use yii\db\Expression;
use common\models\Note;
use common\models\User;

/**
 * Provides fake data.
 * @package app\commands
 */
class FakerController extends Controller
{
    public $count = 1;

    public function options($action_id)
    {
        return ['count'];
    }

    public function optionAliases()
    {
        return ['c' => 'count'];
    }

    /**
     * Add random users. Params: [-count, -c] - Count of users,
     */
    public function actionAddRandomUser()
    {
        $faker = Factory::create();

        for ( $i = 1; $i <= $this->count; $i++ )
        {
            $user = new User();
            $user->email = $faker->email;
            $user->firstName = $faker->firstName;
            $user->lastName = $faker->lastName;

            $user->save();
        }
    }

    /**
     * Add random notes. Params: [-count, -c] - Count of notes,
     */
    public function actionAddRandomNote()
    {
        $faker = Factory::create();

        for ( $i = 1; $i <= $this->count; $i++ )
        {
            $userCollection = Yii::$app->mongodb->getCollection('user');
            $result = $userCollection->aggregate([
                [
                    "\$sample" => ["size"=>1]
                ]
            ]);

            $note = new Note();
            $note->name = $faker->title;
            $note->description = $faker->text;
            $note->_authorId = isset($result[0]) ? (string)$result[0]['_id'] : null;

            $note->save();
        }
    }
}
