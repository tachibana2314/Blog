@extends('admin.layout.layout--base')
@section('title', $title ?? '従業員管理')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page l-page--full">
    @component('admin.layout.p-page')
      @slot('headTitle')
        従業員管理
      @endslot
      @slot('headAction')
        @if(Auth::user()->authority < \App\Models\Staff::AUTHORITY_3)
        <div class="p-page__head__action">
          <a href="{{route('admin.staff.create')}}" class="c-button c-button--accent">
            従業員を新規作成
          </a>
        </div>
        @endif
      @endslot
      @slot('body')
        <section class="p-box">
          <div class="p-box__filter">
            <div class="p-filter">
              @include('admin.staff._filter', ['request' => $request])
            </div>
          </div>
          <div class="p-box__body">
            {{--テーブル一式--}}
            <div class="p-tableSet">
              <div class="p-tableSet__head">
                <div class="p-buttonWrap p-buttonWrap--full p-buttonWrap--right">
                  <div class="p-button p-button--csv">
                    <div class="c-image"></div>
                    <a href="{{ route('admin.staff.export')}}" class="c-button">CSV</a>
                  </div>
                </div>
              </div>
              <div class="p-tableSet__head">
                <div class="p-tableSet__place">
                  <p class="p-tableSet__place__count">
                    全 {{ number_format($staffs->total()) }} 件中 {{ number_format($staffs->firstItem()) }}～{{ number_format($staffs->lastItem()) }} 件目
                  </p>
                </div>
              </div>
              <div class="p-tableSet__body">
                {{--スクロール--}}
                <div class="p-scroll">
                  {{--テーブル--}}
                  <table class="p-table">
                    <thead class="p-table__head">
                      <tr class="p-table__head__tableRow">
                        <th class="p-table__tableHead">
                          <div class="p-table__item">氏名</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">所属店舗</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">役職</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">在籍区分</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">権限</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">性別</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">年齢</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">電話番号</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">入社日</div>
                        </th>
                        <th class="p-table__tableHead">
                          <div class="p-table__item">有休数</div>
                        </th>
                        <!--<th class="p-table__tableHead">
                          <div class="p-table__item">顧客紹介数</div>
                        </th>-->
                      </tr>
                    </thead>
                    <tbody class="p-table__data">
                      @foreach($staffs as $staff)
                        @include('admin.staff._staff', ['staff' => $staff])
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="p-tableSet__foot">
                @include('admin.staff._paginate', ['request' => $request, 'staffs' => $staffs])
              </div>
            </div>
            </div>
          </div>
        </section>
      @endslot
    @endcomponent
  </div>
@endsection
