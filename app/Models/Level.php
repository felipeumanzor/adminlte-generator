<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Level
 * @package App\Models
 * @version June 13, 2017, 1:33 pm UTC
 */
class Level extends Model
{

    public $table = 'levels';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'cycle'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cycle' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function subjects()
    {
        return $this->hasMany(\App\Models\Subject::class);
    }
}
