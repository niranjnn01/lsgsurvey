
<div class="repeating-row odd-row">
<div class="counter">1</div>
  <div class="row">
    <div class="col-md-3">
      <label class="small">പേര്</label>
        <span class="q_uid_2">
          <input type="text" name="name{row_number}" data-rule-required="true" class="form-control"/>
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">സ്ത്രീ / പുരുഷൻ</label>
        <span class="q_uid_3">
          <select name="gender{row_number}" class="form-control">
            <option value="1">സ്ത്രീ</option>
            <option value="2">പുരുഷൻ</option>
          </select>
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">ഇലക്ഷൻ ഐ. ഡി.</label>
        <span class="q_uid_4">
          <input type="text" name="election_id{row_number}" class="form-control">
        </span>
    </div>

    <div class="col-md-3">
      <label class="small">ആധാർ നം</label>
        <span class="q_uid_5">
          <input type="text" name="aadhaar_no{row_number}" class="form-control">
        </span>
    </div>
  </div>



  <div class="row">
    <div class="col-md-3">
      <label class="small">സംവരണം</label>
        <span class="q_uid_6">
          <select name="reservation{row_number}" class="form-control">
            <option value="0">ഇല്ലാ</option>
            <option value="1">പട്ടികജാതി/വർഗം</option>
            <option value="2">പിന്നോക്ക സമുദായം</option>
          </select>
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">മൊബൈൽ നമ്പർ</label>
        <span class="q_uid_7">
          <input type="text" name="mobile_no{row_number}" data-rule-number="true" data-rule-minlength="10" data-rule-maxlength="10" class="form-control">
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">ഇമെയിൽ വിലാസം</label>
        <span class="q_uid_8">
          <input type="text" name="email{row_number}" data-rule-email="true" class="form-control">
        </span>
    </div>

    <div class="col-md-3">
      <label class="small">വാട്സപ്പ്‍ നമ്പർം</label>
        <span class="q_uid_9">
          <input type="text" name="whatsapp_no{row_number}" data-rule-number="true" data-rule-minlength="10" data-rule-maxlength="10"  class="form-control">
        </span>
    </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <label class="small">ഗൃഹനാഥൻ / ഗൃഹനാഥയാണോ</label>
        <span class="q_uid_10">
          <select name="is_head_of_family{row_number}" data-rule-is-head-of-family="true" class="form-control">
            <option value="0">അല്ലാ</option>
            <option value="1">അതെ</option>
          </select>
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">ഗൃഹനാഥൻ / നാഥ യുമായുള്ള ബന്ധം</label>
        <span class="q_uid_11">
          <select name="relationship_to_head_of_house{row_number}" class="form-control">
            <option value="0">ബാധകമല്ലാ</option>
            <option value="1">അച്ഛൻ</option>
            <option value="2">അമ്മ</option>
            <option value="3">അപ്പൂപ്പൻ</option>
            <option value="4">അമ്മൂമ്മാ</option>
            <option value="5">സഹോദരി</option>
            <option value="6">സഹോദരൻ</option>
            <option value="7">മകൻ</option>
            <option value="8">മകൾ</option>
            <option value="9">ഭാര്യ</option>
            <option value="10">ഭർത്താവ്</option>
          </select>
        </span>
    </div>
    <div class="col-md-3">
      <label class="small">വിദ്യാഭ്യാസ യോഗ്യത</label>
        <span class="q_uid_12">
          <select name="educational_qualification{row_number}" class="form-control">
            <option value="1">10 - ൽ താഴെ</option>
            <option value="2">10 വരെ</option>
            <option value="3">Plus Two</option>
            <option value="4">ITI</option>
            <option value="5">Poly</option>
            <option value="6">Diploma</option>
            <option value="7">Degree</option>
          </select>
        </span>
    </div>

    <div class="col-md-3">
      <label class="small">തൊഴിൽ മേഖല</label>
        <span class="q_uid_13">
          <select name="employment_category{row_number}" class="form-control">

            <option value="1">തൊഴിൽ ഇല്ലാ</option>
            <option value="2">സർക്കാർ ജോലി</option>
            <option value="3">അർദ്ധ സർക്കാർ ജോലി</option>
            <option value="4">സ്വകാര്യ സ്ഥാപനത്തിൽ</option>
            <option value="5">ബിസിനസ്</option>
            <option value="6">വിദേശത്തു തൊഴിൽ</option>
          </select>
        </span>
    </div>
  </div>



    <div class="row">

      <div class="col-md-3">
        <?php
        $sFieldName = 'date_of_birth';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
        <input type="text" name="<?php echo $aQuestion['field_name'];?>{row_number}" class="form-control datepicker"/>
      </div>

      <div class="col-md-3">
        <?php
        $sFieldName = 'marital_status';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
        <?php echo $this->display_model->constructSelectElement_forMultiOptionQuestion($aQuestion, '{row_number}');?>
      </div>

      <div class="col-md-3">
        <?php
        $sFieldName = 'has_passport';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
          <?php echo form_dropdown(
              $aQuestion['field_name'] . '{row_number}',
              $aTrueFalseVariants[$aQuestion['true_false_variant']],
              0,
              'class="form-control"'); ?>
      </div>

      <div class="col-md-3">
        <?php
        $sFieldName = 'has_driving_license';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>

          <?php echo form_dropdown(
              $aQuestion['field_name'] . '{row_number}',
              $aTrueFalseVariants[$aQuestion['true_false_variant']],
              0,
              'class="form-control"'); ?>
      </div>
    </div>


    <div class="row">
      <div class="col-md-3">
        <?php
        $sFieldName = 'has_bank_account';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>

          <?php echo form_dropdown(
              $aQuestion['field_name'] . '{row_number}',
              $aTrueFalseVariants[$aQuestion['true_false_variant']],
              0,
              'class="form-control"'); ?>
      </div>

      <div class="col-md-3">
        <?php
        $sFieldName = 'blood_group';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
        <?php echo $this->display_model->constructSelectElement_forMultiOptionQuestion($aQuestion, '{row_number}');?>
      </div>
      <div class="col-md-3">
        <?php
        $sFieldName = 'pension_type_id';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
        <?php echo $this->display_model->constructSelectElement_forMultiOptionQuestion($aQuestion, '{row_number}');?>
      </div>
      <div class="col-md-3">
        <?php
        $sFieldName = 'insurance_type_id';
        $iQuestionNo = $aFieldName_Quid_map[$sFieldName];
        $aQuestion = $aQuestionsMasterData_raw[$iQuestionNo];
        ?>
        <label class="small"><?php echo $aQuestion['title'];?></label>
        <?php echo $this->display_model->constructSelectElement_forMultiOptionQuestion($aQuestion, '{row_number}');?>
      </div>
    </div>

</div>
