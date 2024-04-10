<?php

namespace App\Policies;

use App\Models\Album;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlbumPolicy
{
    public function any(User $user, Album $album): bool
    {
        return $album->user_id === $user->id;
    }

    public function view(User $user, Album $album): bool
    {
        return $album->user_id === $user->id;
    }

    public function update(User $user, Album $album): bool
    {
        return $album->user_id === $user->id;
    }

    public function delete(User $user, Album $album): bool
    {
        return $album->user_id === $user->id;
    }
}
