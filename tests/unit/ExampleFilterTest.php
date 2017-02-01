<?php

namespace pastuhov\logstock\tests\unit;

use pastuhov\logstock\filters\DynamicDataFilter;
use Yii;
use yii\codeception\TestCase;
use yii\console\Application;

class ExampleFilterTest extends TestCase
{
    public function testExampleFilterUsage()
    {
        \Yii::$app->getModule('logstock')->addFilter(new DynamicDataFilter());

        $this->tester->assertLog(function (){
            Yii::info('Test session');
            Yii::$app
                ->getDb()
                ->createCommand(
                    "SELECT * FROM session WHERE expire < :EXPIRED",
                    [
                        ':EXPIRED' => date('c'),
                    ]
                )->execute();
        }, Yii::$app);
    }

    protected function _before()
    {
        $config = require('tests/app/config/console.php');
        $config['class'] = Application::class;
        $this->mockApplication($config);
    }
}
