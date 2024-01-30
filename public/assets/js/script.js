
$(document).ready(function(){
  $(window).scroll(function(){
      if($(window).scrollTop()>notif_top){
          $('#notif-area').addClass('fixed');
      }else{
          $('#notif-area').removeClass('fixed');
      }
  })
})

function ajaxAPI(menu,url_action,value,action){
  $.ajax({
      url: api_url,
      method: 'post',
      data: {
          value : value,
          menu : menu,
          url_action : url_action,
          action : action,
          _token : _token
      },
      success: function (data) {
          var result = JSON.parse(data);
          return result;
      }, error: function (xhr, ajaxOptions, thrownError) {
          console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
      },complete: function(data) {
          getMatrix();
      }
  }); 
}