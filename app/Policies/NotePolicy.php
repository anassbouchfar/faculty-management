<?php

namespace App\Policies;
use Auth;
use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;
    
    public function before($user,$ability){
        
        if($user->role_id==3 && $ability!='delete' && $ability!='update'  && $ability!='create' ){
            return true;
        }
    }
    /**
     * Determine whether the user can view any notes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        return true;
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $user=Auth::user()->role_id;
        return in_array($user, [4]);
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function update(User $user,$note)
    {
        //return $user->id === $note->user_id;
        return true;
        $user=Auth::user()->role_id;
        return in_array($user, [4]);
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
       // return $user->id === $note->user_id;
       //$user=Auth::user()->role_id;
       // return in_array($user, [4]);
       return true;
    }

    /**
     * Determine whether the user can restore the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function restore(User $user, Note $note)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the note.
     *
     * @param  \App\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function forceDelete(User $user, Note $note)
    {
        //
    }
    
}
