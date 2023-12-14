<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardFile extends Model
{
    use HasFactory;
    public $table = 'board_file';
    protected $primaryKey = 'board_file_id';
    public $timestamps = false;
    protected $fillable = [
      'board_file_id',
      'saved',
      'origin',
      'board_id'
    ];

    public function boards()
    {
        return $this->belongsTo(Board::class);
    }
}
