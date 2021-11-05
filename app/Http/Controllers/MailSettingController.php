<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\{Contact, Answer};
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;



class MailSettingController extends Controller
{
    public function sendRiview(ContactRequest $request)
    {
        $Review = new Contact();
        return $Review->takeContactData($request);
    }

    public function sendReplyToRiview(Request $request, int $statusId)
    {
        $request->validate([
          "text-$statusId" => 'required|max:1024',
        ]);
        $Answer = new Answer();
        return $Answer->takeAnswerData($request, $statusId);
    }
}
