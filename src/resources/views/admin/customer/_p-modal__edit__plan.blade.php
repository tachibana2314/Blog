<div class="p-remodal p-remodal--narrow remodal" data-remodal-id="js-modal__edit__plan" data-remodal-options="hashTracking:true,closeOnOutsideClick:false">
  <button class="p-remodal__closeButton remodal-close" data-remodal-action="close"></button>
  <div class="p-remodal__layout">
    <div class="p-remodal__head">
      <h2 class="p-remodal__head__title">
        プランの変更
      </h2>
    </div>
    <div class="p-remodal__middle">
      <div class="l-12">
        <div class="l-12__6">
          <div class="p-user">
            <div class="p-user__image">
              <div class="c-image c-image--round" style="background: url({{asset('img/sample/user--01.jpg')}})"></div>
            </div>
            <div class="p-user__text">
              <p class="c-text__lv5">三浦 直子</p>
              <p class="c-text__note">ミウラ ナオコ</p>
            </div>
          </div>
        </div>
<!--
        <div class="l-12__6">
          <ul class="p-list">
            <li>
              <div class="p-list__label">現在のプラン</div>
              <div class="p-list__data">
                <p class="c-plan c-plan--green"></p>  
              </div>
            </li>
          </ul>
        </div>
-->
      </div>
    </div>
    <div class="p-remodal__scroll js-target__approvalStatus">
      <form action="">
        <section class="p-remodal__contents">
          <div class="p-remodal__body">
            
            <div class="p-creditCard">
              <ul class="p-input__list">
                <li>
                  <p class="p-input__list__title">
                    プラン内容
                  </p>
                </li>
                <li class="split__2">
                  <div class="c-input c-input--disabled c-input--select c-input--full" data-title="現在のプラン">
                    <select name="" id="">
                      <option value="">グリーン</option>
                    </select>
                  </div>
                </li>
                <li class="split__2">
                  <div class="c-input c-input--select c-input--full" data-title="変更後のプラン">
                    <select name="" id="">
                      <option value="">グリーン</option>
                    </select>
                  </div>
                </li>
                <li>
                  <p class="p-input__list__title">
                    クレジットカード情報
                  </p>
                </li>
                <li>
                  <div class="c-input c-input--full" data-title="カード番号">
                    <input type="text" placeholder="**** **** **** ****" value="">
                  </div>
                </li>
                <li>
                  <div class="c-input c-input--full" data-title="クレジットカード名義人">
                    <input type="text" placeholder="KAORI SAITOU" value="">
                  </div>
                </li>
                <li class="split__2">
                  <div class="c-input c-input--select c-input--full" data-title="有効期限/月">
                    <select name="" id="">
                      <option value="">01</option>
                    </select>
                  </div>
                </li>
                <li class="split__2">
                  <div class="c-input c-input--select c-input--full" data-title="有効期限/年">
                    <select name="" id="">
                      <option value="">2021</option>
                    </select>
                  </div>
                </li>
                <li>
                  <p class="c-text__note">※ 以下のカードをご利用いただけます</p><br>
                  <img src="{{asset('img/admin/p-creditCard/visa.svg')}}" height="48">
                </li>
              </ul>
            </div>
            
          </div>
        </section>
      </form>
    </div>
    <div class="p-remodal__foot">
      <div class="p-buttonWrap">
        <div data-remodal-action="close" class="c-button c-button--line">キャンセル</div>
        <div data-remodal-action="close" class="c-button c-button--accent">保存する</div>
      </div>
    </div>
  </div>
</div>
<script>
  //出勤以外の場合、スケジュール不要
  $(function(){
    $('#approvalStatus').change(function(){
      let select = $(this).val();
      if(select === 'approvalStatus__arrive') {
        $('.js-target__approvalStatus').show();
      }else {
        $('.js-target__approvalStatus').hide();
      }
    });
  });

/*
	function approvalStatusShowHide(){
    select = document.getElementsByName('approvalStatus').val();
  }
  $(document).ready(function() {
    approvalStatusShowHide();
  });
*/
</script>
