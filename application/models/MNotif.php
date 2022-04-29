<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../vendor/autoload.php';
use MrShan0\PHPFirestore\FirestoreClient;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\WebPushConfig;

class MNotif extends CI_Model {
    public function sendNotifAndroid($title, $message, $data)
    {
        $topic = 'a-topic';
        $factory = (new Factory)->withServiceAccount(FCPATH . 'js/google-services.json');
        $messaging = $factory->createMessaging();

        $config = AndroidConfig::fromArray([
        'ttl' => '3600s',
        'priority' => 'high',
        'notification' => [
            'title' => $title,
            'body' => $message,
            "click_action" => "com.resotim.goummatmobile",
            // "sound" => "dering_kooda.mp3",
            "channel_id" => "com.resotim.goummatmobile"
        ],
        ]);

        $message = CloudMessage::withTarget('topic', $topic)
            ->withData($data) // optional
            ->withAndroidConfig($config);
            
        // ->withDefaultSounds()
        //untuk per user
        // $message = CloudMessage::withTarget('token', $deviceToken)
        // ->withData($data) // optional
        // ->withAndroidConfig($config);

        return $messaging->send($message);
    }
}
