<?php
require_once(HEADER);
?>

<div class="jumbotron" style="margin-top:40px;box-shadow:0px 5px 2px 3px darkblue;background-color:rebeccapurple;">
  <h1 class="text-center" style="color:#fff;">todos</h1>
  <div class="card" style="box-shadow:1px 6px 3px 1px lavender;">
    <div class="card-body">
      <div class="list-group mylist">
        <div class="list-group-item list-group-item-action myitem">
          <i class="fas fa-angle-down" style="left: 0px;font-size: 30px;color: gainsboro;transform: translateY(-45%);"></i>
          <form id="create">
            <input type="text" id="c_enter" class="form-control add" onkeydown="createFun();" name="task" placeholder="What needs to be done?">
          </form>
        </div>


      </div>

      <div class="all_act row" style="display: none;align-items: flex-end;height: 48px;">
        <span class="col-sm-4" style="font-size:.875rem;font-size: .875rem;padding-bottom: 6px;padding-left: 22px;"> <span class="itm">3</span> items left</span>
        <div class="btn-group btn-group-sm col-sm-5 mybtn">
          <a href="" style="border:1px solid;" class="btn btn-default all">All</a>
          <a href="" class="btn btn-default active">Active</a>
          <a href="" class="btn btn-default completed">Complited</a>
        </div>
        <div class="col-sm-3 text-right"><a href="" class="btn btn-default clear" style="padding: 4px 20px;display:none;">Clear complited</a></div>
      </div>

    </div>
  </div>

</div>

<?php
require_once(FOOTER);
?>