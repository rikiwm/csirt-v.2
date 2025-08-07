<?php

namespace App\Jobs;

use App\Models\WebVisitor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class WebVisitorJob implements ShouldQueue
{
    use Queueable;
    protected $ip;
    protected $agent;
    protected $mac;
    /**
     * Create a new job instance.
     */
    public function __construct($ip, $agent, $mac)
    {
        //
        $this->ip = $ip;
        $this->agent = $agent;
        $this->mac = $mac;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    $visitor = WebVisitor::where('ip_address', $this->ip)
                        ->whereDate('visited_at', today())
                        ->first();

    if (!$visitor) {
        WebVisitor::create([
            'ip_address' => $this->ip,
            'visited_at' => now(),
            'is_online' => true,
            'user_agent' => $this->agent,
            'mac_address' => $this->mac,
        ]);
    }
    }
}
