<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends User
{
    use HasFactory;

    protected $fillable = [
        'profile', 'role'
    ];


    public function changePassword($newPassword)
    {
        $this->password = bcrypt($newPassword);
        $this->save();
    }

    public function logout()
    {
        auth()->logout();
    }

    public function getHelp()
    {
        return "Contact support for assistance.";
    }
}
