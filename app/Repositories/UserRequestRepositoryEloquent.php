<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRequestRepository;
use App\Entities\UserRequest;
use App\Validators\UserRequestValidator;

/**
 * Class UserRequestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRequestRepositoryEloquent extends BaseRepository implements UserRequestRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserRequest::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
