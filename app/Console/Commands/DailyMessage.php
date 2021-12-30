<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send best wishes daily.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $messages = [
            'Good Morning!.',
            'Good afternoon!.',            
            'Good evening!.',
        ];
         
         
        // Setting up a random word
        $key = array_rand($messages);
        $data = $messages[$key];
         
        $users = User::all();
        foreach ($users as $user) {
            Mail::raw("{$key} -> {$data}", function ($mail) use ($user) {
                $mail->from('chochakomal@gmail.com');
                $mail->to($user->email)
                    ->subject('Welcome!');
            });
        }
         
        $this->info('Message sent.');
    }
}