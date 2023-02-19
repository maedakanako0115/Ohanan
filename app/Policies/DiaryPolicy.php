<?php

namespace App\Policies;

use App\Diary;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiaryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any diaries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the diary.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function view(User $user, Diary $diary)
    {
        return $user->id === $diary->user_id;
    
    }

    /**
     * Determine whether the user can create diaries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the diary.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function update(User $user, Diary $diary)
    {
        //
    }

    /**
     * Determine whether the user can delete the diary.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function delete(User $user, Diary $diary)
    {
        //
    }

    /**
     * Determine whether the user can restore the diary.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function restore(User $user, Diary $diary)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the diary.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function forceDelete(User $user, Diary $diary)
    {
        //
    }
}
