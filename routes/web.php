<?php
use App\AI\chat;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Http;


Route::get('/', function () {
    $chat = new Chat();

    $poem = $chat
      ->systemMessage("You are a poetic assistant, skilled in explaining complex programming  concepts with creative flair.")
      ->send('Compose a poem that explains the concept of recursion in programming.');

    $sillyPoem = $chat->reply('Cool, can you make it much, much siller.');

    return view('welcome',['poem'=>$sillyPoem]);
});
