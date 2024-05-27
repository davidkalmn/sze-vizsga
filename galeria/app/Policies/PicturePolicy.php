<?php
namespace App\Policies;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PicturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the picture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Picture $picture)
    {
        return $user->id === $picture->user_id;
    }

    /**
     * Determine whether the user can update the picture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Picture $picture)
    {
        return $user->id === $picture->user_id;
    }

    /**
     * Determine whether the user can delete the picture.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Picture $picture)
    {
        return $user->id === $picture->user_id;
    }
}
