@extends('admin.layout.layout--base')
@section('title', $title ?? 'コンテンツ管理')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page l-page--full">
    <div class="p-page">
      <div class="p-page__head">
        <div class="l-container">
          <h1 class="c-heading--lv1">コンテンツ管理</h1>
          <div class="p-page__head__action">
            <a href="{{route('admin.content.add')}}" class="c-button c-button--accent c-button--small">
              記事を新規作成
            </a>
          </div>
        </div>
      </div>
      <div class="p-page__body">
        <div class="l-container--full">
          <section class="p-box">
            <div class="p-box__head">
            </div>
            <div class="p-box__filter">
              <div class="p-filter">
                @include('admin.content._filter', ['request' => $request])
              </div>
            </div>
            <div class="p-box__body">
              <div class="p-tableSet">
                <div class="p-tableSet__head">
                  <div class="p-tableSet__place">
                    <p class="p-tableSet__place__count">
                      全 {{ number_format($newses->total()) }} 件中 {{ number_format($newses->firstItem()) }}～{{ number_format($newses->lastItem()) }} 件目
                    </p>
                  </div>
                </div>
                <div class="p-tableSet__body">
                  <div class="p-scroll">
                    <table class="p-table">
                      <thead class="p-table__head">
                        <tr class="p-table__head__tableRow">
                          <th class="p-table__tableHead" width="96">
                            <div class="p-table__item">写真</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">カテゴリー</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">タイトル</div>
                          </th>
                          <th class="p-table__tableHead" width="48">
                            <div class="p-table__item">
                              <p class="c-text__note">公開：</p>
                            </div>
                          </th>
                          <th class="p-table__tableHead" width="80">
                            <div class="p-table__item">見出し記事</div>
                          </th>
                          <th class="p-table__tableHead" width="80">
                            <div class="p-table__item">Webサイト</div>
                          </th>
                          <!--<th class="p-table__tableHead" width="80">
                            <div class="p-table__item">マイページ</div>
                          </th>
                          <th class="p-table__tableHead" width="80">
                            <div class="p-table__item">アプリ</div>
                          </th>-->
                          <th class="p-table__tableHead">
                            <div class="p-table__item">作成日</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="p-table__data">
                        @foreach($newses as $news)
                          @include('admin.content._news', ['news' => $news])
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="p-tableSet__foot">
                    @include('admin.content._paginate', ['request' => $request, 'newses' => $newses])
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
