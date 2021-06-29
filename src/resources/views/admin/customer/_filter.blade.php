{!! Form::open(['method' => 'get']) !!}
<div class="p-filter">
  <div class="p-filter__body">
    <ul class="p-filter__list">
      <li class="p-filter__list__item p-filter__list__item--full">
        <div class="p-filter__list__item__label">会員状況</div>
        <div class="p-filter__list__item__data">
          <div class="c-input--radio">
              <input type="radio" name="customerStatus" id="customerStatus__all" checked="">
              <label for="customerStatus__all">すべて</label>
              <input type="radio" name="customerStatus" id="customerStatus__member">
              <label for="customerStatus__member">会員</label>
              <input type="radio" name="customerStatus" id="customerStatus__nonMember">
              <label for="customerStatus__nonMember">非会員</label>
              <input type="radio" name="customerStatus" id="customerStatus__web">
              <label for="customerStatus__web">Web入会会員</label>
              <input type="radio" name="customerStatus" id="customerStatus__vip">
              <label for="customerStatus__vip">PR/VIP</label>
              <input type="radio" name="customerStatus" id="customerStatus__rentalReserved">
              <label for="customerStatus__rentalReserved">レンタル予約中</label>
              <input type="radio" name="customerStatus" id="customerStatus__rental">
              <label for="customerStatus__rental">レンタル会員</label>
              <input type="radio" name="customerStatus" id="customerStatus__recessReserved">
              <label for="customerStatus__recessReserved">休会予定</label>
              <input type="radio" name="customerStatus" id="customerStatus__recess">
              <label for="customerStatus__recess">休会</label>
              <input type="radio" name="customerStatus" id="customerStatus__withdrawReserved">
              <label for="customerStatus__withdrawReserved">退会予定</label>
              <input type="radio" name="customerStatus" id="customerStatus__withdraw">
              <label for="customerStatus__withdraw">退会</label>
              <input type="radio" name="customerStatus" id="customerStatus__suspension">
              <label for="customerStatus__suspension">利用停止</label>
          </div>
        </div>
      </li>
      <li class="p-filter__list__item">
        <div class="p-filter__list__item__label">対象店舗</div>
        <div class="p-filter__list__item__data">
          <div class="c-input--select">
            <select name="" id="">
              <option value="">すべて</option>
            </select>
          </div>
        </div>
      </li>
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
  <div class="p-filter__action">
    <div class="p-buttonWrap p-buttonWrap--auto">
      <button type="submit" class="c-button c-button--full c-button--accent">絞り込み</button>
    </div>
  </div>
</div>
{!! Form::close() !!}
