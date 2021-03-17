<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Log;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;

    }

    public function calculateFibonacci(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'number' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['result' => $validator->messages()], 400);
        }
        return response(['result' => Helper::getFibonacci($data['number'])]);
    }

    public function getDnsFields(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'domain' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['result' => $validator->messages()], 400);
        }

        try {
            $response = $this->client->request(
                'GET',
                'https://dns.google/resolve',
                [
                    'query' => "name={$data['domain']}&type={$data['type']}&cd=true&do=true",
                ]
            );
            return response(['result' => json_decode($response->getBody(), true)]);
        } catch (ClientException $e) {

            return response(['result' => 'Something wrong google service'], $e->getCode());
        }
    }
}
