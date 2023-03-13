<?php


namespace App\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;


class CurrentVentureListingRepository extends BaseRepository
{
    function model()
    {
        return "App\\Models\\CurrentVentureListing";
    }
}
