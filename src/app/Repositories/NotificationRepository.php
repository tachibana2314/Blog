<?php

namespace App\Repositories;

use App\Consts\CustomConst;
use App\Models\Information;
use Google\Cloud\Firestore\FirestoreClient;

class NotificationRepository implements NotificationRepositoryInterface
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'projectId' => env('FIREBASE_PROJECT_ID'),
        ]);
    }

    /**
     *
     * @return void
     */
    public function send(Information $information, $command_flg = false)
    {
        // 許可している全ユーザーにプッシュ通知を送る
        $push_users = $this->firestore->collection('tokens')->documents();
        if (!empty($push_users)) {
            foreach ($push_users as $v) {
                $tokens[] = $v->data()['token'];
            }
        }
        // 通知の内容
        $payload = array(
            'body' => $information['title'],
            'data' => array(
                'screen' => 'NewsDetail',
                'object' => $information,
            ),
            'sound' => 'default',
            'title' => 'News',
            'to' => $tokens,
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CustomConst::CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Accept-Encoding: gzip, deflate",
                "Content-Type: application/json",
                "cache-control: no-cache",
                "host: exp.host"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
        if ($command_flg) {
            return true;
        }
    }
}
