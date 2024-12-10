<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Services\SuratDisposisiServices;
use App\Services\SuratKeluarServices;
use App\Services\SuratMasukServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotificationDisposisi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//    Instance surat Keluar \App\Models\SuratKeluar
    protected $nomorSurat, $suratPerihal, $tglSurat;
    protected $opdID;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($nomorSurat, $suratPerihal, $tglSurat, $opdID)
    {
        //
        $this->nomorSurat = $nomorSurat;
        $this->suratPerihal = $suratPerihal;
        $this->tglSurat = $tglSurat;
        $this->opdID = $opdID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $idOPD = $this->opdID;
        $user = User::whereHas('opd', function ($q) use($idOPD) {
            $q->where('id_opd', $idOPD);
        })->first();
        if ($user->email != null) {
            $email = $user->email;
            $template = 'mail.surat_disposisi';
            $dataSurat = [
                'subject' => 'Surat telah diterima!',
                'from_nama' => env('APP_NAME'),
                'perihal' => $this->suratPerihal,
                'noSurat' => $this->nomorSurat,
                'tanggalSurat' => $this->tglSurat
            ];

            Mail::to($email)->queue(new SendMail($template, $dataSurat));
        }
    }

    public function middleware() {
        return [new ThrottlesExceptions(5, 5)];
    }

    public function retryUntil() {
        return now()->addMinutes(5);
    }
}
