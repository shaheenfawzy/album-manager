<?php

namespace App\Policies;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PicturePolicy
{
    public function any(User $user, Picture $picture): bool
    {
        return $picture->load('album:id,user_id')->album->user_id === $user->id;
    }
    public function update(User $user, Picture $picture): bool
    {
        return $picture->load('album:id,user_id')->album->user_id === $user->id;
    }

    public function delete(User $user, Picture $picture): bool
    {
        return $picture->load('album:id,user_id')->album->user_id === $user->id;
    }
}
