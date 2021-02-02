$(function(){
  //アカウント削除時の確認
  $(".delete-link").click(function(){
    if(confirm("本当にアカウントを削除しますか？")){
      //そのままsubmit(削除)
    }else{
      return false;
    }
  });

  //アラートフェイドアウト
  setTimeout("$('.alert-success').fadeOut('fast')", 3000)
});