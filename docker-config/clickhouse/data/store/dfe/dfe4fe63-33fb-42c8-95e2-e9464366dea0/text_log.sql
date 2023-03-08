ATTACH TABLE _ UUID '530c6dcd-e29d-4a48-a461-36234c2e1b37'
(
    `event_date` Date,
    `event_time` DateTime,
    `event_time_microseconds` DateTime64(6),
    `microseconds` UInt32,
    `thread_name` LowCardinality(String),
    `thread_id` UInt64,
    `level` Enum8('Fatal' = 1, 'Critical' = 2, 'Error' = 3, 'Warning' = 4, 'Notice' = 5, 'Information' = 6, 'Debug' = 7, 'Trace' = 8, 'Test' = 9),
    `query_id` String,
    `logger_name` LowCardinality(String),
    `message` String,
    `revision` UInt32,
    `source_file` LowCardinality(String),
    `source_line` UInt64
)
ENGINE = MergeTree
PARTITION BY toYYYYMM(event_date)
ORDER BY (event_date, event_time)
SETTINGS index_granularity = 8192
