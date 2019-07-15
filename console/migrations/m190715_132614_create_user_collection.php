<?php

class m190715_132614_create_user_collection extends \yii\mongodb\Migration
{
    public function up()
    {
        $this->createCollection('user');
    }

    public function down()
    {
        $this->dropCollection('user');
    }
}
