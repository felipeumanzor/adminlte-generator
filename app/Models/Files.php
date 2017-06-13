<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Files
 * @package App\Models
 * @version June 13, 2017, 1:33 pm UTC
 */
class Files extends Model
{

    public $table = 'files';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'file_url',
        'content_url',
        'usersid',
        'contentsid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'file_url' => 'string',
        'content_url' => 'string',
        'usersid' => 'integer',
        'contentsid' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function content()
    {
        return $this->belongsTo(\App\Models\Content::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function fileComments()
    {
        return $this->hasMany(\App\Models\FileComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ratings()
    {
        return $this->hasMany(\App\Models\Rating::class);
    }
}
