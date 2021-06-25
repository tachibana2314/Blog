<tr
  class="p-table__data__tableRow"
  data-href="{{ route('admin.news.edit', $news) }}"
>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__photo--machine">
        <div
          class="c-image c-image--wide"
          style="background: url({{ $news->thumbnail }});"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item p-table__item--column">
      <p>{{ Arr::get($news, 'textCategory.name') }}</p>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item p-table__item--column">
      <p>{{ $news->title }}</p>
      <p class="c-text__note">{{ $news->overview }}</p>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item"></div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $news->is_headlin_flg ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $news->is_web_released ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>
  <!--<td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $news->is_mypage_released ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $news->is_app_released ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>-->
  <td class="p-table__tableData">
    <div class="p-table__item">
      <p class="c-text__note">
        {{ $news->created_at->format('Y/m/d') }}<br>
        {{ $news->created_at->format('H:i') }}
      </p>
    </div>
  </td>
</tr>
