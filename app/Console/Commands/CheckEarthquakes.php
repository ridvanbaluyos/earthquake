<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\EarthquakeRepository;
use Carbon\Carbon;

class CheckEarthquakes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'earthquakes:check {minutes=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for Earthquakes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $minutes = $this->argument('minutes');
        //
        echo self::log('[Starting ' . Carbon::create() . ']', 'info');
        echo self::log('[Setting timezone to UTC]', 'info');
        date_default_timezone_set('UTC');

        echo self::log('[Checking for earthquakes in the last '. $minutes .' minute(s)]', 'info');
        echo self::log('[Fetching data from U.S. Geological Survey]', 'info');
        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
            'starttime' => date('Y-m-d H:i:s', strtotime('-' . $minutes . ' minutes')),
            'limit' => '10'
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->getEarthquakes($params);

        if (empty($earthquakes->features)) {
            echo self::log('[Hoooray! No earthquakes found!]', 'success');
        } else {
            echo self::log('[' . count($earthquakes->features) .' earthquake(s) found!]', 'alert');
            $message = count($earthquakes->features) . ' earthquake(s) found!';
            $message .= "\n";

            foreach ($earthquakes->features as $earthquake) {
                $message .= ' ' . $earthquake->properties->title;
                $message .= "\n";

                echo self::log('[' . \App\Helpers\DateHelper\DateHelper::convertDate($earthquake->properties->time) . ': ' . $earthquake->properties->title . ']', 'alert');
            }

            echo self::log('[Sending notifications to subscribers]', 'info');
            echo self::log('Sending SMS content below', 'debug');
            echo self::log($message, 'debug');

            $smsResponse = self::sendSms($message);
            $smsResponse = json_decode($smsResponse, true);

            if (isset($smsResponse[0]['message_id'])) {
                echo self::log('[Message sent to ' . config('app.my_number') . ']', 'success');
            } else {
                echo self::log('[Message failed to ' . config('app.my_number') . ']', 'alert');
                echo self::log('[' . $smsResponse[0] . ']', 'alert');
            }
        }

        echo self::log('[End ' . Carbon::create() . ']', 'info');

    }

    // TODO: Transfer these functions to the correct repository
    private static function log($text, $level = 'debug')
    {
        switch ($level) {
            case 'info':
                $color = '[1;33m';
                break;
            case 'success':
                $color = '[0;32m';
                break;
            case 'warning':
                $color = '[1;33m';
                break;
            case 'alert':
                $color = '[1;31m';
                break;
            case 'debug':
                $color = '[1;37m';
                break;
            default:
                $color = '[1;37m';
                break;
        }

        return chr(27) . $color . strtoupper($level) . ': ' . $text  . chr(27) . "[0m\n";
    }

    private static function sendNotifications()
    {

    }

    // semaphore
    private static function sendSms($message, $debug = false)
    {
        if ($debug) {
            return '[{"message_id":46811653412342,"user_id":2976121,"user":"user@user.com","account_id":2907111,"account":"Test","recipient":"639231000001","message":"3 earthquake(s) found!\n M 5.3 - 12km E of Burgos, Philippines\n M 4.5 - 157km SE of Pondaguitan, Philippines\n M 4.9 - 10km ENE of Bangonay, Philippines\n","sender_name":"Semaphore","network":"Smart","status":"Queued","type":"Single","source":"Api","created_at":"2017-04-23 16:05:05","updated_at":"2017-04-23 16:05:06"}]';
        }

        $ch = curl_init();
        $parameters = array(
            'apikey' => config('app.semaphore_api_key'),
            'number' => config('app.my_number'),
            'message' => $message,
//            'sendername' => config('app.semaphore_sender')
        );
        curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;
    }
}
