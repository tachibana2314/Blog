@extends('admin.layout.layout--detail')
@section('title', $title ?? '店舗新規作成')
@section('pageClass', 'page_mypage')
@section('content')
  <main class="l-main">
    <div class="l-page l-page--full">
      <div class="l-edit">
        <div class="l-edit__head">
          @if(!$is_virtual)
          <div class="l-edit__head__sub">
            <a class="p-button p-button--prev" href="{{route('admin.shop.index')}}">
              <span class="c-image"></span>
              <span class="c-button">店舗管理</span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.shop.index')}}" class="c-button c-button--line">戻る</a>
              {{ Form::button('作成する', ['class' => 'c-button c-button--main', 'form' => 'admin_shop_create_form', 'onclick' => 'submit();']) }}
            </div>
          </div>
          @else
          <div class="l-edit__head__sub">
            <a class="p-button p-button--prev" href="{{route('admin.virtual_shop.index')}}">
              <span class="c-image"></span>
              <span class="c-button">バーチャル店舗管理</span>
            </a>
          </div>
          <div class="l-edit__head__main">
            <div class="p-buttonWrap">
              <a href="{{route('admin.virtual_shop.index')}}" class="c-button c-button--line">戻る</a>
              {{ Form::button('作成する', ['class' => 'c-button c-button--main', 'form' => 'admin_shop_create_form', 'onclick' => 'submit();']) }}
            </div>
          </div>
          @endif
        </div>
        {{ Form::open(['method' => 'post', 'class'=> 'h-adr', 'enctype' => 'multipart/form-data', 'id' => 'admin_shop_create_form']) }}
          @include('admin.shop._inputs', ['mShopGroups' => $mShopGroups])
        {{ Form::close() }}
      </div>
    </div>
  </main>
@endsection
