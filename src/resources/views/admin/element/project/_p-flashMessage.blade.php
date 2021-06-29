@if (session('success'))
  <div class="p-flashMessage">
    <ul class="p-flashMessage__list">
      <li>
        <div class="p-flashMessage__list__item js-target__flashMessage is-active__flashMessage--show">
          {{ __(session('success')) }}
          <div class="p-flashMessage__list__item__removeButton js-trigger__flashMessage--remove">
        </div>
      </li>
    </ul>
  </div>
@endif

@if (session('error'))
  <div class="p-flashMessage">
    <ul class="p-flashMessage__list"
      <li>
        <div class="p-flashMessage__list__item p-flashMessage__list__item--error  js-target__flashMessage is-active__flashMessage--show">
          {{ __(session('error')) }}
          <div class="p-flashMessage__list__item__removeButton js-trigger__flashMessage--remove">
          </div>
      </li>
    </ul>
  </div>
@endif

@if (session('message'))
  <div class="p-flashMessage">
    <ul class="p-flashMessage__list"
    <li>
      <div class="p-flashMessage__list__item js-target__flashMessage is-active__flashMessage--show">
        {{ __(session('message')) }}
        <div class="p-flashMessage__list__item__removeButton js-trigger__flashMessage--remove">
        </div>
    </li>
    </ul>
  </div>
@endif
