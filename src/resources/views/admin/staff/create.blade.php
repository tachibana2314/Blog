@extends('admin.layout.layout--detail')
@section('title', $title ?? '従業員新規作成')
@section('pageClass', 'page_mypage')
@section('content')
  <main class="l-main">
    <div class="l-page l-page--full">
      <div class="l-edit">
        <div class="l-edit__head">
          <div class="l-edit__head__sub">
            <a class="p-button p-button--prev" href="{{route('admin.staff.index')}}">
              <span class="c-image"></span>
              <span class="c-button">従業員管理</span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.staff.index')}}" class="c-button c-button--line">戻る</a>
              <a
                class="c-button c-button--main"
                onclick="$('#staff_form').submit();"
              >保存する</a>
            </div>
          </div>
        </div>
        <div class="l-edit__body">
          @include('admin.staff._form')
        </div>
      </div>
    </div>
  </main>
@endsection
