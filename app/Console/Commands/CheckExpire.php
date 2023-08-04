<?php

namespace App\Console\Commands;

use App\Models\Device;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //CRON Aracılığı ile her 1 dakikada Expire datei geçen fakat iptal olmamış kayıtların os durumuna göre doğrulanıp güncellenmesi
        $records = Transaction::where('expire_date', '>', now())
            ->where('cancelled', false)//iptal olmamış
            ->where('processed', false)//onaylanmamış
            ->limit(10) //büyük dataları göz önünde bulundurarak örnek olarak her dakika başı 10 kayıt alıyoruz
            ->get();

        foreach ($records as $record) {
            $os = $record->os;

            // Oluşturulan Mock Api ile gönderilen receipt değeri eşleşiyorsa true döndürüyor.
            if ($os === 'ios') {
                $isValid = Http::post('http://172.27.0.5/api/checkOs', [
                    'receipt', $record->receipt
                ]);
            } elseif ($os === 'android') {
                $isValid = Http::post('http://172.27.0.5/api/checkOs', [
                    'receipt', $record->receipt
                ]);
            } else {
                $isValid = false;
            }

            if ($isValid->status() === 429) {//Eğer rate limit hatası dönerse
                $this->release(60); // 60 saniye sonra tekrar dene
                return;
            }

            if (isset($isValid) && $isValid) {
                $record->update(['processed' => true]);//onaylanırsa processed değerinin true yapılması
            } elseif (isset($isValid) && !$isValid) {
                $record->update(['retry_count' => DB::raw('retry_count + 1')]); // os değeri tanımsız ise onaylanmayıp tekrar sayısının tutulması.
            }
        }
    }
}
