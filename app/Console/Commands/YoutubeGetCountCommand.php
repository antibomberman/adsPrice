<?php

namespace App\Console\Commands;

use App\Models\BloggerOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class YoutubeGetCountCommand extends Command
{
    protected $signature = 'youtube:get-count';

    protected $description = 'Command description';

    public function handle()
    {
        $bloggerOrders = BloggerOrder::whereNotNull('url')->get();

        foreach ($bloggerOrders as $bloggerOrder) {
            $parts = parse_url($bloggerOrder->url);
            if (!isset($parts['query'])) continue;
            $id = null;
            parse_str($parts['query'], $id);
            $response = Http::get('https://www.googleapis.com/youtube/v3/videos',[
                'part' => 'statistics',
                'id' => $id['v'],
                'key' => 'AIzaSyAs8pt3bbdWetRPSd8dXHa4RVONge_KQmQ'
            ]);
            if ($response->status() != 200) continue;
            $data = $response->json();
            if (!isset($data['items'])) continue;
            if (!isset($data['items'][0])) continue;
            if (!isset($data['items'][0]['statistics'])) continue;
            if (!isset($data['items'][0]['statistics']['viewCount'])) continue;
            if (!isset($data['items'][0]['statistics']['likeCount'])) continue;

            $bloggerOrder->video_view_count = $data['items'][0]['statistics']['viewCount'];
            $bloggerOrder->video_like_count = $data['items'][0]['statistics']['likeCount'];
            $bloggerOrder->save();

        }
    }

}
