<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\SupportTicket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupportTicketController extends ApiController
{
    public function index()
    {
        $user = auth()->user();
        $success = SupportTicket::with('lastMessage')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        return $this->sendResponse($success, 'Your tickets');
    }

    public function messages($ticket_num)
    {
        $user = auth()->user();
        $success['status'] = true;
        $success['messages'] = TicketMessage::with('user:id,photo')->where('ticket_num', $ticket_num)->where('user_id', $user->id)->get();
        $success['ticket'] = SupportTicket::where('ticket_num', $ticket_num)->where('user_id', $user->id)->first();
        return $this->sendResponse($success, 'Ticket messages of ' . $ticket_num);
    }

    public function openTicket(Request $request)
    {
        $validator = Validator::make($request->all(), ['subject' => 'required']);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $user = auth()->user();

        $tkt = 'TKT' . randNum(8);
       $ticket = SupportTicket::create([
            'user_id' => $user->id,
            'ticket_num' => $tkt,
            'subject' => $request->subject,
        ]);


        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->ticket_num = $ticket->ticket_num;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();
        
        $ticket->save();


        return $this->sendResponse(['ticket_num' => $tkt], 'New ticket has been opened');
    }

    public function replyTicket(Request $request, $ticket_num)
    {

        $request->validate([
            'message' => 'required',
        ]);

        $user = auth()->user();
        $ticket = SupportTicket::where('ticket_num', $ticket_num)->where('user_id', $user->id)
            ->first();
        if (!$ticket) {
            return $this->sendError('Ticket not fount');
        }
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->ticket_num = $ticket->ticket_num;
        $message->user_id = $user->id;
        $message->message = $request->message;
        $message->save();
        $ticket->status = 0;
        $ticket->save();
        return $this->sendResponse('success', 'Replied successfully');
    }

    public function closeTicket($ticket_num)
    {
        $user = auth()->user();
        $ticket = SupportTicket::where('ticket_num', $ticket_num)->where('user_id', $user->id)
            ->first();
        if (!$ticket) {
            return $this->sendError('Ticket not fount');
        }
        $ticket->status = 2;
        $ticket->save();
        return $this->sendResponse('success', 'Ticket closed successfully');
    }
}
