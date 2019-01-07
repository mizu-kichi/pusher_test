<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Pusher\Pusher;

class TestPusher1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test-pusher1{message : 送信するメッセージ}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '極力PUSHERのサンプルコードのままver';

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
     * @return mixed
     */
    public function handle()
    {
        // コマンドライン引数から送信内容を取得
        $message = $this->argument('message');

        // ここにサンプルコードを貼り付け
        $options = array(
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.encrypted')
        );
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            $options
        );

        $data['message'] = $message;
        $pusher->trigger('my-channel', 'my-event', $data);

        $this->info($message . " を送信しました！");
    }
}
