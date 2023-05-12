<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>{{ $feed->title }}</title>
        <link>{{ $feed->link }}</link>
        <description>{{ $feed->description }}</description>
        <language>{{ $feed->lang }}</language>
        <pubDate>{{ $feed->pubdate->toRssString() }}</pubDate>
        <lastBuildDate>{{ $feed->updated->toRssString() }}</lastBuildDate>
        <ttl>1800</ttl>

        @foreach($feed->items as $item)
        <item>
            <title>{{ $item->title }}</title>
            <link>{{ $item->link }}</link>
            <id>{{ $item->id }}</id>
            <pubDate>{{ $item->updated->toRssString() }}</pubDate>
            <description>{{ $item->description }}</description>
            {{-- <content:encoded><![CDATA[{{ $item->content }}]]></content:encoded> --}}
        </item>
        @endforeach
    </channel>
</rss>