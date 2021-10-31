<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public function gimmeAnswer(){
        return $this->hasOne(Answer::class);  //Пoлучить обдин обект через Contact

    }
}
