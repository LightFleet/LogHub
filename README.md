<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://img.icons8.com/cute-clipart/512/log.png" height="100px">
    </a>
    <h1 align="center">LogHub</h1>
    <br>
</p>

This app serves a as a log sample service to monitor Nginx access.log

It uses Clickhouse as DB and Yii2 as a primary app backed.

INSTALLATION
------------

1. Clone repo
2. ```composer install```
3. ```cd app```
4. ```sudo bin/create_logs_files.sh```

All done! This will create access.log and error.log files respectively.

Now you can up the app via docker ```docker-compose.up```

**NOTES:** 
- Adjust ports to make sure they don't conflict with what you have on your local machine
- After first connection to php-fpm container make sure to call a migration file ```php yii clickhouse-migrate/create-logs-table```


USAGE
-------

 Connect to your php-fpm ```docker exec -it loghub-php-fpm bash```

 ```php yii access-log-monitoring/start-monitoring``` to start monitoring you access.log (go to localhost::8888 to have some entries in it)

 ```php yii access-log-query/query-between-dates --startDate=2023-03-08#12:40:10 --finishDate=2023-03-10#12:40:10``` to get results of saved access log entries from DB

 ```php yii access-log-query/query-count-between-dates``` to get entries count between dates