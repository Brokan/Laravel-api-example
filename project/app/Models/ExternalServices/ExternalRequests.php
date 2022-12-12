<?php

namespace App\Models\ExternalServices;

use Cownet\Laravel\Uuid\Model;
use App\Models\Traits\EncryptsAttributes_v2;

/**
 * @property string $id
 * @property string $request_category
 * @property string $request_serive
 * @property string $request_action
 * @property string $request_date
 * @property string $request
 * @property string $response
 * @property string $error
 * @property string $created_at
 * @property string $updated_at
 */
class ExternalRequests extends Model
{
    use EncryptsAttributes_v2;
    
    protected $table = "external_requests";
    
    /**
     * To use UUID.
     * @var bool 
     */
    public $incrementing = false;
    
    public $timestamps = true;
    
    /**
     * List of fields to encrypt.
     * @var array 
     */
    protected $encrypts = [
        'request', 'response', 'error',
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_category',
        'request_serive',
        'request_action',
        'request_date',
        'request', 
        'response',
        'error'
    ];
    
    protected $casts = [
        'id' => 'string',
        'request_category' => 'string',
        'request_serive' => 'string',
        'request_action' => 'string',
        'request_date' => 'datetime',
        'request' => 'string',
        'response' => 'string',
        'error' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
