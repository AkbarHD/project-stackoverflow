<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;

class AnswerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Answer $answer) : bool
    {
        // answer bisa di update ketika user yang sedang login adalah pemilik answer
        return $user->id === $answer->user_id;
    }

    public function delete(User $user, Answer $answer) : bool
    {
        // answer bisa di hapus ketika user yang sedang login adalah pemilik answer
        return $user->id === $answer->user_id;
    }
}
