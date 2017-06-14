<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Content
 * @package App\Models
 * @version June 13, 2017, 1:33 pm UTC
 */
class Content extends Model
{

    public $table = 'contents';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'id_mineduc',
        'name',
        'subjectsid',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'id_mineduc' => 'string',
        'name' => 'string',
        'subjectsid' => 'integer'
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
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contentComments()
    {
        return $this->hasMany(\App\Models\ContentComment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function files()
    {
        return $this->hasMany(\App\Models\File::class);
    }
}
