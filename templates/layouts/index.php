<?php
define('DOT', '.');
require_once DOT . "/bootstrap.php";

//Home page//
$Route->add('/gexams/', function(){

    $Core = new Apps\Core;
    $Template = new Apps\Template;
    $Template->assign("title", "gexams");

    $Template->addheader("layouts.header");
    $Template->addfooter('layouts.footer');
    $Template->render("login");

},'GET');

$Route->add('/gexams/exit', function(){

	$Template = new Apps\Template;
	$Template->expire();
	$Template->redirect("/gexams/");
   

},'GET');

$Route->add('/gexams/dashboard', function(){

    $Core = new Apps\Core;
    $Template = new Apps\Template("/gexams/");
	$Template->assign("title", "dashboard");

	$Core->accid = $Template->data['accid'];
	$UserInfo = $Core->UserInfo($Template->data['accid']);
	$CTBStarted = $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']);

	$Core->examcode = $Template->data['examcode'];
	$Template->assign( "UserInfo", $Core->UserInfo($Template->data['accid']) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($Template->data['examcode']));
	$Template->assign( "CTBStarted", $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']));

	$rand_msg = array(
		"<strong>{$UserInfo->firstname} {$UserInfo->lastname}</strong> your Test is ready",
		"Hi <strong>{$UserInfo->firstname} {$UserInfo->lastname}</strong>, hope you're good?",
		"Welcome back <strong>{$UserInfo->firstname} {$UserInfo->lastname}</strong>, having fun?",
		"<strong>{$UserInfo->firstname} {$UserInfo->lastname}</strong>, what's up?",
		"Good to see you here <strong>{$UserInfo->firstname} {$UserInfo->lastname}</strong>, How's Life?"
	);
	
	$seo = array(
		"title"=>$rand_msg[array_rand($rand_msg)],
		"info"=>"Welcome to Ewaoche  CBT Portal."
	);

	$Template->assign( "actionlink", "");

	$Template->assign( "seo", $seo );
	
    $Template->addheader("layouts.dashboardheader");
	$Template->addfooter('layouts.dashboardfooter');
    $Template->render("dashboard.admin-dashboard");


},'GET');


$Route->add('/gexams/dashboard/{action}', function($action){

    $Core = new Apps\Core;
    $Template = new Apps\Template("/gexams/");
    $Template->assign("title", "dashboard");

	$Core->accid = $Template->data['accid'];
	$Core->examcode = $Template->data['examcode'];
	// $Core->accesscode = $Template->data['accesscode'];


	$UserInfo = $Core->UserInfo($Template->data['accid']);

	$Template->assign( "UserInfo", $Core->UserInfo($Template->data['accid']) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($Template->data['examcode']) );
	$Template->assign( "CTBStarted", $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']) );

	$Template->assign( "route", $action );

    $Template->addheader("layouts.dashboardheader");
	$Template->addfooter('layouts.dashboardfooter');
	$Template->assign( "actionlink", "");

	if($action=="start"){

		$seo = array(
			"title"=>"<h2>Start CBT Examination</h2>",
			"info"=>"You are about to start your CBT Test",
		);

	}elseif($action=="admin-exams"){

		$ListExams = $Core->ListExams();
		$seo = array(
			"title"=>"All Examinations",
			"info"=>"All Exams"
		);
		$Template->assign( "ListExams", $ListExams );
		$Template->assign( "actionlink", '<li><a href="./dashboard/add-exam/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Exam</a></li>');
	
	}elseif($action=="result"){
		$seo = array(
			"title"=>"All Accounts",
			"info"=>"All Candidates"
		);
	
	
	}elseif($action=="admin-accounts"){

		$seo = array(
			"title"=>"All Accounts",
			"info"=>"All Candidates"
		);
		
		
		$ListAccounts = $Core->ListAccounts();
		$Template->assign( "ListAccounts", $ListAccounts );
		$Template->assign( "actionlink", '<li><a href="./dashboard/add-user/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Account</a></li>');
	
	}elseif($action=="question"){
		
		//$Template->data['qnumber'] = $session->data['qnumber'];
		//$Template->save();

		$seo = array(
			"title"=>"Live CBT Assessment",
			"info"=>"Good luck"
		);

		$CTBInfo = $Core->CTBInfo($UserInfo->accid,$Core->examcode);

		$Template->assign( "CTBInfo", $CTBInfo );

		$GetCBTFirstQuestion = $Core->GetCBTFirstQuestion($Core->examcode);
		$Template->assign( "GetCBTFirstQuestion", $GetCBTFirstQuestion );

		$CuurentQuestion = $Template->data['qnumber']; 
		$Template->assign( "CuurentQuestion", $CuurentQuestion );

		$GetQuestions = $Core->GetQuestions($CTBInfo->lastquestion);
		$Template->assign( "GetQuestions", $GetQuestions );


	}
	elseif($action=="add-exam"){
	
		$seo = array(
			"title"=>"<h2>Add new Candidate</h2>",
			"info"=>"Bring them on-board"
		);
	}
	elseif($action=="add-user"){
		$ListExams = $Core->ListExams();
		$Template-> assign("ListExams", $ListExams);

    	$seo = array(
		"title"=>"<h2>Add new Candidate</h2>",
		"info"=>"Bring them on-board"
	);

	}
	elseif($action=="admin-flush"){
	
	   $ThisExam = $Core->GetExamInfo($eid);
	   
	   $Template->assign("ThisExam ", $ThisExam );
		$seo = array(
			"title"=>"<h2>Flaush Examination Questions</h2>",
			"info"=>"Flush Exam from database"
		);
	

	}
	elseif($action=="admin-results"){
		$ListCBTs = $Core->ListCBTs();
		// $Core->debug($ListCBTs);
		$Template->assign("ListCBTs", $ListCBTs);
		$Template->assign( "actionlink", '<li><a href="./dashboard/add-user/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Account</a></li>');
		


		$seo = array(
			"title"=>"All Results",
			"info"=>"All Candidates exam results"
		);
	}
	elseif($action=="admin-edit-exam"){
		$eid = $_REQUEST['id'];
		$ThisExam = $Core->GetExamInfo($eid);
		$Template->assign("ThisExam", $ThisExam);

		$seo = array(
			"title"=>"<h2>Edit Examination</h2>",
			"info"=>"Update Exam to database"
		);
	
	}
	elseif($action=="completed"){
		
		$Template->assign( "actionlink", '<li><a href="./dashboard/add-user/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Account</a></li>');
		


		$seo = array(
			"title"=>"<h2>CTB Completed</h2>",
			"info"=>"Thank you, you did it!"
		);
	}

	$Template->assign( "seo", $seo );
	$Template->render("dashboard.{$action}");
   


},'GET');




$Route->add('/gexams/forms/{cmd}', function($cmd){

    $Core = new Apps\Core;
    $Template = new Apps\Template();

	$data = $Core->post($_POST);

	$UserInfo = $Core->UserInfo($Template->data['accid']);
	$ExamInfo = $Core->ExamInfo($Template->data['examcode']);
	
    //Now bring in the Processor for this
	if($cmd=="login"){

	
		$examcode = $data->examcode;
		$VerifyEC = $Core->VerifyEC($examcode);
	
		$accesscode = $data->accesscode;
		$VerifyAC = $Core->VerifyAC($accesscode);
     
		if( $VerifyEC->id && $VerifyAC->accid ){
			
						
			$Template->data['accid'] = $VerifyAC->accid;
			$Template->data['examcode'] = $examcode;
			$Template->data['accesscode'] = $accesscode;
			$Template->data['dex_time'] = date('d-m-Y H:i:s');
			$Template->data['loggedin'] = true;
			$Template->data['login'] = true;
			$Template->data[auth_session_key] = true;
			$Template->save();
						
			$Template->redirect("/gexams/dashboard/");	
			
			
			
		}else{
			$Template->redirec("/gexams/");	
			
		}
	
	
	}elseif($cmd=="start"){

		$accid = $Template->data['accid'];
		$examcode = $Template->data['examcode'];
		
		$firstquestion = $Core->GetCBTFirstQuestion($examcode);
		
		$HasTakenExam = $Core->HasTakenExam($accid,$examcode);
		if($HasTakenExam){
			$Core->redirect_to("/gexams/dashboard/hasexam/");	
			exit();
		}else{

			$Template->data['qnumber']=1;
			$Template->save();

			$start = $Core->StartCBT($accid,$examcode,$firstquestion);
			if($start){
				$Core->redirect_to("/gexams/dashboard/question/");	
				exit();
			}else{
				$Core->redirect_to("/gexams/dashboard/start/");	
				exit();
			}
		}		
	
	}elseif($cmd=="admin-edit-question"){
		
    
		$qid = $data->qid;
				
		$question = $data->question;
		$update = $Core->UpdateQuestion($qid,"question",$question);
		
		$a = $data->a;
		$update = $Core->UpdateQuestion($qid,"a",$a);
	   
		$b = $data->b;
		$update = $Core->UpdateQuestion($qid,"b",$b);
	   
		$c = $data->c;
		$update = $Core->UpdateQuestion($qid,"c",$c);
	   
		$d = $data->d;
		$update = $Core->UpdateQuestion($qid,"d",$d);
	   
		$result = $data->result;
		$update = $Core->UpdateQuestion($qid,"result",$result);
		
		$mark = $data->mark;
		$update = $Core->UpdateQuestion($qid,"mark",$mark);
		
		
		$Core->redirect_to("/gexams/dashboard/admin-edit-question/q/{$qid}/");
	
	}elseif($cmd=="admin-edit-exam"){
		
		$eid = $data->eid;
		$Template->assign("eid", $eid);
		$examtitle = $data->examtitle;
		$examcode = $data->examcode;
		
		$Core->UpdateExam($eid,"title",$examtitle);
		$Template->assign("UpdateExam", $UpdateExam);

		$Core->UpdateExam($eid,"code",$examcode);
		
		$Core->redirect_to("/gexams/dashboard/admin-edit-exam/{$eid}/");
		
	}elseif($cmd=="add-exam"){
		
		$examtitle = $data->examtitle;
		$examcode = $data->examcode;
		
		$create = $Core->CreateExam($examcode,$examtitle);
		
		if( $create ){
			$Core->redirect_to("/gexams/dashboard/admin-exams/");	
		}else{
			$Core->redirect_to("/gexams/dashboard/add-exam/");	
		}
		
		
	}elseif($cmd=="upload-question"){
		
		$eid = $data->eid;
		$Template->assign("eid", $eid);	
		 $ThisExam = $Core->GetExamInfo($eid);
		$examcode = $ThisExam->code;

		
		if($_FILES['csv_file']['name']!=""){
						
			$tmp_name = basename($_FILES['csv_file']['tmp_name']);
			$name = basename($_FILES['csv_file']['name']);
			$ext = end( (explode(".", $name)) );
			$AllowedExt = array("csv");
			if(!in_array($ext,$AllowedExt)){
				$Core->redirect("./dashboard/upload-question/");	
				exit();
			}
			
			$raw_csv = $_FILES['csv_file']['tmp_name'];
			$ArrCSV = $Core->csv_to_array($raw_csv,",");
			
			foreach($ArrCSV as $csv){
				$Core->NewQuestion($examcode,$Core->mysql_prepare_value($csv['QUESTION']),$Core->mysql_prepare_value($csv['A']),$Core->mysql_prepare_value($csv['B']),$Core->mysql_prepare_value($csv['C']),$Core->mysql_prepare_value($csv['D']),$Core->mysql_prepare_value($csv['ANSWER']));
			}
			
			$Core->redirect_to("/gexams/dashboard/admin-questions/{$eid}/");	
		}else{
			$Core->redirect_to("/gexams/dashboard/upload-question/");	
		}
	
	
	}elseif($cmd=="admin-flush"){
		$eid = $data->eid;
		$ThisExam = $Core->GetExamInfo($eid);
		$examcode = $ThisExam->code;
		$deleteexam = 0;
		if(isset($data->deleteexam)){
			$deleteexam = $data->deleteexam;
		}
		
		
		$flush = $Core->FlushQuestions($examcode);
		if($deleteexam){
			$del = $Core->DeleteExam($examcode);
		}

		$Core->redirect_to("/gexams/dashboard/admin-exams/");	


	}elseif($cmd=="question"){

		$accid = $UserInfo->accid;
		$qid = $data->qid;
		$ThisQuestion = $Core->GetQuestions($qid);

		$CBTInfo = $Core->CBTInfo($accid,$ThisQuestion->examcode);
		$Template->assign("CBTInfo", $CBTInfo);
		
		
		$qnum = $Template->data['qnumber'];
		$ans = "a" . $qnum;
		
		$answer = strtoupper($data->answer);
		$nextquestion = $qid + 1;

		//$Core->debug($nextquestion);
		
		$janswers = json_decode($CBTInfo->janswers);
		$_janswers[$qid] = array(
			"qid" => $qid,
			"mark" => $ThisQuestion->mark,
			"result" => $ThisQuestion->result,
			"correct" => $ThisQuestion->result==$answer?1:0,
			"answer" => $answer
		);
		
		$jamerge = array_merge($janswers,$_janswers);
										
		$Template->data['qnumber'] = ($Template->data['qnumber'] + 1);
		$Template->save();
		
		$update = $Core->UpdateMyCBT($accid,$ThisQuestion->examcode,$ans,$answer);
		$update = $Core->UpdateMyCBT($accid,$ThisQuestion->examcode,"janswers",json_encode($jamerge));
		
		$hasnext = $Core->GetCBTLastQuestion($ThisQuestion->examcode);
		if( $nextquestion <= $hasnext ){
			$update = $Core->UpdateMyCBT($accid,$ThisQuestion->examcode,"lastquestion",$nextquestion);
			$Core->redirect_to("/gexams/dashboard/question/");	
			exit();
		}else{
			$update = $Core->UpdateMyCBT($accid,$ThisQuestion->examcode,"status","completed");
			$update = $Core->UpdateMyCBT($accid,$ThisQuestion->examcode,"ended", time());
			$Core->redirect_to("/gexams/dashboard/completed/");	
			exit();
		}
	}elseif($cmd=="admin-accounts"){
		
		$accids = $data->accids;
		foreach($accids as $accid){
			$Core->DeleteUser($accid);
		}
		$Core->redirect_to("/gexams/dashboard/admin-accounts/");	
		
	}elseif($cmd=="delete-user"){
		
		$accid = $data->accid;
		$del = $Core->DeleteUser($accid);
		$Core->redirect_to("/gexams/dashboard/admin-accounts/");	
	
	}elseif($cmd=="edit-user"){
		
		 $accid = $data->accid;
		// $Core->debug($accid);
		
		$accesscode = $data->accesscode;
		$Core->UpdateUser($accid,"profile_exams",$json_profiled_exams);
		
		$profiledexams = $data->profiledexams;
		$json_profiled_exams = json_encode($profiledexams);
		$Core->UpdateUser($accid,"profile_exams",$json_profiled_exams);

		$fn = $data->fn;
		$Core->UpdateUser($accid,"firstname",$fn);
		
		$ln = $data->ln;
		$Core->UpdateUser($accid,"lastname",$ln);
		
		$sex = $data->sex;
		$Core->UpdateUser($accid,"sex",$sex);
		
		$email = $data->email;
		$Core->UpdateUser($accid,"email",$email);
		
		$mobile = $data->mobile;
		$Core->UpdateUser($accid,"mobile",$mobile);
		
		$Core->redirect_to("/gexams/dashboard/edit-user/{$accid}");	
		
		
	}elseif($cmd=="add-user"){
		
		$profiledexams = $data->profiledexams;
		$json_profiled_exams = json_encode($profiledexams);

		$fn = $data->fn;
		$ln = $data->ln;
		$sex = $data->sex;
		$email = $data->email;
		$mobile = $data->mobile;
		$accesscode = $data->accesscode;
		
		$new = $Core->NewCandidate($accesscode,$fn,$ln,$sex,$email,$mobile,$json_profiled_exams);
		if($new){
			$Core->redirect_to("/gexams/dashboard/admin-accounts/");	
			exit();
		}else{
			$Core->redirect_to("/gexams/dashboard/add-user/");	
			exit();
		}
		
	}
    
    $examcode = $data->examcode;
    $accesscode = $data->accesscode;
    
    $Template->reditect("/gexams/dashboard");
   


},'POST');


$Route->add('/gexams/dashboard/print/{id}/print', function($id){

    $Core = new Apps\Core;
    $Template = new Apps\Template("/gexams/");
    $Template->assign("title", "dashboard");

	$Core->accid = $Template->data['accid'];
	$Core->examcode = $Template->data['examcode'];

	$UserInfo = $Core->UserInfo($Template->data['accid']);

	$Template->assign( "UserInfo", $Core->UserInfo($Template->data['accid']) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($Template->data['examcode']) );
	$Template->assign( "CTBStarted", $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']) );


	$Template->render("dashboard.print");


},'GET');

$Route->add('/gexams/dashboard/print/printpdf', function(){

    $Core = new Apps\Core;
    $Template = new Apps\Template;
	$Template->assign("title", "dashboard");
	
	$accid = $_REQUEST['accid'];
	$examcode = $_REQUEST['examcode'];

	$UserInfo = $Core->UserInfo($accid);

	$Template->assign( "UserInfo", $Core->UserInfo($accid) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($examcode) );
	$Template->assign( "CTBStarted", $Core->CTBStarted($accid,$examcode) );


	$Template->render("dashboard.pdf");


},'GET');

$Route->add('/gexams/dashboard/print/{id}/pdf', function($id){

	$Core = new Apps\Core;
	$Template = new Apps\Template("/gexams/");
	

	$accid = $Template->data['accid'];
	$examcode = $Template->data['examcode'];
	$UserInfo = $Core->UserInfo($Template->data['accid']);

	$options = new Dompdf\Options();
	$options->set('defaultFont', 'Courier');
	$dompdf = new Dompdf\Dompdf($options);

	$stream = file_get_contents("http://localhost/gexams/dashboard/print/printpdf?id={$id}&accid={$accid}&examcode={$examcode}");
	$dompdf->loadHtml($stream);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	$dompdf->stream();


},'GET');

$Route->add('/gexams/dashboard/{action}/{id}', function($action, $id){

    $Core = new Apps\Core;
    $Template = new Apps\Template("/gexams/");
	$Template->assign("title", "dashboard");
	
	$seo = array(
		"title"=>"<h2>Edit Examination</h2>",
		"info"=>"Update Exam to database"
	);
	


   
	$UserInfo = $Core->UserInfo($Template->data['accid']);
	$Template->assign( "UserInfo", $Core->UserInfo($Template->data['accid']) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($Template->data['examcode']) );
	$Template->assign( "CTBStarted", $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']) );
	$Template->addheader("layouts.dashboardheader");
    $Template->addfooter('layouts.dashboardfooter');

	if($action=="admin-edit-exam"){
		$ThisExam = $Core->GetExamInfo($id);
		$Template->assign( "ThisExam", $ThisExam );
		$Template->assign( "actionlink", ""  );
	}elseif($action=="admin-questions"){
		$ThisExam = $Core->GetExamInfo($id);
		$ListQuestions = $Core->ListExamQuestions($ThisExam->code);
		$Template->assign( "ListQuestions", $ListQuestions );
		$seo = array(
			"title"=>"All Questions",
			"info"=>"All Questions"
		);
		
		$Template->assign( "actionlink", ""  );
	}elseif($action=="upload-question"){

		$ThisExam = $Core->GetExamInfo($id);
		$Template->assign("ThisExam", $ThisExam);
		//  $Core->debug($ThisExam);

		$seo = array(
			"title"=>"<h2>Upload new Question</h2>",
			"info"=>"Upload new Question to database"
		);
		$Template->assign( "actionlink", ""  );

	}
	elseif($action=="delete-user"){
		$accid = $id;
		$Template->assign("accid",$accid );

		$ThisUser = $Core->UserInfo($accid);
		$seo = array(
			"title"=>"<h2>Delete account for {$ThisUser->firstname} {$ThisUser->lastname}</h2>",
			"info"=>"delete account"
		);
		$Template->assign( "actionlink", ""  );

	}
	
	elseif($action=="admin-flush"){

		$ThisExam = $Core->GetExamInfo($id);
		$Template->assign("ThisExam",$ThisExam );
		$seo = array(
			"title"=>"<h2>Flaush Examination Questions</h2>",
			"info"=>"Flush Exam from database"
		);
		$Template->assign( "actionlink", ""  );


	}
	elseif($action=="edit-user"){
		// $accid = $id;
		$ThisUser = $Core->UserInfo($id);
		$Template->assign("ThisUser", $ThisUser);
		//  $Core->debug($ThisUser);

		$ProfiledExams = json_decode($ThisUser->profile_exams);
		
		$Template->assign("ProfiledExams", $ProfiledExams);

		
		$ListExams = $Core->ListExams();
		$Template->assign("ListExams", $ListExams);

		$seo = array(
			"title"=>"<h2>Edit Candidate</h2>",
			"info"=>"Ensure they are on-board"
		);

		$Template->assign( "actionlink", ""  );


	}

	$Template->assign( "seo", $seo );
	$Template->assign( "route", $action );

	$Template->render("dashboard.{$action}");



},'GET');

$Route->add("/gexams/dashboard/{action}/{question}/{id}", function($action, $question, $id){
	$Core = new Apps\Core;
    $Template = new Apps\Template("/gexams/");
	$Template->assign("title", "dashboard");
	$Template->addheader("layouts.dashboardheader");
	$Template->addfooter('layouts.dashboardfooter');

	$UserInfo = $Core->UserInfo($Template->data['accid']);
	$Template->assign( "UserInfo", $Core->UserInfo($Template->data['accid']) );
	$Template->assign( "ExamInfo", $Core->ExamInfo($Template->data['examcode']) );
	$Template->assign( "CTBStarted", $Core->CTBStarted($Template->data['accid'],$Template->data['examcode']) );

	if($action =="admin-edit-question"){

		$Question = $Core->GetQuestions($id);
		$Template->assign("Question", $Question);
		// $Core->debug($Question);
		$seo = array(
			"title"=>"<h2>Edit Question</h2>",
			"info"=>"Update Question to database"
		);
	}
	$Template->assign( "actionlink", ""  );


	$Template->assign( "seo", $seo );
	$Template->assign( "route", $action );
	$Template->render("dashboard.{$action}");


}, "GET");



$Route->run('/');
