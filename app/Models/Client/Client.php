<?php

namespace App\Models\Client;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', // имя
        'last_name', // фамилия
        'surname', // отчество
        'mobile_number',
        'status_id', // статус клиента
        'agent_id', // id закреплённого агента
        'comment', // комментарий агента
        'cash_before', // сколько есть денег (float)
        'cash_after', // сколько получено денег (float)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //'',
        //'',
    ];

    /**
     * Get the client's full name.
     *
     * @return string
     */
    public function getClientFullName()
    {
        return "{$this->last_name} {$this->first_name} {$this->surname}";
    }

    /**
     *  Get the client's status name.
     *
     * @param int $status_id
     * @return string
     */
    public function getStatusName(int $status_id)
    {
        $statuses_arr = [
            1 => 'Новый',
            2 => 'В работе',
            3 => 'Обработан',
        ];

        return $statuses_arr[$status_id];
    }

    /**
     *  Get agent for client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agent()
    {
        return $this->hasOne(User::class, 'id', 'agent_id');
    }
}
