$(document).ready(function(){

  createFun = function(){
    if (event.which == '13') {
      event.preventDefault();
      if ($('.add').val() != '') {
        
        $("#create").submit(function (e) {
          e.preventDefault();
          console.log('value = ' + $('#create input').val());
          $.ajax({
            type: 'post',
            url: 'http://localhost/todos/home/create',
            data: $('#create').serialize(),
            success: function () {
              $('#create input').val('');
              updateData();
            }
          });
        });
        $('#create').submit();
        $("#create").unbind("submit");
        
      }
    }
  }


  editFun = function (id) {
    if (event.which == '13') {
      event.preventDefault();
      if ($('#edit' + id + ' .edit_inp').val() != '') {

        $('#edit' + id).submit(function (e) {
          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'http://localhost/todos/home/edit/'+id,
            data: $('#edit'+id).serialize(),
            success: function (data) {
              console.log(data);
              
              $('#edit' + id + ' .edit_inp').attr('readonly', 'true');
              $('#edit' + id + ' .edit_inp').css("cursor", "pointer");
              updateData();
            }
          });
        });
        $('#edit' + id).submit();
        $('#edit' + id).unbind("submit");

      }
    }
  }



  updateData = function(mybtn = 'All') {
    $.ajax({
      type: "GET",
      url: "http://localhost/todos/home/ajaxview",
      dataType: "json",
      success: function (text) {
        $('.mylist').children().not(':first-child').remove();
        var foo = 0;
        text.forEach(mydata => {
          if (mydata['complete'] == '1') {
            foo = 1;
            return false;
          }
        });

        if (foo == 1) {
          $('.clear').css('display', 'block');
        } else if (foo == 0) {
          $('.clear').css('display', 'none');
        }

        if (text.length > 0) {
          $('.all_act').css("display", "flex");
        } else {
          $('.all_act').css("display", "none");
        }

        if (mybtn == 'All') {
          $('.btn-group .btn').css('border', 'none');
          $('.all').css('border', '1px solid');
        } else if(mybtn == 'Active'){
          var text = text.filter(function (txt) {
            return txt.complete == '0';
          });
        } else if (mybtn == 'Complited'){
          var text = text.filter(function (txt) {
            return txt.complete == '1';
          });
        }
        
        $('.itm').text(text.length);

        text.forEach(todo => {
          var form = document.createElement("form");
          $(form).attr({
            'id': 'edit' + todo['id']
          });
          $n = '<div class="list-group-item list-group-item-action myitem"><input type="checkbox" id="todo" class="mytodo checkno' + todo['id'] + '" onchange="checkFun(' + todo['id'] + ');" name="todo" value="todo"> <input type="text" class="form-control edit_inp" style="padding-right: 76px;" ';

          $n = $n + 'name="task" onkeydown="editFun(' + todo['id'] + ');" value="' + todo['task'] + '" readonly> <a style="cursor:pointer;" onclick="delFun(' + todo['id'] + ');"><i class="fas fa-times"></i></a></div >';
          $(form).append($n);
          $('.mylist').append($(form));

          if(todo['complete'] == '1'){
            $('#edit' + todo['id'] + ' .edit_inp').addClass('special_class');
            $('.checkno' + todo['id']).prop("checked", true);
          } else if (todo['complete'] == '0'){
            $('#edit' + todo['id'] + ' .edit_inp').removeClass('special_class');
            $('#edit' + todo['id'] + ' .edit_inp').css('text-decoration', 'no');
            $('.checkno' + todo['id']).prop("checked", false);
          }
        });
      }
    });
  }
  updateData();

  delFun = function(id){
    $.ajax({
      type: 'get',
      url: 'http://localhost/todos/home/delete/' + id,
      success: function () {
        updateData();
      }
    });
  }


  checkFun = function(id){
    if ($('.checkno' + id).is(":checked")) {
      $.ajax({
        type: 'post',
        url: 'http://localhost/todos/home/check/' + id,
        data: $('.checkno' + id).serialize(),
        success: function (data) {
          $('#edit' + id + ' .edit_inp').addClass('special_class');
          updateData();
        }
      });
    }
    else{
      $.ajax({
        type: 'post',
        url: 'http://localhost/todos/home/uncheck/' + id,
        data: $('.checkno' + id).serialize(),
        success: function (data) {
          $('#edit' + id + ' .edit_inp').removeClass('special_class');
          $('#edit' + id + ' .edit_inp').css('text-decoration', 'none');
          updateData();
        }
      });
    }
  }

  clearFun = function(){
    $.ajax({
      type: 'post',
      url: 'http://localhost/todos/home/clear/',
      data: $('.clear').serialize(),
      success: function (data) {
        updateData();
      }
    });
  }


  $('.all').on('click',function(){
    event.preventDefault();
    $('.btn-group .btn').css('border', 'none');
    $(this).css('border', '1px solid');
    updateData($(this).text());
  });

  $('.active').on('click', function () {
    event.preventDefault();
    $('.btn-group .btn').css('border','none');
    $(this).css('border','1px solid');
    updateData($(this).text());
  });

  $('.completed').on('click', function () {
    event.preventDefault();
    $('.btn-group .btn').css('border', 'none');
    $(this).css('border', '1px solid');
    updateData($(this).text());
  });


  $('.clear').on('click', function () {
    event.preventDefault();
    clearFun();
  });



  $("body").delegate(".mylist input:not(.add)", "click", function () {
    if(!$(this).hasClass('special_class')){
      $(this).css("cursor", "text");
      $(this).removeAttr('readonly');
    }
  });

  $("body").delegate(".mylist input:not(.add)", "focusout", function () {
    $(".mylist input:not(.add)").attr('readonly', 'true');
    $(".mylist input:not(.add)").css("cursor", "pointer");
  });



});
