<?php

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['iamJSON' => 'API ACI Fullstack developer depends on Docker In system administration, orchestration is the automated configuration, coordination, and management of computer systems and software.']);
});

Route::get('/oauth-aci', function (Request $request) {

    $client = new Client([
        'headers' => ['Content-Type' => 'application/json']
    ]);

    $response = $client->post(
        'https://devel.bebasbayar.com/web/test_programmer.php',
        ['body' => json_encode(
            [
                'user' => $request->user,
                'password' => $request->password
            ]
        )]
    );

    $data = json_decode($response->getBody()->getContents(), true);

    if ($data['rd'] == "Sukses") {

        $auth = ['user' => $request->user, 'password' => $request->password];

        $data = User::updateOrCreate($auth, ['user' => $request->user, 'password' => $request->password]);

        $data = User::first();
        /**
         * if data successfully insert, but not update
         * 
         * {
                "response": {
                    "user": "admin",
                    "updated_at": "2022-07-19T13:34:49.000000Z",
                    "created_at": "2022-07-19T13:34:49.000000Z",
                    "id": 1
                }
            }
         */
    } else {

        /**
         * If data Invalid user/password
         * 
         * {
                "response": {
                    "rc": "01",
                    "rd": "Invalid user/password"
                }
            }
         */
        $data = $data;
    }

    return response()->json(['response' => $data]);
});
