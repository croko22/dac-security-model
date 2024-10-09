<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permissions()
    {
        return $this->hasMany(NotePermission::class);
    }

    public function sharedUsers()
    {
        return $this->belongsToMany(User::class, 'note_permissions')
            ->withPivot('permission');
    }
}
