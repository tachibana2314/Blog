@extends('admin.layout.layout--detail')
@section('title', $title ?? '従業員管理')
@section('pageClass', 'page_mypage')
@section('content')
  @include('admin.staff._sidebar', ['staff' => $staff])
  <main class="l-main l-main--detail">
    <div class="l-page l-page--detail">
      <div class="p-page">
        <div class="p-page__head p-page__head--detail">
          <div class="l-container">
            <h1 class="c-heading--lv2">従業員詳細</h1>
            <div class="p-page__head__tab p-page__head__tab--left">
              @include('admin.staff._p-page__head__tab__list')
            </div>
          </div>
        </div>
        <div class="p-page__body">
          <div class="l-container">
            {{-- 勤怠情報 --}}
            @component('admin.element.project._p-boxDetail')
              @slot('bodyClass')
                p-boxDetail__body--paddingOff
              @endslot
              @slot('body')
                <form method="post" id="memo" action="{{ route('admin.staff.other', $staff)}}">
                  @csrf
                  <div class="p-memo">
                    <div class="c-input c-input--textarea">
                      {{ Form::textarea('memo', $staff['memo'], ['placeholder' => 'メモを記入できます','class' => 'half']) }}
                    </div>
                    <div id="output_message"></div>
                  </div>
                </form>
                {{-- <script>
                $('.p-memo textarea').keypress(function() {
                  $('.js-target__memo').prop('disabled', false);
                });
                </script> --}}
              @endslot
              @slot('foot')
                <div class="p-buttonWrap p-buttonWrap--right">
                  <button type="submit" form="memo" class="c-button c-button--accent js-target__memo">保存する</button>
                </div>
              @endslot
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
