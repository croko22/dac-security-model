<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Note $note)
    {
        return $note->owner->id === $user->id ||
            $note->permissions()->where('user_id', $user->id)->where('permission', 'read')->exists();
    }

    public function update(User $user, Note $note)
    {
        return $note->owner->id === $user->id ||
            $note->permissions()->where('user_id', $user->id)->where('permission', 'write')->exists();
    }
}
