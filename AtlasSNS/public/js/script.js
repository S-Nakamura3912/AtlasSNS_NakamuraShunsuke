<script>
  $(function () {
    // アコーディオンメニュー開閉
    $('.js-accordion-toggle').on('click', function () {
      $(this).next('.js-accordion-menu').stop(true, true).slideToggle();
    });



  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click', function () {
    // モーダルの中身(class="js-modal")の表示
    $('.js-modal').fadeIn();
  // 押されたボタンから投稿内容を取得し変数へ格納
  var post = $(this).data('post');
  // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
  var post_id = $(this).data('post_id');

  // 取得した投稿内容をモーダルの中身へ渡す
  $('.modal_post').val(post);
  // 取得した投稿のidをモーダルの中身へ渡す
  $('.modal_id').val(post_id);
  // フォームの送信先を設定
  $('#editPostForm').attr('action', '/post/' + post_id + '/update');
  return false;
      });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
  return false;
      });
    });
</script>
