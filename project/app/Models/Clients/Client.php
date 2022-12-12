<?php

namespace App\Models\Clients;

use Cownet\Laravel\Uuid\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Client extends Model
{
    use SoftDeletes;
    
    protected $table = "clients";
    
    /**
     * To use UUID.
     * @var bool 
     */
    public $incrementing = false;
    
    public $timestamps = true;
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
    
    protected $casts = [
        'id' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function export() : array {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
