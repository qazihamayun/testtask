<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Website;
use App\Models\EmailLog;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Log;

class SendWebsitePostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-website-post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will go each website and its newly published post, and will send update in email to each website subscriber';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Website::with(['posts'=>fn($q)=>$q->where('status','published'), 'subscribers'])->chunk(100, function ($websites) {

            if($websites->count()  > 0) {
                foreach ($websites as $website) {

                    if($website->posts?->count() > 0) {
                        foreach ($website->posts as $post) {

                            // For each post, get the subscribers who haven't been emailed
                            if($website->subscribers?->count() > 0) {
                                foreach ($website->subscribers as $subscriber) {

                                    if (!EmailLog::where(['website_post_id'=>$post->id, 'user_id'=>$subscriber->id])->exists()) {

                                        SendEmailJob::dispatch($subscriber, $post);
                                        EmailLog::create(['website_post_id' => $post->id,'user_id' => $subscriber->id]); // Log the email
                                    }

                                }
                            }

                        }
                    }
                }
            }
        });
    }
}
