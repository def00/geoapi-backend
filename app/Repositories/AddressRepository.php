<?php declare(strict_types=1);

namespace App\Repositories;


use App\Models\Address;

class AddressRepository
{
    public function saveAddress(int $userId, array $geoInfo)
    {
        $address = new Address($geoInfo);
        $address->user_id = $userId;
        $address->save();

        return $address;
    }

    public function usersRecords(int $userId)
    {
        return Address::where('user_id', $userId)->get();
    }

    public function remove(int $userId, int $id)
    {
        $address = Address::where('user_id', $userId)->where('id', $id)->first();

        if ($address) {
            return $address->delete();
        }

        return false;
    }
}