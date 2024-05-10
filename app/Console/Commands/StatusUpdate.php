<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Consultation;
use Carbon\Carbon;

class StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultation:statusUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consultation status update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $curr= Carbon::now('GMT+7')->format('Y-m-d H:i:s');

        # Coming Soon status to On Going / Finished
        $comingsoons = Consultation::where('status', 'coming soon')->get();
        foreach($comingsoons as $css) {
            $consDate = Carbon::parse($css->consult_datetime);
            $consEndDate = Carbon::parse($css->end_consult_datetime);

            $minuteStart = $consDate->diffInMinutes($curr);
            $minuteEnd = $consEndDate->diffInMinutes($curr);

            if($minuteStart >= 0 && $minuteEnd < 0){
                Consultation::where('id', $css->id)->update(['status' => 'on going']);
            } elseif($minuteStart > 0 && $minuteEnd >= 0) {
                Consultation::where('id', $css->id)->update(['status' => 'finished']);
            }
        }

        # On Going status Finished
        $ongoings = Consultation::where('status', 'on going')->get();
        foreach($ongoings as $og) {
            $consDateF = Carbon::parse($og->consult_datetime);
            $consEndDateF = Carbon::parse($og->end_consult_datetime);

            $minuteStartF = $consDateF->diffInMinutes($curr);
            $minuteEndF = $consEndDateF->diffInMinutes($curr);

            if($minuteStartF > 0 && $minuteEndF >= 0){
                Consultation::where('id', $og->id)->update(['status' => 'finished']);
            }
        }
    }
}
