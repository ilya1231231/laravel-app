<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Contact;
use DateTime;

class TimeSendFromEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Contact::findEmail($value)){
            $userReviewDate = new DateTime((string) Contact::getLatestEmailsDate($value));
            $nowDate = new DateTime();
            $diffInHours = $userReviewDate->diff($nowDate);
            return ($diffInHours->days * 24) + $diffInHours->h >= 24;
          }
        return true;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.email_time_check');
        // return session('timeerror', 'Вы уже отправили сообщение');
    }
}
