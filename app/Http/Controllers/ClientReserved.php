<?php

namespace App\Http\Controllers;

use App\Haircuts;
use Illuminate\Http\Request;
use App\Events\ClientReserved as Reserved;

class ClientReserved extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('reserve');
    }
    public function clients()
    {
        return view('clients');
    }

    public function clientsWaiting()
    {
        $listHaircuts = Haircuts::select('name', 'was_called','created_at', 'id')
        ->orderBy('id', 'asc')
        ->where('was_called','=',0)
        ->get();
    return $listHaircuts;
    }
    public function clientReserved(Request $request)
    {
        $name = $request->input('client');
        $haircut = new Haircuts;
        $haircut->name = $name;
        $haircut->save();
        broadcast(new Reserved($name));
        return ['status' => 'Client Reserved Haircut!'];
    }
    /*
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }
    */
    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);
		broadcast(new MessageSent(auth()->user(), $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }

    public function wasCalled($id)
    {
        $haircutClient = Haircut::find($id);
        $haircutClient->was_called = 1;
        $haircutClient->save();
    }
}
