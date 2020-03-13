<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function index($chatWith)
    {
        $conversations = DB::select('
            SELECT t1.*,t3.username
            FROM messages AS t1
            LEFT OUTER JOIN users t3 ON t3.id
            INNER JOIN
            (
                SELECT
                    LEAST(user_id, recipient_to) AS user_id,
                    GREATEST(user_id, recipient_to) AS recipient_to,
                    MAX(id) AS max_id,
                FROM messages
                GROUP BY
                    LEAST(user_id, recipient_to),
                    GREATEST(user_id, recipient_to)
            ) AS t2
                ON LEAST(t1.user_id, t1.recipient_to) = t2.user_id AND
                   GREATEST(t1.user_id, t1.recipient_to) = t2.recipient_to AND
                   t1.id = t2.max_id
                WHERE t1.user_id = ? OR t1.recipient_to = ?
            ',[Auth::user()->id, Auth::user()->id]);
        $data["conversations"] = $conversations;
        $agent = new Agent();
        if ( $agent->isMobile() ) {
            return view('user.chat_mobile');
        }
        else
        {
            return view('user.chat')->with($data);
        }
    }
}
