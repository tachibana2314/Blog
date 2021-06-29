<tr
  class="p-table__data__tableRow"
  data-href="{{route('admin.staff.show', $staff)}}"
>
  <td class="p-table__tableData">
    <div class="p-table__item">
      <!-- ユーザー情報 -->
      <div class="p-table__item__user">
        <div
          class="c-image c-image--round"
          style="background: url({{ Arr::get($staff, 'avator') }});"
        ></div>
        <div class="p-table__item__user__text">
          <div class="id c-text__note">{{ Arr::get($staff, 'staff_code') }}</div>
          <p class="name">{{ Arr::get($staff, 'full_name') }}</p>
        </div>
      </div>
    </div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'shop.name') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'position') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'enrolled_type_label') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'authority_label') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'gender_label') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'age') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'tel') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'join_date') }}</div>
  </td>
  <td class="p-table__tableData">
    <div class="p-table__item">{{ Arr::get($staff, 'paid_vacation_count') }}</div>
  </td>
  <!--<td class="p-table__tableData">
    <div class="p-table__item">12人</div>
  </td>-->
</tr>
