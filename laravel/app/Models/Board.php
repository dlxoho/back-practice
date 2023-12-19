<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    public $table = 'board';
    protected $primaryKey = 'board_id';
    public $timestamps = false;

    protected $fillable = [
        'board_id',
        '__uid',
        'contents',
        'created_at',
        'updated_at'
    ];
    public function files()
    {
        return $this->hasMany(BoardFile::class);
    }
}
