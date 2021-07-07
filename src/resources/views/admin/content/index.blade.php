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
                      全 {{ number_format($contents->total()) }} 件中 {{ number_format($contents->firstItem()) }}～{{ number_format($contents->lastItem()) }} 件目
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
                              <p class="c-text__note">おすすめ記事：</p>
                            </div>
                          </th>
                          <th class="p-table__tableHead" width="80">
                            <div class="p-table__item">公開：</div>
                          </th>
                          <th class="p-table__tableHead">
                            <div class="p-table__item">作成日</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="p-table__data">
                        @foreach($contents as $content)
                          @include('admin.content._content', ['content' => $content])
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="p-tableSet__foot">
                    {{-- @include('admin.content._paginate', ['request' => $request, 'contents' => $contents]) --}}
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
