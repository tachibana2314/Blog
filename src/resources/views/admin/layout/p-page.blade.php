<div class="p-page">
  @if ($headTitle)
  <div class="p-page__head">
    <div class="l-container">
      <h1 class="c-heading--lv1">{{ $headTitle }}</h1>
      {{ $headAction }}
    </div>
  </div>
  @endif
  @if ($body)
  <div class="p-page__body">
    <div class="l-container--full">
      {{ $body }}
    </div>
  </div>
  @endif
</div>