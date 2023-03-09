<?php

namespace app\modules\AccessLogMonitoring\Command;

use app\modules\AccessLogMonitoring\Usecase\Exception\DateStringIsNotInValidFormat;
use app\modules\AccessLogMonitoring\Usecase\Exception\StartDateIsGreatedThanFinishDate;
use app\modules\AccessLogMonitoring\Usecase\Service\LogQuery;
use Symfony\Component\Console\Exception\MissingInputException;
use yii\console\Controller;

class AccessLogQueryController extends Controller
{
    public $startDate;
    public $finishDate;

    public function options($actionID)
    {
        return ['startDate', 'finishDate'];
    }

    public function optionAliases()
    {
        return ['s' => 'startDate', 'f' => 'finishDate'];
    }

    public function actionQueryBetweenDates(LogQuery $logQuery)
    {
        echo PHP_EOL;

        try {
            if (!$this->startDate) {
                throw new MissingInputException('startDate is a required parameter');
            }
            if (!$this->finishDate) {
                throw new MissingInputException('finishDate is a required parameter');
            }

            $logs = $logQuery->queryBetweenDates($this->startDate, $this->finishDate);

            foreach ($logs as $log) {
                echo PHP_EOL . $log;
            }

        } catch (\Exception $e) {
            echo 'Error occurred: ' . $e->getMessage() . PHP_EOL;
        }

        echo PHP_EOL;
    }


}