<?php

namespace app\commands;

use app\helpers\Helper;
use app\models\Queue;
use yii\console\Controller;
use yii\console\ExitCode;

class QueueController extends Controller
{
    /**
     * @return int
     */
    public function actionProcess(): int
    {
        $queue = Queue::find()
            ->with(['file'])
            ->andWhere(['status' => 'new'])
            ->asArray()
            ->all();

        foreach ($queue as $item) {
            $q = Queue::find()->where(['id' => $item['id']])->one();

            try {
                $q->status = 'processing';
                $q->save();
                Helper::callML($item['file']['url']);

                // Заполнение данных
                Helper::writeData();

                $q->status = 'completed';
                $q->save();
            } catch (\Exception $e) {
                $q->status = 'failed';
            }
        }

        return ExitCode::OK;
    }
}