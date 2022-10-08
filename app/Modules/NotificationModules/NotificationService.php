<?php

namespace App\Modules\NotificationModules;

use Illuminate\Http\Request;

class NotificationService
{
    public function prepare(array $tokens, $title, $description, $icon, $link=null)
    {
        $prepared = new Request();
        $prepared->setMethod('POST');
        $prepared->request->add([
            'FcmToken' => $tokens,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'link' => $link,
        ]);

        return $prepared;
    }

    public function send(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization:key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'registration_ids' => $request->FcmToken,
            'notification' => [
                'title' => $request->title,
                'body' => $request->description,
                'image' => $request->icon,
            ],
            'fcm_options' => [
                'link' => $request->link,
            ],
        ]));

        $result = curl_exec($ch);

        curl_close($ch);

        return response()->json($result);
    }
}