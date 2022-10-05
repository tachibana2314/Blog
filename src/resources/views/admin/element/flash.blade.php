{{-- 成功のフラッシュメッセージ --}}
@if (session('message'))
  <section class="area_flash">
    <ul class="list_flash">
      <li class="flash_success">
        <article class="link_float">
          <div class="data">
            {{ __(session('message')) }}
          </div>
        </article>
      </li>
    </ul>
  </section>
@endif
{{-- 失敗のフラッシュメッセージ --}}
@if (session('message_error'))
  <section class="area_flash">
    <ul class="list_flash">
      <li class="flash_error">
        <article class="link_float">
          <div class="data">
            {{ __(session('message_error')) }}
          </div>
        </article>
      </li>
    </ul>
  </section>
@endif
