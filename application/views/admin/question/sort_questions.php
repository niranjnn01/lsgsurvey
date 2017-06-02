<style>
 #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
 #sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
 html>body #sortable li { height: 1.5em; line-height: 1.2em; }
 .ui-state-highlight { height: 1.5em; line-height: 1.2em; }
 </style>




<div class="row">
  <div class="col-md-8">

    <div class="row">
      <div class="col-md-12">

        <a href="#" id="update_order" class="pull-right btn btn-primary">
          Update Order
        </a>

      </div>
    </div>

    <div class="row">
      <div class="col-md-12" style="font-size:10px;">
        <ul id="sortable">
          <?php //p($aQuestions);?>
          <?php foreach($aQuestions AS $oItem):?>
            <li class="ui-state-default" style="height:auto;" data-uid="<?php echo $oItem->uid;?>">
              <?php echo $oItem->question_order, '. ', $oItem->title;?>
            </li>

          <?php endforeach;?>
        </ul>
      </div>
    </div>

  </div>
</div>
