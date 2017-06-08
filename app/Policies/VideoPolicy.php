<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authorize all actions within a given policy group.
     *
     * @param User $user
     * @param $ability
     * @return bool|void
     */
    public function before(User $user, $ability)
    {
        if ($user->role && $user->role->name === 'ROLE_ADMIN') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the video.
     *
     * @param  User $user
     * @param  Video $video
     * @return bool
     */
    public function view(User $user, Video $video) : bool
    {
        return in_array($user->role->name, [
            'ROLE_WRITE',
            'ROLE_READ',
            'ROLE_DELETE'
        ]);
    }

    /**
     * Determine whether the user can create video.
     *
     * @param  User $user
     * @return bool
     */
    public function create(User $user) : bool
    {
        return in_array($user->role->name, [
            'ROLE_WRITE'
        ]);
    }

    /**
     * Determine if the given video can be updated by the user.
     *
     * @param User $user
     * @param Video $video
     * @return bool
     */
    public function update(User $user, Video $video) : bool
    {
        return in_array($user->role->name, [
            'ROLE_WRITE'
        ]);
    }

    /**
     * Determine whether the user can delete the video.
     *
     * @param  User $user
     * @param  Video $video
     * @return bool
     */
    public function delete(User $user, Video $video) : bool
    {
        return in_array($user->role->name, [
            'ROLE_DELETE'
        ]);
    }
}
