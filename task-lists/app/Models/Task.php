<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'long_description',
        // 'completed', // Uncomment if you want to allow completed status
    ];
    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        $this->save();
    }
}
