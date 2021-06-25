@extends('admin.layout.layout--base')
@section('title', $title ?? 'お問い合わせ管理')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page l-page--full">
    <div class="p-page">
      <div class="p-page__head">
        <div class="l-container">
          <h1 class="c-heading--lv1">お問い合わせ管理</h1>
        </div>
      </div>
      <div class="p-page__body">
        <div class="l-container--full">
          <section class="p-box">
            <div class="p-box__head">
            </div>
            <div class="p-box__filter">
              <form method="get" action="{{route('admin.contact.index')}}" onkeypress="enter()" id="form1">
                <div class="p-filter">
                  <div class="p-filter__body">
                    <ul class="p-filter__list">
                    <li class="p-filter__list__item">
                      <div class="p-filter__list__item__label">キーワード</div>
                      <div class="p-filter__list__item__data">
                        <div class="c-input">
                          {{ Form::text('keyword', request()->keyword,[ 'placeholder' => 'キーワード']) }}
                        </div>
                      </div>
                    </li>
                    <li class="p-filter__list__item">
                      <div class="p-filter__list__item__label">カテゴリー</div>
                      <div class="p-filter__list__item__data">
                        <div class="c-input c-input--select c-input--full" id="submit_select">
                          {!! Form::select('type', ['' => 'お問合せ種別を選択']+ App\Models\Contact::CONTACT_TYPE_LIST,request()->type) !!}
                        </div>
                      </div>
                    </li>
                    <li class="p-filter__list__item">
                      <div class="p-filter__list__item__label">対応ステータス</div>
                      <div class="p-filter__list__item__data">
                        <div class="c-input c-input--select c-input--full" id="submit_select">
                          {!! Form::select('status', ['' => 'ステータス選択']+App\Models\Contact::CONTACT_STATUS_LIST, request()->status) !!}
                        </div>
                      </div>
                    </li>
                  </ul>
                  </div>
                  <div class="p-filter__action">
                    <div class="p-buttonWrap p-buttonWrap--auto">
                      <button type="submit" form="form1" class="c-button c-button--full c-button--accent">絞り込み</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="p-box__body">
              {{--テーブル一式--}}
              <div class="p-tableSet">
                <div class="p-tableSet__head">
                  <div class="p-tableSet__place">
                    <p class="p-tableSet__place__count">
                      全 {{ number_format($contacts->total()) }} 件中 {{ number_format($contacts->firstItem()) }}～{{ number_format($contacts->lastItem()) }} 件目
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
                      			<div class="p-table__item">お問い合わせ日時</div>
                    			</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item">カテゴリ</div>
                    			</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item">内容</div>
                    			</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item p-table__item--column">氏名<span class="c-text__note">フリガナ</span></div>
                      		</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item">電話番号</div>
                      		</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item">メールアドレス</div>
                    			</th>
                    			<th class="p-table__tableHead">
                      			<div class="p-table__item">ステータス</div>
                    			</th>
                    		</tr>
                    	</thead>
                    	<tbody class="p-table__data">
                      @foreach ($contacts as $contact)
                      {{-- <script>
                        let contact_tget = @json($contact);
                        console.log(contact);
                      </script> --}}

                        <tr class="p-table__data__tableRow js-trigger__overview--open" id="contact_{{$contact['id']}}">

                          <td style="display:none;"><input type="hidden" name="contact_tgt[]" class="contact_tgt" value="{{$contact['id']}}" ></td>
                          <td class="p-table__tableData">
                      			<div class="p-table__item">{{$contact['created_at']}}</div>
                      		</td>
                    			<td class="p-table__tableData">
                      			<div class="p-table__item">{{$contact['type']}}</div>
                      		</td>
                    			<td class="p-table__tableData">
                      			<div class="p-table__item">{{Str::limit($contact->content, 30,$end = '...')}}</div>
                      		</td>
                    			<td class="p-table__tableData">
                      			<div class="p-table__item p-table__item--column">
                              <p class="name">{{$contact['full_name']}}</p>
                              <p class="c-text__note">{{$contact['full_name_kana']}}</p>
                      			</div>
                      	  </td>
                    			<td class="p-table__tableData">
                      			<div class="p-table__item">{{$contact['tel']}}</div>
                      		</td>
                    			<td class="p-table__tableData">
                      			<div class="p-table__item">{{$contact['email']}}</div>
                      		</td>
                          <td class="p-table__tableData">
                      			<div class="p-table__item">
                        			<div class="p-table__item__status">
                          			<div class="{{$contact->getStatusClassAttribute()}}">{{$contact->status_label}}</div>
                        			</div>
                      			</div>
                      		</td>
                        @endforeach
                    		</tr>
                    	</tbody>
                    </table>
                </div>
                <div class="p-tableSet__foot">
                  @include('admin.contact._paginate', ['request' => $request, 'contacts' => $contacts])
                </div>
              </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  @foreach ($contacts as $contact)
  <div class="l-overview js-target__overview">
    <div class="p-overview">
      {{ Form::model($contact, ['route' => ['admin.contact.status', $contact], "name" => "contact_status_$contact->id", 'method' => 'post']) }}
      @csrf
      <div class="p-overview__head">
        <div class="p-overview__control">
          <div class="p-overview__control__close js-trigger__overview--close">
            <p class="c-text__sub">× 閉じる</p>
          </div>
        </div>
        <div class="p-buttonWrap p-buttonWrap--right">
          <button type="submit" class="c-button c-button--accent">更新する</button>
          @can('admin')
          <div class="p-hideMenu">
            <div class="p-hideMenu__button js-trigger__hideMenu"></div>
            <nav class="p-hideMenu__nav js-target__hideMenu">
              <ul class="p-hideMenu__nav__list">
                <li>
                  <div class="p-button p-button--delete" data-remodal-target="js-modal__shop_delete">
                    <div class="c-image"></div>
                    <div class="c-button" data-remodal-target="js-modal__contact_delete_{{ $contact->id }}">削除<div>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
          @endcan
        </div>
      </div>
      <div class="p-overview__body">
        <ul class="p-list p-list--rowWide">
          <li>
            <div class="p-list__label">
              ステータス
            </div>
            <div class="p-list__data">
              <div class="c-input--radio c-input--radio--label">
                <input type="radio" name="status"
                      id="contactStatus--backlog_{{$contact['id']}}"
                      @if($contact['status'] == "1") checked="checked" @endif
                      value="1">
                <label class="label--error" for="contactStatus--backlog_{{$contact['id']}}">未対応</label>
                <input type="radio"
                      name="status"
                      id="contactStatus--wip_{{$contact['id']}}"
                      @if($contact['status'] == "2") checked="checked" @endif
                      value="2">
                <label for="contactStatus--wip_{{$contact['id']}}">対応中</label>
                <input type="radio"
                      name="status"
                      id="contactStatus--closed_{{$contact['id']}}"
                      @if($contact['status'] == "3") checked="checked" @endif
                      value="3">
                <label class="label--correct" for="contactStatus--closed_{{$contact['id']}}">対応済</label>
              </div>
            </div>
          </li>
          <li class="p-list__line"></li>
          <li class="p-list__item--column">
            <div class="p-list__label">
              お問合せ内容
            </div>
            <div class="p-list__data">
              {!! nl2br(e($contact['content'])) !!}
            </div>
          </li>
          <li class="p-list__item--column">
            <div class="p-list__label">
              メモ
            </div>
            <div class="p-list__data">
              <div class="c-input c-input--full">
                {{ Form::textarea('memo', null, ['data-option' => 'size-l', 'placeholder' => 'お問い合わせメモにご記入してください']) }}
              </div>
            </div>
          </li>
          <li class="p-list__line"></li>
          <li>
            <div class="p-list__label">
              氏名 (フリガナ)
            </div>
            <div class="p-list__data">
              <p class="name">{{$contact['full_name']}}</p>
              <p class="c-text__note">{{$contact['full_name_kana']}}</p>
            </div>
          </li>
          <li>
            <div class="p-list__label">
              電話番号
            </div>
            <div class="p-list__data">
              {{$contact['tel']}}
            </div>
          </li>
          <li>
            <div class="p-list__label">
              メールアドレス
            </div>
            <div class="p-list__data">
              {{$contact['email']}}
            </div>
          </li>
          <li>
            <div class="p-list__label">
              お問い合わせ日
            </div>
            <div class="p-list__data">
              {{$contact['created_at']}}
            </div>
          </li>
          <li>
            <div class="p-list__label">
              カテゴリ
            </div>
            <div class="p-list__data">
              {{$contact['type']}}
            </div>
          </li>
        </ul>
      </div>
      {{ Form::close() }}
    </div>
  </div>
  {{-- 削除モーダル --}}
  @include('admin.element.project._p-modal__contact_delete',['contact' => $contact])
  @endforeach
  <script type="text/javascript">
    $(document).ready(function(){
      $('tr.p-table__data__tableRow').on('click', function(){
        let targetContactId = $(this).find('input[name^=contact_tgt]').val();
        let targetForm = $('form[name="contact_status_'+targetContactId+'"]');
        //一旦全部非表示
        $('.js-target__overview').removeClass('is-active__overview--show');
        //対象のみ表示
        targetForm.closest('.js-target__overview').addClass('is-active__overview--show');
        // target.css('display', 'show');
      });
    });
  </script>
  <script>
  function enter(){
    if( window.event.keyCode == 13 ){
      document.form1.submit();
    }
  }
  </script>
@endsection
