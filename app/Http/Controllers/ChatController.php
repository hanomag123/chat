<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Filters\MessageFilter;
use App\Http\Requests\MessageFormRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
  public function index()
  {
    $chats = Chat::all();
    return view('dashboard', compact('chats'));
  }

  public function chat(Chat $id) {
    $chats = Chat::all();
    $chat = $id;
    return view('chat', compact('chat', 'chats'));
  }

  public function create(Request $request) {
    if (isset($request, $request->name)) {
      Chat::create([
        'name' => $request->name
      ]);

      return redirect()
      ->back()
      ->withInput();
    }
  }

  public function messages (Request $request) {
    if (isset($request, $request->chat)) {
      $messages = Message::query()->with('user')->where('chat_id', $request->chat)->get();
      return $messages;
    }
  }

  public function send(MessageFormRequest $request) {
    $message = $request->user()->messages()->create(['chat_id' => $request->chat_id, ...$request->validated()]);

    broadcast(new MessageSend($request->user(), $message, $request->chat_id));
    
    return $message;
  }

  public function filter(MessageFilter $filter) { 
    $messages = Message::orderBy('created_at', 'desc')->filter($filter)->get();
    return ['messages' => $messages];
  }

}
