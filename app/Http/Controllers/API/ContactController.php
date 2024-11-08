<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'max:20'],
            'email' => ['required', 'email', 'max:30'],
            'subject' => ['required', 'max:255'],
            'text' => ['required']
        ]);

        try {
            $hari_ini = Carbon::now()->translatedFormat('Y-m-d');
            if ($validator->fails()) {
                return ResponseFormatter::validationError($validator->errors());
            }

            $cekPerhari = Inbox::whereDate('created_at', $hari_ini)->count();
            if ($cekPerhari > 2) {
                return ResponseFormatter::error(null, 'Sorry, you cannot provide feedback and suggestions at the moment due to a daily limit. Please visit me another time or you can contact me through WhatsApp or email. Thank you.');
            }

            $data = request()->only(['name', 'email', 'subject', 'text']);
            Inbox::create($data);
            return ResponseFormatter::success($data, 'Thank you for your feedback and suggestions.');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(null, 'Error Invalid');
        }
    }
}
