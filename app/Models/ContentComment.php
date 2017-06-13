<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ContentComment
 * @package App\Models
 * @version June 13, 2017, 1:33 pm UTC
 */
class ContentComment extends Model
{

    public $table = 'content_comments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'comment',
        'contentsid',
        'usersid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'comment' => 'string',
        'contentsid' => 'integer',
        'usersid' => 'integer'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function content()
    {
        return $this->belongsTo(\App\Models\Content::class);
    }
}
