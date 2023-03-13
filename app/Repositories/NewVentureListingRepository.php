<?php


namespace App\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class NewVentureListingRepository extends BaseRepository
{
    function model()
    {
        return "App\\Models\\NewVentureListing";
    }
}
