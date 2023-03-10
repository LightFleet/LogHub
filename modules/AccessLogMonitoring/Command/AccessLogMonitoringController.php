<?php

namespace app\modules\AccessLogMonitoring\Command;

use app\modules\AccessLogMonitoring\Infrastructure\Exception\AccessLogNotAvailable;
use app\modules\AccessLogMonitoring\Usecase\Service\LogMonitor;
use app\modules\AccessLogMonitoring\Usecase\Service\LogQuery;
use yii\console\Controller;

class AccessLogMonitoringController extends Controller
{
    private const ACCESS_LOG_PATH = '/log/access.log';

    public function actionStartMonitoring(LogMonitor $logMonitor)
    {
        $logFilePath = $this->getAccessLogFilePath();

        try {
            $handle = fopen($logFilePath, "r");
            if ($handle === false) {
                throw new AccessLogNotAvailable('An error occurred while trying to open the access log!');
            }

            echo PHP_EOL;
            echo 'Monitoring started...';
            echo PHP_EOL;

            $logMonitor->monitor($handle, $logFilePath);

        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        fclose($handle);
    }

    public function actionQueryByDate(LogQuery $logQuery)
    {

    }

    private function getAccessLogFilePath(): string
    {
        return \Yii::getAlias('@app') . self::ACCESS_LOG_PATH;
    }
}