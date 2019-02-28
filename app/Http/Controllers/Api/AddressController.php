<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRecord;
use App\Http\Requests\CheckIP;
use App\Http\Requests\CheckURL;
use App\Repositories\AddressRepository;
use App\Services\GeoIP;
use App\Services\Models\HostName;
use App\Services\Models\IPAdress;
use App\Services\Models\URLAddress;
use App\Services\Resolver;
use App\Services\UrlToHostName;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * check geolocation data by ip
     * @param CheckIP $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\CurlError
     */
    public function index(CheckIP $request)
    {
        $ip = $request->get('address');
        $data = (new GeoIP())
            ->check(new IPAdress($ip));

        return response()->json($data);
    }

    /**
     * check geolocation data by url
     * @param CheckURL $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\CurlError
     */
    public function url(CheckURL $request)
    {
        $url = $request->get('address');

        try {
            $hostName = new UrlToHostName(new URLAddress($url));
        } catch (\Exception $wrongHostName) {
            return response()->json(['message' => 'Wrong URL address'], 422);
        }

        $ip = (new Resolver(new HostName((string)$hostName)))->resolve();
        $data = (new GeoIP())->check(new IPAdress((string) $ip));

        return response()->json($data);

    }

    /***
     * all user's addresses
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function myList(Request $request)
    {
        $repository = new AddressRepository();
        return response()->json($repository->usersRecords($request->user()->id));
    }

    /***
     * Remove address
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request, int $id)
    {
        $repository = new AddressRepository();

        if ($repository->remove($request->user()->id, $id)) {
            return response()->json(['message' => 'The record has been removed']);
        }

        return response()->json(['message' => 'You dont have an access to the record'], 401);
    }

    /***
     * Add address
     * @param AddressRecord $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(AddressRecord $request)
    {
        if (! $request->validated()) {
            return response()->json(['error' => $request->errors()], 401);
        }

        $repository = new AddressRepository();
        $address = $repository->saveAddress($request->user()->id, $request->all());

        return response()->json($address);
    }
}