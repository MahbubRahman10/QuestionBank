<?php

use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// /*-- Index/Home Page --*/
// Route::get('/home', function () {
//     return view('layouts.home');
// });


/*-- Language 
Route::get('/locale/{lang?}', function ($lang=null) {
	App::setlocale($lang);
    return view('index');
});
--*/

// Delete Duplicate data
Route::get('/sssss', 'Controller@space');

Route::get('/none', function()
{
	return view('none');
});

// Terms of use
Route::get('/terms-of-use', function()
{
	return view('term.term');
});

// Policy
Route::get('/policy', function()
{
	return view('term.policy');
});


Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{	
		// \Artisan::call('view:clear');
		// \Artisan::call('config:cache');
		return view('index');
	});
	// /*-- Language switcher --*/
	// Route::get('/lang', 'LanguageController@index');
	
	/*-- View Question --*/
	Route::get('/questions', function()
	{
		return view('view.viewquestion');
	});
	// View question Detail
	Route::get('/question/view/{category}/{id}', 'IndexController@questiondetails');
	/*-- View Exam --*/
	Route::get('exam', function()
	{
		return view('view.viewexam');
	});

	/*-- View School Category --*/
	Route::get('/school', 'IndexController@schoolcategory');
	/*-- View Madrasha Category --*/
	Route::get('/madrasha', 'IndexController@madrashacategory');
	/*-- View Board Category --*/
	Route::get('/board', 'IndexController@boardcategory');
	/*-- View University Exam Category --*/
	Route::get('university/question', function()
	{
		return view('QuestionCategory.university');
	});
	/*-- View University Question --*/
	Route::get('university/question/{university}/{id}', 'QuestionController@viewuniversityquestion');
	/*-- View Recruitment Exam Category --*/
	Route::get('recruitment/question', function()
	{
		return view('QuestionCategory.recruitment');
	});

	/*-- View Creative/MCQ Question --*/
	Route::get('{category}/questions/{questiontype}/{subjectid}/{clasecid}', 'QuestionController@viewquestion');
	/*-- Saved Creative/MCQ Question --*/
	Route::post('saved/question/{type}', 'QuestionController@savedquestion');


	/*-- Load More Question --*/
	Route::post('question/loadmore', 'QuestionController@loadmore');


	/*-- View Board Creative Question --*/
	Route::get('board/question/{clasubsecid}', 'QuestionController@viewboardquestion');

	/*-- View BCS Category --*/
	Route::get('bcs/{id}', 'QuestionController@viewbcsquestion');

	/*-- View recruitment question --*/
	Route::get('recruitment/question/{type}/{id}', 'QuestionController@viewrecruitmentquestion');


	/*-- Donwload PDF--*/
	Route::get('pdf/create/{clasubid}', 'PDFController@createnormalpdf');
	Route::get('pdf/{type}/create/{clasubsecid}', 'PDFController@createpdf');


	/*-- View question archive --*/
	Route::get('question/archive', function()
	{
		return view('QuestionCategory.questionsolve');
	});
	Route::get('question/archive/{category}', 'QuestionController@viewquestionsolution');
	Route::get('SolutionQuestion/{id}', 'QuestionController@downloadsolutionquestion');



	/*--------- EXAM *------------------*/

	// Exam Preparartion
	Route::get('exams/{category}/class/{id}', 'ExamController@viewexam');
	// Exam Preparartion on University 
	Route::get('exams/university/{type}', 'ExamController@viewuniversityexam');
	// Exam Preparartion on Other Exam (BCS, NTRCA, DPE, BANK )
	Route::get('exams/{type}', 'ExamController@viewotherexam');
	// Get Section if click Sectionwise Exam
	Route::get('exams/section/getsection', 'ExamController@getsection');
	// Ready to Exam
	Route::POST('exams/getexam/{id}', 'ExamController@getexam');
	// Before Exam Detail
	Route::get('exam/getexam', function () {
		return view('Exam.exams');
	})->middleware('auth');
	// Exam Start
	Route::get('/exam/question', function () {
		return view('exam');
	})->middleware('auth');
	// Redierct After Exam 
	Route::get('exams/result/submit', 'ExamController@endexam')->middleware('auth');
	// Result Sheet 
	Route::get('exam/resultsheet', 'ExamController@resultsheet')->middleware('auth');
	// Result Overview 
	Route::get('exam/overview', 'ResultController@index')->middleware('auth');
	Route::get('exam/overview/{token}', 'ResultController@overview')->middleware('auth');



	/*---------------- USER *------------------*/
	// User Dashboard 
	Route::get('user/dashboard', 'UserController@index')->middleware('auth');
	// User Profile 
	Route::get('user/profile', 'UserController@profile')->middleware('auth');
	// User Activities 
	Route::get('user/activities', 'UserController@activities')->middleware('auth');
	// User Exam
	Route::get('user/exam', 'UserController@exam')->middleware('auth');
	// User Exam Sheet
	Route::get('user/exam/{token}', 'UserController@resultsheet')->middleware('auth');
	// User Saved 
	Route::get('user/saved', 'UserController@saved')->middleware('auth');
	// View User Saved Question
	Route::get('user/saved/{type}/view/{id}', 'UserController@viewsaved')->middleware('auth');
	// Delete User Saved Question 
	Route::get('user/saved/{type}/delete/{id}', 'UserController@deletesaved')->middleware('auth');
	// User Forum 
	Route::get('user/forum', 'UserController@forum')->middleware('auth');
	// User settings 
	Route::get('user/settings', 'UserController@setting')->middleware('auth');
	// User Basic Account Update 
	Route::post('user/profile/update', 'UserController@updateprofile')->middleware('auth');
	// User Password Change 
	Route::post('user/profile/password/change', 'UserController@passwordchange')->middleware('auth');


	/*---------------   Forum   ------------------*/
	// Forum main page 
	Route::get('forum', 'ForumController@index');
	// View Forum Question 
	Route::get('forum/view/{id}', 'ForumController@view');
	// View Forum Question 
	Route::get('forum/category/{id}', 'ForumController@category');
	// add reply on Question 
	Route::post('forum/reply/{id}', 'ForumController@reply')->middleware('auth');
	// Edit Reply
	Route::get('forum/reply/editreply', 'ForumController@editreply')->middleware('auth');
	// Like Reply
	Route::get('forum/reply/likereply', 'ForumController@likereply')->middleware('auth');
	// Dislike Reply
	Route::get('forum/reply/dislikereply', 'ForumController@dislikereply')->middleware('auth');
	// Best Reply
	Route::get('forum/reply/bestreply/{id}', 'ForumController@bestreply')->middleware('auth');
	// Report Reply 
	Route::get('forum/report/{id}', 'ForumController@reportreply')->middleware('auth');
	Route::post('forum/report/{id}', 'ForumController@report')->middleware('auth');
	// Delete Reply 
	Route::get('forum/reply/deletereply/{id}', 'ForumController@deletereply')->middleware('auth');
	// view ask Question page 
	Route::get('forum/ask', 'ForumController@ask')->middleware('auth');
	// add ask Question 
	Route::post('forum/askquestion', 'ForumController@askquestion')->middleware('auth');
	// edit Question Page 
	Route::get('forum/question/{id}', 'ForumController@edit')->middleware('auth');
	// edit question 
	Route::post('forum/question/{id}', 'ForumController@update')->middleware('auth');
	// edit question 
	Route::get('user/profile/{id}', 'ForumController@userprofile');

	// view Blog Post 
	Route::get('blog', 'BlogController@blog');
	Route::get('blog/post/{id}', 'BlogController@index');
	Route::post('blog/post/comment/{id}', 'BlogController@addcomment');
	



	/*---------------   Auth   ------------------*/

	Route::get('checkemailphone', 'Auth\RegisterController@checkemailphone'); 

	Auth::routes();
	// Show message After Registration
	Route::get('/email-confirm', function () {
		if (URL::previous() === "http://localhost:8000/register" || URL::previous() === "http://localhost:8000/email-confirm" || URL::previous() === "http://localhost:8000/bn/email-confirm" || URL::previous() === "http://localhost:8000/bn/register") { 
			return view('emails.confirmmessage');	
		}
	});
	// Email Varification with token
	Route::get('register/verify/{token}', 'Auth\RegisterController@verify'); 
	// Logout
	Route::get('logout', 'Auth\LoginController@logout'); 
	/* Socail login */
	Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
	Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
	// Password Reset
	Route::get('/password/resets/{token}', 'Auth\ResetPasswordController@showResetForm');
	Route::post('/reset/password', 'Auth\ResetPasswordController@resetpass');




	/*--------- Search *------------------*/
	Route::get('search', 'SearchController@search');

	/*--------- View Notification *------------------*/
	Route::get('/notification/view/{id}', 'NotificationController@viewnotification');
	Route::get('/notifications', 'NotificationController@viewallnotification');


	/*--------- Contact *------------------*/
	Route::get('/contact-us', 'ContactController@index');
	Route::post('contact-us', 'ContactController@create');
	
});


/*--------- EXAM WITHOUT LANGUAGE *------------------*/
// Get Exam Data
Route::GET('/*/exams/start', 'ExamController@startexam');
// Keep Question Answer 
Route::POST('/*/results/exams', 'ExamController@answer');






//////////////// Admin Auth    ///////////
$this->get('admin/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
$this->post('admin/login', 'AdminAuth\LoginController@login');
Route::GET('admin/logout', 'AdminAuth\LoginController@logout');

        // Registration Routes...
$this->get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin.register');
$this->post('admin/register', 'AdminAuth\RegisterController@register');

        // Password Reset Routes...
$this->get('admin/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
$this->post('admin/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
$this->get('admin/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
$this->post('admin/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.request');






































// Route::get('/home', 'HomeController@index')->name('home');


/*------------------ Admin -------------------------------*/

// Route::get('/admin/login',function(){

// });

/* Dashboard */
// Route::get('/admin', function(){
// 	return view('Admin/dashboard');
// })->middleware('auth:admin');
/* Other Route */
Route::get('/admin/{path}', function () {
    return view('admin.dashboard');
})->where( 'path', '([A-z0-9\d-\/_.,]+)?' )->middleware('auth:admin');






/* ----------------------- User/Admin ----------------------------------------- */

/* Get all Users */
Route::get('/*/admin/getusers','AdminUserController@getallusers');
/* Delete a User */
Route::post('/*/admin/users/deleteuser','AdminUserController@deleteuser');




/* Get all Admins */
Route::get('/*/admin/getadmins','AdminUserController@getalladmins');
/* Add a Admin */
Route::post('/*/admin/admin/addadmin','AdminUserController@addadmin');
/* Delete a Admin */
Route::post('/*/admin/admin/deleteadmin','AdminUserController@deleteadmin');
/* View/Get Role */
Route::get('/*/admin/role/getrole','AdminUserController@getrole');
/* Add Role */
Route::post('/*/admin/role/addrole','AdminUserController@addrole');
/* Edit Role */
Route::post('/*/admin/role/editrole','AdminUserController@editrole');
/* Delete Role */
Route::post('/*/admin/role/deleterole','AdminUserController@deleterole');
/* Search Role */
Route::post('/*/admin/role/getsearchrole','AdminUserController@getsearchrole');

/* Get Single Admin */
Route::get('/*/admin/getadmin','AdminUserController@getadmin');
/* Change Admin Name */
Route::post('/*/admin/changename','AdminUserController@changename');
/* Change Admin Password */
Route::post('/*/admin/changepassword','AdminUserController@changepassword');
/* Change Admin Image */
Route::post('/*/admin/changeimage','AdminUserController@changeimage');


/*---------- Message/Comtact ---------------*/
Route::get('/*/admin/contact-us/getmessage','AdminContactController@index');
Route::post('/*/admin/contact-us/deletemessage','AdminContactController@destroy');
Route::post('/*/admin/contact-us/seenmessage','AdminContactController@seen');



/*---------- Chat ---------------*/
/* Get all Admin */
Route::get('/*/getalladmin','AdminChatController@getalladmin');
/* Send Message */
Route::post('/*/send','AdminChatController@send');
/* Get Old Message */
Route::get('/*/getOldMessage/{id}','AdminChatController@getOldMessage');
/* Admin Online */
Route::post('/*/admin/online','AdminChatController@adminOnline');
/* Admin Offline */
Route::post('/*/admin/offline','AdminChatController@adminOffline');

/*---------- Mail ---------------*/

/* Compose Mail */
Route::post('/*/admin/mail/compose','MailController@composeMail');

/* Mail inbox */
Route::get('/*/admin/mail/inbox','MailController@getInbox');
/* Delete Multi Mail inbox Message */
Route::get('/*/admin/mail/inbox/multitrash/{category}/{subject}','MailController@deleteMultiInboxMessage');
/* Read Mail inbox Message */
Route::get('/*/admin/mail/inbox/view/{subject}','MailController@getInboxMessage');
/* Delete Mail inbox Message */
Route::get('/*/admin/mail/inbox/trash/{subject}','MailController@deleteInboxMessage');

/* Mail Sent */
Route::get('/*/admin/mail/sent','MailController@getSent');
/* Read Mail Sent Message */
Route::get('/*/admin/mail/sent/view/{subject}','MailController@getSentMessage');
/* Delete Sent Mail inbox Message */
Route::get('/*/admin/mail/sent/trash/{subject}','MailController@deleteSentMessage');


/* Mail Draft */
Route::get('/*/admin/mail/draft','MailController@getDraft');
/* Read Mail Draft Message */
Route::get('/*/admin/mail/draft/view/{subject}','MailController@getDraftMessage');
/* Delete Draft Mail inbox Message */
Route::get('/*/admin/mail/draft/trash/{subject}','MailController@deleteDraftsMessage');



/* Mail Trash */
Route::get('/*/admin/mail/trash','MailController@getTrash');
/* Read Mail Trash Message */
Route::get('/*/admin/mail/trash/view/{subject}','MailController@getTrashMessage');
/* Delete Trash Mail inbox Message */
Route::get('/*/admin/mail/trash/trash/{subject}','MailController@deleteTrashMessage');





/*---------- Question ---------------*/
/* Get Data */
Route::get('/*/admin/questiondata/{id}','AdminNormalQuestionController@index');
/* Get School Class */
Route::get('/*/admin/question/getSchoolClass','AdminNormalQuestionController@getschoolclass');
/* Get Class Subjects */
Route::post('/*/admin/question/getAllsubject','AdminNormalQuestionController@getAllSubject');
/* Get Subject Sections */
Route::post('/*/admin/question/getsection','AdminNormalQuestionController@getsection');

/* Get Subject Creative Questions */
Route::get('/*/admin/question/getquestion','AdminNormalQuestionController@getquestion');
/* Add Subject Creative Questions */
Route::post('/*/admin/question/addquestion','AdminNormalQuestionController@addquestion');
/* Edit Subject Creative Questions */
Route::post('/*/admin/question/editquestion','AdminNormalQuestionController@editquestion');
/* Delete Subject Creative Questions */
Route::post('/*/admin/question/deletequestion','AdminNormalQuestionController@deletequestion');
/* Filter Subject Creative Questions */
Route::post('/*/admin/question/getfilterquestion','AdminNormalQuestionController@getfilterquestion');
/* Search Subject Creative Questions */
Route::post('/*/admin/question/getsearchquestion','AdminNormalQuestionController@getsearchquestion');


/* Get Subject MCQ Questions */
Route::get('/*/admin/question/mcq/getquestion','AdminNormalQuestionController@mcqgetquestion');
/* Add Subject MCQ Questions */
Route::post('/*/admin/question/mcq/addquestion','AdminNormalQuestionController@mcqaddquestion');
/* Edit Subject MCQ Questions */
Route::post('/*/admin/question/mcq/editquestion','AdminNormalQuestionController@mcqeditquestion');
/* Delete Subject MCQ Questions */
Route::post('/*/admin/question/mcq/deletequestion','AdminNormalQuestionController@mcqdeletequestion');
/* Filter Subject MCQ Questions */
Route::post('/*/admin/question/mcq/getfilterquestion','AdminNormalQuestionController@mcqgetfilterquestion');
/* Search Subject MCQ Questions */
Route::post('/*/admin/question/mcq/getsearchquestion','AdminNormalQuestionController@mcqgetsearchquestion');



/*---------- Board Question ---------------*/

/* Get Data */
Route::get('/*/admin/questiondataboard','AdminBoardQuestionController@index');
/* Get all Board */
Route::get('/*/admin/board/getAllboard','AdminBoardQuestionController@getallboard');
/* Get all exam Subject */
Route::post('/*/admin/board/getAllsubject','AdminBoardQuestionController@getAllSubject');
/* Get all question */
Route::get('/*/admin/board/getquestion','AdminBoardQuestionController@getquestion');
/* add question */
Route::post('/*/admin/board/addquestion','AdminBoardQuestionController@addquestion');
/* edit question */
Route::post('/*/admin/board/editquestion','AdminBoardQuestionController@editquestion');
/* delete question */
Route::post('/*/admin/board/deletequestion','AdminBoardQuestionController@deletequestion');
/* Filter Board Questions */
Route::post('/*/admin/board/getfilterquestion','AdminBoardQuestionController@getfilterquestion');
/* Search Board Questions */
Route::post('/*/admin/board/getsearchquestion','AdminBoardQuestionController@getsearchquestion');
/* Get tag */
Route::post('/*/admin/board/gettags','AdminBoardQuestionController@gettags');


/*---------- University Question ---------------*/

/* Get all university */
Route::get('/*/admin/university/getAlluniversity','AdminUniversityQuestionController@getAlluniversity');
/* Get all exam Subject */
Route::post('/*/admin/university/getAllsubject','AdminUniversityQuestionController@getAllSubject');
/* Get all question */
Route::get('/*/admin/university/getquestion','AdminUniversityQuestionController@getquestion');
/* add question */
Route::post('/*/admin/university/addquestion','AdminUniversityQuestionController@addquestion');
/* edit question */
Route::post('/*/admin/university/editquestion','AdminUniversityQuestionController@editquestion');
/* delete question */
Route::post('/*/admin/university/deletequestion','AdminUniversityQuestionController@deletequestion');
/* Filter Board Questions */
Route::post('/*/admin/university/getfilterquestion','AdminUniversityQuestionController@getfilterquestion');
/* Search Board Questions */
Route::post('/*/admin/university/getsearchquestion','AdminUniversityQuestionController@getsearchquestion');







/*----------  Question Solution ---------------*/
/* Get Data */
Route::get('/*/admin/questionsolve/index','AdminQuestionSolutionController@index');
/* Get all question */
Route::get('/*/admin/questionsolve/getquestion','AdminQuestionSolutionController@getquestion');
/* add question */
Route::post('/*/admin/questionsolve/addquestion','AdminQuestionSolutionController@addquestion');
/* edit question */
Route::post('/*/admin/questionsolve/editquestion','AdminQuestionSolutionController@editquestion');
/* delete question */
Route::post('/*/admin/questionsolve/deletequestion','AdminQuestionSolutionController@deletequestion');
/* Filter  Questions */
Route::post('/*/admin/questionsolve/getfilterquestion','AdminQuestionSolutionController@getfilterquestion');
/* Search  Questions */
Route::post('/*/admin/questionsolve/getsearchquestion','AdminQuestionSolutionController@getsearchquestion');
/* get tags */
Route::post('/*/admin/questionsolve/gettags','AdminQuestionSolutionController@gettags');









/*---------- Other Question ---------------*/
/* Get Data */
Route::get('/*/admin/questiondatamcq/{id}','AdminOtherQuestionController@index');

/* Get BCS Subjects */
Route::post('/*/admin/question/bcs/getAllsubject','AdminOtherQuestionController@getAllSubject');
/* Get BCS Question */
Route::get('/*/admin/question/bcs/getquestion','AdminOtherQuestionController@getquestion');
/* add BCS question */
Route::post('/*/admin/question/bcs/addquestion','AdminOtherQuestionController@addquestion');
/* edit BCS question */
Route::post('/*/admin/question/bcs/editquestion','AdminOtherQuestionController@editquestion');
/* delete BCS question */
Route::post('/*/admin/question/bcs/deletequestion','AdminOtherQuestionController@deletequestion');
/* Filter Board Questions */
Route::post('/*/admin/question/bcs/getfilterquestion','AdminOtherQuestionController@getfilterquestion');
/* Search Board Questions */
Route::post('/*/admin/question/bcs/getsearchquestion','AdminOtherQuestionController@getsearchquestion');


/*---------- Normal Exam Question ---------------*/

/* Get all exam Subject */
Route::post('/*/admin/exam/normal/getAllsubject','AdminNormalExamController@getAllSubject');
/* Get all Subject Sections */
Route::post('/*/admin/exam/normal/getsection','AdminNormalExamController@getsection');
/* Get Question */
Route::post('/*/admin/exam/normal/getquestion','AdminNormalExamController@getquestion');
/* Add Question */
Route::post('/*/admin/exam/normal/addquestion','AdminNormalExamController@addquestion');
/* Edit Question */
Route::post('/*/admin/exam/normal/editquestion','AdminNormalExamController@editquestion');
/* Delete Question */
Route::post('/*/admin/exam/normal/deletequestion','AdminNormalExamController@deletequestion');
/* Filter Question */
Route::post('/*/admin/exam/normal/filterquestion','AdminNormalExamController@getfilterquestion');
/* Search Question */
Route::post('/*/admin/exam/normal/searchquestion','AdminNormalExamController@getsearchquestion');




/*---------- Board Exam Question ---------------*/

/* Get all exam Subject */
Route::post('/*/admin/exam/board/getAllsubject','AdminBoardExamController@getAllSubject');
/* Get all Subject Sections */
Route::post('/*/admin/exam/board/getsection','AdminBoardExamController@getsection');
/* Get Question */
Route::post('/*/admin/exam/board/getquestion','AdminBoardExamController@getquestion');
/* Add Question */
Route::post('/*/admin/exam/board/addquestion','AdminBoardExamController@addquestion');
/* Edit Question */
Route::post('/*/admin/exam/board/editquestion','AdminBoardExamController@editquestion');
/* Delete Question */
Route::post('/*/admin/exam/board/deletequestion','AdminBoardExamController@deletequestion');
/* Filter Question */
Route::post('/*/admin/exam/board/filterquestion','AdminBoardExamController@getfilterquestion');
/* Search Question */
Route::post('/*/admin/exam/board/searchquestion','AdminBoardExamController@getsearchquestion');

/*---------- Other EXAM ---------------*/
/* Get BCS Subjects */
Route::post('/*/admin/exam/bcs/getAllsubject','AdminOtherExamController@getAllSubject');
/* Get BCS Question */
Route::post('/*/admin/exam/bcs/getquestion','AdminOtherExamController@getquestion');
/* add BCS question */
Route::post('/*/admin/exam/bcs/addquestion','AdminOtherExamController@addquestion');
/* edit BCS question */
Route::post('/*/admin/exam/bcs/editquestion','AdminOtherExamController@editquestion');
/* delete BCS question */
Route::post('/*/admin/exam/bcs/deletequestion','AdminOtherExamController@deletequestion');
/* Filter Board Questions */
Route::post('/*/admin/exam/bcs/getfilterquestion','AdminOtherExamController@getfilterquestion');
/* Search Board Questions */
Route::post('/*/admin/exam/bcs/getsearchquestion','AdminOtherExamController@getsearchquestion');








/*---------- Forum ---------------*/
/* Index */
Route::get('/*/admin/forum','AdminForumController@index');
/* View/Get Question */
Route::get('/*/admin/forum/getquestion','AdminForumController@getquestion');
/* View/Get Reply */
Route::get('/*/admin/forum/getreply','AdminForumController@getreply');
/* View/Get Category */
Route::get('/*/admin/forum/getcategory','AdminForumController@getcategory');
/* Delete Question */
Route::post('/*/admin/forum/deletequestion','AdminForumController@deletequestion');
/* Delete Reply */
Route::post('/*/admin/forum/deletereply','AdminForumController@deletereply');
/* Delete Category */
Route::post('/*/admin/forum/deletecategory','AdminForumController@deletecategory');
/* Add Category */
Route::post('/*/admin/forum/addcategory','AdminForumController@addcategory');
/* Edit Category */
Route::post('/*/admin/forum/editcategory','AdminForumController@editcategory');
/* Filter Questions */
Route::post('/*/admin/forum/getfilterquestion','AdminForumController@getfilterquestion');
/* Search Questions */
Route::post('/*/admin/forum/getsearchquestion','AdminForumController@getsearchquestion');
/* Filter Reply */
Route::post('/*/admin/forum/getfilterreply','AdminForumController@getfilterreply');
/* Search Reply */
Route::post('/*/admin/forum/getsearchreply','AdminForumController@getsearchreply');
/* Filter Category */
Route::post('/*/admin/forum/getfiltercategory','AdminForumController@getfiltercategory');
/* Search Category */
Route::post('/*/admin/forum/getsearchcategory','AdminForumController@getsearchcategory');



/*---------- Blog ---------------*/
/* Index */
Route::get('/*/admin/blog','AdminBlogController@index');
/* View/Get Post */
Route::get('/*/admin/blog/getpost','AdminBlogController@getpost');
/* View/Get Comment */
Route::get('/*/admin/blog/getcomment','AdminBlogController@getcomment');
// Delete Post
Route::post('/*/admin/blog/deletepost','AdminBlogController@deletepost');
/* Delete Comment */
Route::post('/*/admin/blog/deletecomment','AdminBlogController@deletecomment');
/* Add Post */
Route::post('/*/admin/blog/addpost','AdminBlogController@addpost');
/* Edit Post */
Route::post('/*/admin/blog/editpost','AdminBlogController@editpost');
/* Search Post */
Route::post('/*/admin/blog/getsearchpost','AdminBlogController@getsearchpost');
/* Search Comment */
Route::post('/*/admin/blog/getsearchcomment','AdminBlogController@getsearchcomment');
/* Search Comment */
Route::post('/*/admin/blog/gettags','AdminBlogController@gettags');

/*---------- Custom ---------------*/
Route::get('/*/admin/custom/getsubject','AdminCustomController@getsubject');
Route::post('/*/admin/custom/addsubject','AdminCustomController@addsubject');
Route::post('/*/admin/custom/editsubject','AdminCustomController@editsubject');
Route::post('/*/admin/custom/deletesubject','AdminCustomController@deletesubject');
Route::post('/*/admin/custom/getsearchsubject','AdminCustomController@getsearchsubject');
Route::post('/*/admin/custom/getallclass','AdminCustomController@getallclass');
Route::get('/*/admin/custom/getalluniversity','AdminCustomController@getalluniversity');
Route::get('/*/admin/custom/university/getallsubject','AdminCustomController@getuniversitysubject');
Route::post('/*/admin/custom/addsubjecttoclass','AdminCustomController@addsubjecttoclass');
Route::post('/*/admin/custom/deleteclasssubject','AdminCustomController@deleteclasssubject');
Route::get('/*/admin/custom/getcustomsearchsubject','AdminCustomController@getcustomsearchsubject');
Route::get('/*/admin/custom/getalljobcategory','AdminCustomController@getalljobcategory');
Route::get('/*/admin/custom/jobcategory/getallsubject','AdminCustomController@getalljobcategorysubject');
Route::get('/*/admin/custom/getsection','AdminCustomController@getsection');
Route::post('/*/admin/custom/addsectiontosubject','AdminCustomController@addsectiontosubject');
Route::post('/*/admin/custom/editsection','AdminCustomController@editsection');
Route::post('/*/admin/custom/deletesubjectsection','AdminCustomController@deletesubjectsection');
Route::get('/*/admin/custom/getsearchsection','AdminCustomController@getsearchsection');


/*---------- Admin Chart ---------------*/
/* Pie Chart */
Route::get('/*/admin/chart/piedata','AdminChartController@piechart');
/* Visitor Chart */
Route::get('/*/admin/chart/visitor','AdminChartController@visitorchart');
/* User Chart */
Route::get('/*/admin/chart/user','AdminChartController@userchart');
/* Admin Chart */
Route::get('/*/admin/chart/admin','AdminChartController@adminchart');



/*---------- Site Option ---------------*/
/* Site Title */
Route::get('/*/admin/site/getdata','AdminSiteOptionController@getdata');
/* Site Title */
Route::post('/*/admin/site/title','AdminSiteOptionController@sitetitle');
/* Site Theme */
Route::post('/*/admin/site/theme','AdminSiteOptionController@sitetheme');
/* Site Social */
Route::post('/*/admin/site/social','AdminSiteOptionController@sitesocial');
/* Site Footer */
Route::post('/*/admin/site/footer','AdminSiteOptionController@sitefooter');

/*----- Backup -----*/
Route::get('/*/admin/backup/getbackup','AdminBackupController@getbackup');
Route::post('/*/admin/backup/deletebackup','AdminBackupController@deletebackup');
Route::post('/*/admin/backup/getsearchbackup','AdminBackupController@searchbackup');
Route::get('/*/admin/backup/download/{id}','AdminBackupController@download');
Route::get('/*/admin/backup/data/{value}','AdminBackupController@backupdata');



/*---------- Event ---------------*/
/* Show Event */
Route::post('/*/admin/events','AdminEventController@index');
/* Add Event */
Route::post('/*/admin/events/add','AdminEventController@addevent');
/* Edit Event */
Route::post('/*/admin/events/edit','AdminEventController@editevent');
/* Delete Event */
Route::post('/*/admin/events/delete','AdminEventController@deleteevent');



