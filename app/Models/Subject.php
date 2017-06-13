<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Subject
 * @package App\Models
 * @version June 13, 2017, 1:39 pm UTC
 */
class Subject extends Model
{

    public $table = 'subjects';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'levelsid',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'levelsid' => 'integer',
        'name' => 'integer'
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
    public function level()
    {
        return $this->belongsTo(\App\Models\Level::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function contents()
    {
        return $this->hasMany(\App\Models\Content::class);
    }
}
