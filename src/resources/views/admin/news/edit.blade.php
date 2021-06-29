@extends('admin.layout.layout--detail')
@section('title', $title ?? '記事編集')
@section('pageClass', 'page_mypage')
@section('content')

  <main class="l-main">
    <div class="l-page l-page--full">
      <div class="l-edit">
        <div class="l-edit__head">
          <div class="l-edit__head__sub">
            <a class="p-button p-button--prev" href="{{route('admin.content.index')}}">
              <span class="c-image"></span>
              <span class="c-button">コンテンツ管理</span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.content.index')}}" class="c-button c-button--line">戻る</a>
              <a
                class="c-button c-button--main"
                onclick="$('#form').submit();"
              >保存する
              </a>
              <div class="p-hideMenu">
                <div class="p-hideMenu__button js-trigger__hideMenu"></div>
                <nav class="p-hideMenu__nav js-target__hideMenu">
                  <ul class="p-hideMenu__nav__list">
                    <li>
                      <div class="p-button p-button--delete" data-remodal-target="js-modal__news_delete">
                        <div class="c-image"></div>
                        <div class="c-button">削除<div>
                      </div>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        {{-- 削除モーダル --}}
        @include('admin.element.project._p-modal__news_delete')
        <div class="l-edit__body">
          @include('admin.content._form')
        </div>
      </div>
    </div>
  </main>
@endsection
