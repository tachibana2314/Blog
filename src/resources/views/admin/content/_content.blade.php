<tr
  class="p-table__data__tableRow"
  data-href="{{ route('admin.content.edit', $content) }}"
>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__photo--machine">
        <div
          class="c-image c-image--wide"
          style="background: url({{ $content->image }});"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item p-table__item--column">
      <p>{{ $content->category }}</p>
      <p class="c-text">{{ $content->programing_category }}</p>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item p-table__item--column">
      <p>{{ $content->title }}</p>
      <p class="p-table__item p-table__item--column">{{ $content->overview }}</p>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $content->is_recommendation ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <div class="p-table__item__checkboxStatus">
        <div
          class="c-image p-table__item__checkboxStatus__{{ $content->is_released ? 'checked' : 'unchecked' }}"
        ></div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <p class="c-text__note">
        {{ $content->created_at->format('Y/m/d') }}<br>
        {{ $content->created_at->format('H:i') }}
      </p>
    </div>
  </td>
</tr>
