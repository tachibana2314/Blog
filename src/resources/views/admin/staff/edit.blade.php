@extends('admin.layout.layout--detail')
@section('title', $title ?? '従業員情報編集')
@section('pageClass', 'page_mypage')
@section('content')

<main class="l-main">
  <div class="l-page l-page--full">
    <div class="l-edit">
      <div class="l-edit__head">
        <div class="l-edit__head__sub">
          <a class="p-button p-button--prev" href="{{route('admin.staff.show', $staff)}}">
            <span class="c-image"></span>
            <span class="c-button">従業員詳細</span>
          </a>
        </div>
        <div class="l-edit__head__main">
          <div class="p-buttonWrap">
            <a href="{{route('admin.staff.show', $staff)}}" class="c-button c-button--line">戻る</a>
            {{ Form::button('保存する', ['class' => 'c-button c-button--main', 'form' => 'admin_shop_update_form', 'onclick' => "$('#staff_form').submit();"]) }}
            <div class="p-hideMenu">
              <div class="p-hideMenu__button js-trigger__hideMenu"></div>
              <nav class="p-hideMenu__nav js-target__hideMenu">
                <ul class="p-hideMenu__nav__list">
                  <li>
                    <div class="p-button p-button--delete" data-remodal-target="js-modal__staff_delete">
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
      @include('admin.element.project._p-modal__staff_delete')
      <div class="l-edit__body">
        @include('admin.staff._form')
      </div>
    </div>
  </div>
</main>

@endsection
