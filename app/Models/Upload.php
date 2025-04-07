<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadModel extends Model
{
    use HasFactory;

    protected $table = 'upload_models';

    protected $fillable = [
        'title',
        'subtitle',
        'authors',
        'pages',
        'file_path',
        'doi_link',
        'views',
        'downloads'
    ];
}
