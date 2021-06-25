<div class="p-boxDetail">
  {{-- ヘッド・タイトル --}}
  @isset($title)
  <div class="p-boxDetail__head">
    <h2 class="p-boxDetail__head__title">{{ $title }}</h2>
    {{-- アクションエリア --}}
    @isset($action)
    <div class="p-boxDetail__head__action">
      {{ $action }}
    </div>
    @endisset
  </div>
  @endisset
  {{-- ボディ --}}
  @isset($body)
    @isset($bodyClass)
    <div
      class="p-boxDetail__body {{ $bodyClass }}"
      @isset($bodyStyle)
        style="{{ $bodyStyle }}"
      @endisset
    >
      {{ $body }}
    </div>
    @else
    <div class="p-boxDetail__body">
      {{ $body }}
    </div>
    @endisset
  @endisset
  {{-- ボディ2つ目 --}}
  @isset($body2)
    @isset($body2Class)
    <div class="p-boxDetail__body {{ $body2Class }}">
      {{ $body2 }}
    </div>
    @else
    <div class="p-boxDetail__body">
      {{ $body2 }}
    </div>
    @endisset
  @endisset
  {{-- フット --}}
  @isset($foot)
    @isset($foot)
    <div class="p-boxDetail__foot">
      {{ $foot }}
    </div>
    @endisset
  @endisset
</div>