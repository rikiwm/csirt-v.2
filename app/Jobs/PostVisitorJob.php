<?php

namespace App\Jobs;

use App\Models\ViewVisitor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PostVisitorJob implements ShouldQueue
{
    use Queueable;

    protected $postId;
    protected $ip;

    public function __construct($postId, $ip)
    {
        $this->postId = $postId;
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $alreadyVisited = ViewVisitor::where('post_id', $this->postId)
            ->where('ip_address', $this->ip)
            ->whereDate('visited_at', today())
            ->exists();

        if (!$alreadyVisited) {
            ViewVisitor::create([
                'post_id' => $this->postId,
                'ip_address' => $this->ip,
                'visited_at' => now(),
            ]);
        }
    }
}
