<h4>Temporary Surveys</h4>

<div class="row">
  <div class="col-md-6">

    <h4>Actions</h4>
    <ol>
      <li><a href="<?php echo $c_base_url, 'developer/generate_config_array'?>">Regenerate Config Array</a></li>

      <li><a href="<?php echo $c_base_url, 'developer/generate_family_template'?>">Regenerate Family template</a></li>
    </ol>
  </div>
</div>

<table class="table">
  <th>
    <td></td>
    <td>Created On</td>
    <td>Enumerator</td>
    <td>Raw Data</td>
    <td>Delete Survey</td>
  </th>
<?php foreach($aTemporarySurveys AS $oItem):?>
  <tr>

    <td><?php echo $oItem->id;?></td>
    <td> - </td>
    <td> - </td>
    <td>
      <a href="<?php echo $c_base_url, 'developer/preview_data/', $oItem->id;?>">
        Raw data
      </a>
    </td>
    <td>
      <a href="<?php echo $c_base_url, 'survey_result/view/', $oItem->survey_id;?>">
        Final Survey Data
      </a>

    </td>

    <td>
      <a href="<?php echo $c_base_url, 'test/delete_survey/', $oItem->survey_id;?>">
        Delete Survey
      </a>

    </td>

  </tr>
<?php endforeach;?>
</table>
