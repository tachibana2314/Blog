<div>
  <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">新着記事</div>
</div>

@foreach ($contents as $content)

<div class="row pb-4">
  <div class="col-md-5">
    <div class="fh5co_hover_news_img" style="background-size: contain" >
      <div class="fh5co_news_img">
        <img src="{{ $content['thumbnail'] }}" alt=""/>
      </div>
      <div></div>
    </div>
  </div>
  <div class="col-md-7 animate-box">
    <a href="{{route('content', $content)}}" class="fh5co_magna py-2">{{$content['title']}}</a>
    <a href="{{route('content', $content)}}" class="fh5co_mini_time py-3"> Thomson Smith -
    April 18,2016 </a>
    <div class="fh5co_consectetur">
      <p>{{\Illuminate\Support\Str::limit($content->body, 100, '...')}}</p>
    </div>
  </div>
</div>
@endforeach
