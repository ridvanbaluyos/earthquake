@extends("amp.layouts.default")

@section("content")
<div id="content-wrapper">
    <div id="main-wrapper">
        <div class="main section" id="main"><div class="widget Blog" data-version="1" id="Blog1">
            <div class="blog-posts hfeed">
                <div class="date-outer">
                    <div class="date-posts">
                        @foreach ($data["earthquakes"]->features as $earthquake)
                        <div class="post-outer">
                            <article class="post hentry" itemscope="itemscope" itemtype="http://schema.org/Blog">
                                <a href="">
                                    <amp-img
                                            alt="thumbnail"
                                            height="300"
                                            width="400"
                                            layout="responsive"
                                            src="https://maps.googleapis.com/maps/api/staticmap?center={{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&markers=color:red|{{ $earthquake->geometry->coordinates[1] }},{{ $earthquake->geometry->coordinates[0] }}&zoom=6&size=400x300&maptype=roadmap&key={{ config("app.google_maps_api_key") }}"
                                    >
                                    </amp-img>
                                </a>
                                <div class="post-inner">
                                    <h2 class="post-title entry-title" itemprop="headline">
                                        <a href="/earthquakes/{{ $earthquake->id }}" itemprop="url" rel="bookmark">
                                            {!! App\Helpers\Charts\ChartHelper::getMagnitudeLabel($earthquake->properties->mag, 'richter', false) !!}
                                        </a>
                                    </h2>
                                    <div class="post-header">
                                        <div class="post-header-line-1">
                                            {{ $earthquake->properties->title }}
                                        </div>
                                    </div>
                                    <div class="post-body entry-content" id="post-body-320903767827691939">
                                        <div class="post-snippet">
                                            <small>
                                                {{ \App\Helpers\DateHelper\DateHelper::convertDate($earthquake->properties->time) }}
                                            </small>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <aside id="sidebar-wrapper">
        <div class="sidebar no-items section" id="sidebar"></div>
    </aside>
    <div class="clear">&#160;</div>
</div>
@endsection