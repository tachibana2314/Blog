<div class="container animate-box">
  <div>
    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">人気記事</div>
  </div>
  <div class="owl-carousel owl-theme" id="slider2">
    @foreach ($contents as $content)
    <div class="item px-2">
      <div class="fh5co_hover_news_img">
        <div class="fh5co_news_img"><img src="{{ $content['image'] }}" alt=""/></div>
        <div>
          <a href="#" class="d-block fh5co_small_post_heading"><span class="">{{ $content['title'] }}</span></a>
          <div class="c_g"><i class="fa fa-clock-o"></i>{{ $content['release_date'] }}</div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
