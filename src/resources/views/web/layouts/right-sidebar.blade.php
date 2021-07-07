{{-- カテゴリー --}}
<div>
  <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">カテゴリー</div>
</div>
<div class="clearfix"></div>
<div class="fh5co_tags_all">
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 1])}}">PHP</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 2])}}">Laravel</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 3])}}">Docker</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 4])}}">AWS</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 5])}}">React.js</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 6])}}">JavaScript/jQuery</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 7])}}">Node.js</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 8])}}">Linux</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 9])}}">git</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 10])}}">ウェブサービス</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 11])}}">アプリ</a>
  <a class="fh5co_tagg" href="{{ route('content',['tag_id' => 12])}}">サーバー</a>
</div>


{{-- 人気記事一覧 --}}
<div>
  <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">人気記事一覧</div>
</div>
@foreach ($contents as $content)
<div class="row pb-3">
  <div class="col-5 align-self-center">
    <img src="{{ $content['image'] }}" width="80" height="60">
  </div>
  <div class="col-7 paddding">
    <div class="most_fh5co_treding_font">{{ $content['title'] }}</div>
    <div class="most_fh5co_treding_font_123">{{ $content['overview'] }}</div>
  </div>
</div>
@endforeach
