<ul class="p-list {{ $class ?? '' }}">
  @foreach($listData as $key => $val)
  <li>
  	<div class="p-list__label">
  		{!! $key !!}
  	</div>
  	<div class="p-list__data">
  		{!! $val !!}
  	</div>
  </li>
  @endforeach
</ul>