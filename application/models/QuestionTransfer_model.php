                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php
class QuestionTransfer_model extends CI_Model{

	function __construct(){

		parent::__construct();

    $this->load->config('question_config');

    $this->aQuestions = array();
    $this->aGroups = array();

    $this->iQuestionOrder = 1;

    $this->aQuestionTypes = $this->config->item('question_types');
    $this->aAnswerTypes = $this->config->item('answer_types');


    $this->aAnswerType_FormField_Map = array(

      $this->aAnswerTypes['single_value_text']      => 'text',
      $this->aAnswerTypes['single_value_radio']     => 'radio',
      $this->aAnswerTypes['multi_value_checkbox']  => 'checkbox',
      $this->aAnswerTypes['single_value_textarea']  => 'textarea',
      $this->aAnswerTypes['single_value_select']    => 'select',
    );

		$this->aFormFields = array(
			'text' => 1,
			'radio' => 2,
			'checkbox' => 3,
			'textarea' => 4,
			'select' => 5
		);


		$this->load->model('Common_model');

	}



	function transfer() {

    $this->load->model('question_model');
    $aQuestionsMasterData =$this->question_model->getQuestionMasterData();

    foreach($aQuestionsMasterData AS $aQuestionDetails) {

      $aQuestionDetails = $this->question_model->normalizeQuestion($aQuestionDetails);

      if($aQuestionDetails['question_type'] == $this->aQuestionTypes['group']) {

        foreach($aQuestionDetails['questions'] AS $aQuestionDetails2) {

          $aQuestionDetails2 = $this->question_model->normalizeQuestion($aQuestionDetails2);

          $iCollectionQuestionUid = $this->createCollectionQuestion($aQuestionDetails);

					$this->iQuestionOrder++;

					//create all questions under this collection
					list($iQuestionUid, $iGroupId) = $this->processQuestion($aQuestionDetails2, TRUE, $iCollectionQuestionUid);

					// add collection question to the group
					$this->aGroups[$iGroupId][] = $iCollectionQuestionUid;
        }

      } elseif($aQuestionDetails['question_type'] == $this->aQuestionTypes['individual']) {

        $this->processQuestion($aQuestionDetails);
      }


      $this->iQuestionOrder++;
    }


    return array($this->aQuestions, $this->aGroups);

  }


  function processQuestion($aQuestionDetails, $bIsCollection = FALSE, $iCollectionQuestionUid=NULL) {

    $aConfig = array(
      'table' => 'questions',
      'field' => 'uid'
    );



    $iQuestionUid = $this->Common_model->generateUniqueNumber($aConfig);


    $aQuestionData = array(
      'uid' => $iQuestionUid,
      'title' => $aQuestionDetails['title'],

      'answer_type' => $aQuestionDetails['answer_type'],
      'form_field' => $this->aFormFields[ $this->aAnswerType_FormField_Map[$aQuestionDetails['answer_type']] ],
      'type' => $bIsCollection ? $this->aQuestionTypes['group'] : $this->aQuestionTypes['individual'],
      'is_multipliable' => $aQuestionDetails['multiple_answer_sets'] == TRUE ? 1 : 0,

      'field_name' => $aQuestionDetails['field_name'],
      'table_name' => $aQuestionDetails['table_name'],
      //'is_required_question' => 0,
      //'ci_validation' => '',
      //'group_id' => $aQuestionDetails['table_name'],
      'question_order' => $this->iQuestionOrder
    );


    if( $bIsCollection ) {
      $aQuestionData['collection_question_uid'] = $iCollectionQuestionUid;
    }





    $this->aQuestions[] = $aQuestionData;

    // group information
    if( ! isset($this->aGroups[$aQuestionDetails['group_id']]) ) {
      $this->aGroups[$aQuestionDetails['group_id']] = array();
    }
    $this->aGroups[$aQuestionDetails['group_id']][] = $iQuestionUid;

		return array($iQuestionUid, $aQuestionDetails['group_id']);
  }


  function createCollectionQuestion($aQuestionDetails) {



    $aConfig = array(
      'table' => 'questions',
      'field' => 'uid'
    );

    $iQuestionUid = $this->Common_model->generateUniqueNumber($aConfig);


    $aData = array(
      'uid' 						=> $iQuestionUid,
      'title' 					=> $aQuestionDetails['title'],

      'answer_type' 		=> $aQuestionDetails['answer_type'],
      'form_field' 			=> $this->aFormFields[ $this->aAnswerType_FormField_Map[$aQuestionDetails['answer_type']] ],
      'type' 						=> $this->aQuestionTypes['group'],
      'is_multipliable' => $aQuestionDetails['multiple_answer_sets'] == TRUE ? 1 : 0,

      'field_name' 			=> $aQuestionDetails['field_name'],
      'table_name' 			=> $aQuestionDetails['table_name'],
      'question_order' => $this->iQuestionOrder
    );

		$this->db->insert('questions', $aData);

    return $this->db->insert_id();
  }
}
