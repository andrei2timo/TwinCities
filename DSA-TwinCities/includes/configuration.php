<?php
    namespace TwinCities;

    @date_default_timezone_set("GMT");
    
    // Set API keys
    define('OPEN_WEATHER_API_KEY', '793769e7926a4bf2131e3bf791ec2aa2');
    define('BING_MAPS_API_KEY', 'AtI99eYl4nVkKrwBZU6M27NZvG4tsbXqLCq-dywDtbKWpNAHrDrZZPthg2BSmg3j');

    // Twitter Keys
    define('TWITTER_OAUTH_ACCESS_TOKEN', '999595423668064256-ffAYYtPLXXsp2XJMfkvBncFqBcm1IYP');
    define('TWITTER_OAUTH_ACCESS_TOKEN_SECRET', 'Ctsiak1h5iYFy9Q5aFK9VUML8d7pyVZ0mgFSHnzrCmmUP');
    define('TWITTER_CONSUMER_KEY', 'YlRIjuEdDY4gGYdNQN4VDccq9');
    define('TWITTER_CONSUMER_SECRET_KEY', 'ymewwTaSm99ZProdwBjSCZ27OTPQDnO4HmUNE6XigYMgZlwirx');


    // Set the database settings
    define('DATABASE', [
        'HOST' => 'localhost',
        'DB' => 'twincitiesdb',
        'USERNAME' => 'root',
        'PASSWORD' => ''
    ]);

?>