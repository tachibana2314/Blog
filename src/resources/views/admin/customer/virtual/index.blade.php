@extends('admin.layout.layout--base')
@section('title', $title ?? 'バーチャル店舗経由顧客')
@section('pageClass', 'page_mypage')
@section('content')
  <div class="l-page l-page--full">
    <section class="p-box">
      <div class="p-box__head">
        <h1 class="c-heading--lv1">バーチャル店舗経由顧客</h1>
        {{-- <a href="{{route('admin.shop.create')}}" class="c-button c-button--accent c-button--small">バーチャル店舗経由顧客を新規作成</a> --}}
      </div>
      <div class="p-box__filter">
        <div class="p-filter">
          <ul class="p-filter__list">
<!--
            <li class="p-filter__list__item">
              <div class="p-filter__list__item__label">エリア</div>
              <div class="p-filter__list__item__data">
                <div class="c-input--select">
                  <select name="" id="">
                    <option value="">すべて</option>
                  </select>
                </div>
              </div>
            </li>
-->
<!--
            <li class="p-filter__list__item">
              <div class="p-filter__list__item__label">店舗区分</div>
              <div class="p-filter__list__item__data">
                <div class="c-input--radio">
                  <input type="radio" name="shopType" id="shopType--all" checked="">
                  <label for="shopType--all">すべて</label>
                  <input type="radio" name="shopType" id="shopType--01">
                  <label for="shopType--01">本部</label>
                  <input type="radio" name="shopType" id="shopType--02">
                  <label for="shopType--02">店舗</label>
                  <input type="radio" name="shopType" id="shopType--03">
                  <label for="shopType--03">Web</label>
                  <input type="radio" name="shopType" id="shopType--04">
                  <label for="shopType--04">レンタル</label>
                </div>
              </div>
            </li>
-->
            <li class="p-filter__list__item">
              <div class="p-filter__list__item__label">キーワード</div>
              <div class="p-filter__list__item__data">
                <div class="c-input">
                  <input type="text" placeholder="キーワード">
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="p-box__body">
        <div class="p-tableSet">
          <div class="p-tableSet__head">
            <div class="p-tableSet__place">
              <p class="p-tableSet__place__count">全 21 件中 1～21 件目</p>
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
                			<div class="p-table__item">会員番号</div>
              			</th>
              			<th class="p-table__tableHead">
                			<div class="p-table__item">電話番号</div>
              			</th>
              			<th class="p-table__tableHead">
                			<div class="p-table__item">対象バーチャル店</div>
              			</th>
              		</tr>
              	</thead>
              	<tbody class="p-table__data">
                	<?php for($i=0;$i<20;$i++) { ?>
              		<tr class="p-table__data__tableRow">
              			<td class="p-table__tableData">
                			<div class="p-table__item">
                        <p class="name">宮川 敏江</p>
                			</div>
                	  </td>
                	  <td class="p-table__tableData">
                			<div class="p-table__item">AA752087349</div>
                	  </td>
                	  <td class="p-table__tableData">
                			<div class="p-table__item">09012345678</div>
                	  </td>
              			<td class="p-table__tableData">
                			<div class="p-table__item">
                  			<div class="p-table__item__logo">
                    			<img class="p-table__item__logo__img" src="{{ asset('img/sample/virtualShop--01.png') }}">
                    			<p class="p-table__item__logo__text">arimo ヘアー&アイラッシュ バーチャルABC店</p>
                  			</div>
                			</div>
                	  </td>
              		</tr>
                	<?php } ?>
              	</tbody>
              </table>
          </div>
          <div class="p-tableSet__foot">
            <div class="p-tableSet__place">
              <p class="p-tableSet__place__count">全 21 件中 1～21 件目</p>
            </div>
            <div class="p-pagination">
              <div class="p-pagination__control">
                <div class="p-pagination__control__button--prev"></div>
              </div>
              <div class="p-pagination__body">
                <div class="c-input">
                  <input type="number" placeholder="1">
                </div>
                <div class="p-pagination__body__parameter">/24</div>
              </div>
              <div class="p-pagination__control">
                <div class="p-pagination__control__button--next"></div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
  </div>
@endsection
