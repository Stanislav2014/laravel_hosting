<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Log;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use GuzzleHttp\Client;

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
        if (!isset($data['number'])) {
            return response(['error' => 'need number for calculate'], 400);
        }
        return response(['result' => Helper::getFibonacci($data['number'])]);
    }

    public function getDnsFields(Request $request)
    {
        $data = $request->all();
        if (!isset($data['domain']) || !isset($data['type'])) {
            return response(['error' => 'need domain and type for get dns fields'], 400);
        }

        try {
            $response = $this->client->request(
                'GET',
                'https://dns.google/resolve',
                [
                    'query' => "name={$data['domain']}&type={$data['type']}&cd=true&do=true",
                ]
            );

            return response(json_decode($response->getBody(), true));
        } catch (ClientException $e) {

            return response('Something wrong google service', $e->getCode());
        }
    }


    //Делает внутри контроллера запрос на получение значения DNS записи с https://dns
    //.google/resolve?name={{domain}}&type={{type}}&cd=true&do=true для
    //переданных значений domain и type .
}
