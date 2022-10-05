<script>
$('.delete_sub_image').on('click', function() {
  $("#file_preview_sub").css('background', '');
  if ($(this).data('picture_id')) {
    $('input:hidden[name="delete_image_id"]').val($(this).data('picture_id'));
  } else {
    $('input:hidden[name="delete_flg"]').val(true);
  }
});
</script>
