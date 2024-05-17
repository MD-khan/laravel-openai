<?php

namespace App\AI;

use \Illuminate\Support\Facades\Http;

class Chat 
{
    protected array $messages = [];

    public function systemMessage( string $messages) : static
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => $messages
        ];

        return $this;
    }

    public function send(string $messages) : ?string
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $messages
        ];
        
        $response = Http::withToken(config('services.openai.secret'))
            ->post('https://api.openai.com/v1/chat/completions',[
            "model"=> "gpt-3.5-turbo",
            "messages"=> $this->messages,
              ])->json('choices.0.message.content');
        

        if ( $response ) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response
                ];
        }


        return $response;
    }

    public function reply( string $message ): ?string
    {
        return $this->send( $message );
    }

    public function messages()
    {
        return $this->messages;
    }
}