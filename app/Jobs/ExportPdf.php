<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\DataKegiatan;
use PDF;
use ZipArchive;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ExportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    // public $tries = 5;
    // public $timeout = 900;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $r_from=strtotime($this->details['from']);
        $r_to=strtotime("+23 hours +59 minutes +59 seconds", strtotime($this->details['to']));
        $query = DataKegiatan::whereBetween('created_at', [strftime("%Y-%m-%d %H:%M:%S", $r_from), strftime("%Y-%m-%d %H:%M:%S", $r_to)])->get();
        
        $name_dir = Str::random(10);
        if(count($query)) {
            $missing = Storage::disk('pdf')->makeDirectory($name_dir);

            foreach ($query as $data) {
                $created=strftime("%d.%m.%y-%H.%M", strtotime($data->created_at));
                PDF::loadView('exportpdf',['data'=>$data])->setPaper('a4', 'potrait')->setWarnings(false)->save(public_path('storage/doc/pdf/'.$name_dir.'/'.$created.'-'.$data->pelanggan->id_pelanggan.'.pdf'));
            }
    
            $zip = new ZipArchive;
            $name_zip = public_path('storage/doc/pdf/'.$this->details['name_zip']);
    
            if (true === ($zip->open(strftime($name_zip), ZipArchive::CREATE))) {
                foreach (Storage::disk('pdf')->allFiles($name_dir) as $file) {
                    $name = basename($file);
                    if ($name !== '.gitignore') {
                        $zip->addFile(public_path('storage/doc/pdf/'.$name_dir.'/'.$name), $name);
                    }
                }
                $zip->close();
            }
    
            Storage::disk('pdf')->deleteDirectory($name_dir);
        }
    }
}
