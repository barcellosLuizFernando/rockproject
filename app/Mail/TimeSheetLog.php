<?php

namespace App\Mail;

use App\Models\Periodsheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimeSheetLog extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * TimeSheet Instance
     */
    protected $timesheet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Periodsheet $periodsheet)
    {
        $this->timesheet = $periodsheet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('RockIngleses - Registro de Ponto')
            ->view('emails.timesheetlog', ['timesheet' => $this->timesheet]);
    }
}
