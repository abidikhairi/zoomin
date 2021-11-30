<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NotificationController
{
    public function markNotificationAsRead(string $id)
    {
        DB::table('notifications')->where('id', $id)->update(['read_at'=> Carbon::now()]);
        return (new JsonResponse())->setStatusCode(Response::HTTP_OK);
    }
}
