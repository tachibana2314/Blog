@extends('admin.layout.layout--detail')
@section('title', $title ?? '記事新規作成')
@section('pageClass', 'page_mypage')
@section('content')

  <main class="l-main">
    <div class="l-page l-page--full">
      <div class="l-edit">
        <div class="l-edit__head">
          <a href="{{route('admin.content.index')}}">< コンテンツ管理</a>
          <div class="p-buttonArea">
            <a href="{{route('admin.content.index')}}" class="c-button c-button--line">戻る</a>
            <a href="{{route('admin.content.index')}}" class="c-button c-button--main">作成する</a>
          </div>
        </div>
        <div class="l-edit__body">
          <div class="l-container">
            <div class="l-edit__main">
            <div class="p-input">
              <ul class="p-input__list">
                <li>
                  <div class="c-input c-input--full" data-title="タイトル">
                    <input type="text" value="">
                  </div>
                </li>
                <li>
                  <!-- エディタ -->
                  <div class="p-editor">
                    <div id="editor">
                      <p></p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
            <div class="l-edit__sidebar">
            <ul class="p-list">
              <li>
                <div class="p-list__label">
                  公開箇所
                </div>
                <div class="p-list__data">
                  <div class="c-input--checkbox c-input--checkbox--column">
                    <input type="checkbox" name="showPlace" id="showPlace--01">
                    <label for="showPlace--01">Webサイト</label>
                    <input type="checkbox" name="showPlace" id="showPlace--04">
                    <label for="showPlace--04">マイページ</label>
                    <input type="checkbox" name="showPlace" id="showPlace--05">
                    <label for="showPlace--05">アプリ</label>
                  </div>
                </div>
              </li>
              <li>
                <div class="p-list__label">
                  投稿日
                </div>
                <div class="p-list__data">
                  <div class="c-input c-input--full">
                    <input type="date">
                  </div>
                </div>
              </li>
              <li>
                <div class="p-list__label">
                  サムネイル画像
                </div>
                <div class="p-list__data">
                  <div class="p-list__data">
                    <div class="c-input--file">
                      <input type="file" id="postImage__main">
                      <label for="postImage__main" class="c-image c-image--wide" style="background: url({{asset('img/sample/news--01.jpg')}})"></label>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
