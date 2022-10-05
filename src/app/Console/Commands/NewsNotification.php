<?php

namespace App\Console\Commands;

use App\Models\Information;
use App\Repositories\NotificationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NewsNotification extends Command
{
    /**
     * The name and signature of the console command.
     * artisanコマンドで呼び出す時のコマンド名を定義する
     * @var string
     */
    protected $signature = 'news:notification';

    /**
     * The console command description.
     * artisanコマンド一覧の出力時に表示される説明文、必須ではないが設定推奨
     * @var string
     */
    protected $description = '管理画面のお知らせをユーザーに通知する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        NotificationRepositoryInterface $notificationRepositoryInterface
    )
    {
        parent::__construct();
        $this->notificationRepositoryInterface = $notificationRepositoryInterface;
    }

    /**
     * Execute the console command.
     * 実際の処理をこのメソッド内に記述する
     * @return mixed
     */
    public function handle()
    {
        // 実行テスト->成功すればログに出力
        logger()->info('This is Push Notification Command.');
        // お知らせ（公開かつ今日）情報取得
        $information = Information::where('status', 1)
            ->whereNull('push_flg')
            ->where('release_date', '=', Carbon::today())
            ->get();
        if (!empty($information)) {
            foreach($information as $info){
                $this->notificationRepositoryInterface->send($info, true);
            }
        }
    }
}
