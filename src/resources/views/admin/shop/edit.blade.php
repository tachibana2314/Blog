@extends('admin.layout.layout--detail')
@section('title', $title ?? '店舗情報編集')
@section('pageClass', 'page_mypage')
@section('content')

  <main class="l-main">
    <div class="l-page l-page--full">
      <div class="l-edit">
        <div class="l-edit__head">
          @if(!$is_virtual)
          <div class="l-edit__head__sub">
            <a href="{{route('admin.shop.show', $shop)}}" class="p-button p-button--prev">
              <span class="c-image"></span>
              <span class="c-button">店舗詳細<span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.shop.show', $shop)}}" class="c-button c-button--line">戻る</a>
              {{ Form::button('更新する', ['class' => 'c-button c-button--main', 'form' => 'admin_shop_update_form', 'onclick' => 'submit();']) }}
              <div class="p-hideMenu">
                <div class="p-hideMenu__button js-trigger__hideMenu"></div>
                <nav class="p-hideMenu__nav js-target__hideMenu">
                  <ul class="p-hideMenu__nav__list">
                    <li>
                      <div class="p-button p-button--delete" data-remodal-target="js-modal__shop_delete">
                        <div class="c-image"></div>
                        <div class="c-button">削除<div>
                      </div>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          @else
          <div class="l-edit__head__sub">
            <a href="{{route('admin.virtual_shop.show', $shop)}}" class="p-button p-button--prev">
              <span class="c-image"></span>
              <span class="c-button">バーチャル店舗詳細<span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.virtual_shop.show', $shop)}}" class="c-button c-button--line">戻る</a>
              {{ Form::button('更新する', ['class' => 'c-button c-button--main', 'form' => 'admin_shop_update_form', 'onclick' => 'submit();']) }}
              <div class="p-hideMenu">
                <div class="p-hideMenu__button js-trigger__hideMenu"></div>
                <nav class="p-hideMenu__nav js-target__hideMenu">
                  <ul class="p-hideMenu__nav__list">
                    <li>
                      <div class="p-button p-button--delete" data-remodal-target="js-modal__shop_delete">
                        <div class="c-image"></div>
                        <div class="c-button">削除<div>
                      </div>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          @endif
        </div>
        {{ Form::model($shop, ['class'=> 'h-adr', 'method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'admin_shop_update_form']) }}
          @include('admin.shop._inputs', ['shop' => $shop, 'mShopGroups' => $mShopGroups])
        {{ Form::close() }}
      </div>
    </div>
  </main>
  {{-- 削除モーダル --}}
  @include('admin.element.project._p-modal__shop_delete')
@endsection
