<?php

namespace App\Repositories;

use App\Models\UserToken;
use App\Repositories\Abstracts\UserTokenRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class UserTokenRepositoryEloquent extends BaseRepository implements UserTokenRepository
{
    public function model()
    {
        return UserToken::class;
    }
}
