<div>
  <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
    {{$tag}} 新着記事
  </div>
</div>

@foreach ($contents as $content)

<div class="row pb-4">
  <div class="col-md-5">
    <div class="fh5co_hover_news_img" style="background-size: contain" >
      <div class="fh5co_news_img">
        <img src="{{ $content['image'] }}" width="100" height="40" alt=""/>
      </div>
      <div></div>
    </div>
  </div>
  <div class="col-md-7 animate-box">
    <a href="{{route('content.show', $content)}}" class="fh5co_magna py-2">{{$content['title']}}</a>
    <a href="{{route('content.show', $content)}}" class="fh5co_mini_time py-3">{{$content['release_date']}}</a>
    <div class="fh5co_consectetur">
      <p>{{ $content['overview'] }}</p>
    </div>
  </div>
</div>
@endforeach
