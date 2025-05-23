<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    //
    use HasFactory;

    protected $table = 'upload_models';

    protected $fillable = [
        'title', 'subtitle', 'volume', 'authors', 'pages', 'file_path', 
        'doi_link', 'views', 'downloads', 'status', 'upload_status', 
        'users_id', 'alasan_penolakan', 'comment', 'keywords', 'rejection_reasons'
    ];
}
