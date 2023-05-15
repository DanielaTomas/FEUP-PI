<?php

namespace App\Http\Controllers;
use Spatie\Feed\Feed;
use Spatie\Feed\FeedItem;
use Illuminate\Http\Request;
use App\Models\Event;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedController extends Controller
{

    public function rss(Request $request){
        $events = Event::where('requeststatus','Accepted')->whereIn('requesttype', ['Edit', 'Create'])->orderBy('datereviewed', 'desc')->get();

        $feed = new Feed();
        /*
        $feed->title = 'Events RSS Feed';
        $feed->description = 'Here you can see the latest events.';
        $feed->link = url('/rss');
        
        $feed->setDateFormat('datetime');
        $feed->pubdate = $events->first()->datereviewed;
        $feed->lang = 'en';
        $feed->setShortening(true);
        $feed->setTextLimit(100);
        */

        
        /*
        foreach ($events as $event) {
            $feed->add([
                'title' => $event->title,
                'link' => url('/events/' . $event->slug),
                'guid' => $event->id,
                'pubDate' => $event->datereviewed,
                'description' => $event->description,
                'startDate' => $event->startdate,
                'endDate' => $event->enddate,
                'emailTechnical' => $event->emailtechnical,
            ]);
        }*/
        $feed->title('My Blog')
            ->description('This is the description of my blog.')
            ->link(url('/'))
            ->format('rss')
            ->pubdate(now())
            ->lang('en');

        foreach ($events as $event) {
            $feed->add(FeedItem::create()
                ->id($event->eventid)
                ->title($post->eventnameportuguese)
                ->description($event->description)
                ->updated($post->datereviewed)
                ->link(url('/events/'.$event->eventid))
                ->author($event->user->name)
            );
        }


        return $feed->render('atom');
    }
}
