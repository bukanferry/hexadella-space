<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\HavenellaPost;
use App\Models\HavenellaVote;

#[Signature('purge {keyword}')]
#[Description('Takedown Havenella posts containing a specific keyword')]
class PurgeHavenella extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keyword = $this->argument('keyword');
        $this->info("Locating posts containing the keyword: '{$keyword}'");

        $posts = HavenellaPost::where('content', 'like', '%' . $keyword . '%')->get();

        if ($posts->isEmpty()) {
            $this->warn("No posts detected.");
            return;
        }

        $count = $posts->count();
        if ($this->confirm("Detected {$count} posts. Proceed with permanent incineration?")) {
            foreach ($posts as $post) {
                HavenellaVote::where('havenella_post_id', $post->id)->delete();
                $post->delete();
            }
            $this->info("{$count} posts successfully incinerated without a trace.");
        } else {
            $this->info("Operation aborted.");
        }
    }
}
