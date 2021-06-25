{{--
  @include('admin.element._table_no_element', ['colspan' = '7', $message => '登録されている店舗がありません'])
--}}
<!-- ! テーブルに1件も登録されていない場合に表示してください -->
<tr class="p-table__data__tableRow">
  <td class="p-table__tableData" colspan="{{ $colspan ?? '0' }}">
    <p class="nodata">{{ $message ?? '' }}</p>
  </td>
</tr>

