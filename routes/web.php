<?php

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


Route::get('/', function () {
    if (Session::has('adminSession')) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('adminlogin');
    }

    return view('welcome');
});


// Login
Route::match(['get', 'post'], '/ims-login', 'AdminLoginController@login')->name('adminlogin');


Route::group(['middleware' => ['adminlogin']], function () {

// Dashboard
    Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    // Profile
    Route::get('/admin/profile', 'AdminController@profile')->name('admin.profile');

    // Profile Update
    Route::post('/admin/profile/update/{id}', 'AdminController@updateProfile')->name('updateProfile');

    // Change Password
    Route::get('/admin/profile/change_password', 'AdminController@changePassword')->name('changePassword');

    // Checking User Password
    Route::post('/admin/profile/check-password', 'AdminController@chkUserPassword');

    // Update Password
    Route::post('/admin/profile/update_password/{id}', 'AdminController@updatePassword')->name('updatePassword');


    // User Management Routes
    Route::match(['get', 'post'], '/add/user', 'UsersController@addUser')->name('addUser');
    Route::get('/users/view_u/all', 'UsersController@viewAllUsers')->name('viewAllUsers');
    Route::match(['get', 'post'], '/edit/user/{id}', 'UsersController@editUser')->name('editUser');

    Route::get('/users/restore/{id}', 'UsersController@restoreUser')->name('restoreUser');
    Route::get('trash-user/{id}', 'UsersController@trashUser')->name('trashUser');
    Route::get('/users/view_trashed', 'UsersController@viewTrashedUser')->name('viewTrashedUser');

    Route::get('delete-user/{id}', 'UsersController@deleteUser')->name('deleteUser');

    Route::post('/check-user-email', 'UsersController@checkUserEmail')->name('checkUserEmail');
    Route::get('/users/print-user', 'UsersController@printUser')->name('printUser');
    Route::get('/users/generate-pdf', 'UsersController@generatePDF')->name('generate_usersPDF');


    //Teacher Management Routes
    Route::prefix('teachermanagement')->group(function ()
    {
        Route::match(['get', 'post'], '/teacher/add', 'TeachersController@addTeacher')->name('addTeacher');
        Route::get('/view_teacher', 'TeachersController@viewAllTeachers')->name('viewAllTeachers');

        Route::match(['get', 'post'], '/edit/teacher/{id}', 'TeachersController@editTeacher')->name('editTeachers');

        Route::get('trash-teacher/{id}', 'TeachersController@trashTeacher')->name('trashTeacher');
        Route::get('/teachers/view_trashed', 'TeachersController@viewTrashedTeacher')->name('viewTrashedTeacher');
        Route::get('/teachers/restore/{id}', 'TeachersController@restoreTeacher')->name('restoreTeacher');
        Route::get('delete-teacher/{id}', 'TeachersController@deleteTeacher')->name('deleteTeacher');


        Route::get('teacher-profile/', 'TeachersController@profile')->name('profile');
        Route::get('teacher-profile/{id}', 'TeachersController@profile')->name('profile');
        Route::get('myprofile/', 'TeachersController@myprofile')->name('myprofile');
        Route::get('/teacher/print-teacher', 'TeachersController@printTeacher')->name('printTeacher');
    });



    //generatepdf routes

    Route::get('/teachers/generate-pdf', 'TeachersController@generatePDF')->name('generate_teachersPDF');

    Route::get('teacher-profile/{id}', 'TeachersController@profile')->name('teacherprofile');


    // Courses Routes
    Route::match(['get', 'post'], '/course/add', 'CoursesController@addCourse')->name('addCourse');
    Route::get('/course/view', 'CoursesController@viewCourses')->name('viewCourses');
    Route::match(['get', 'post'], '/course/edit/{id}', 'CoursesController@editCourse')->name('editCourse');
    Route::get('delete-course/{id}', 'CoursesController@deleteCourse');

    Route::get('/course/export-course', 'CoursesController@exportCourse')->name('exportCourse');

    Route::get('/course/generate-pdf', 'CoursesController@generatePDF')->name('generatePDF');
    Route::get('/course/print-course', 'CoursesController@printCourse')->name('printCourse');
    Route::get('/course/generate-pdf', 'CoursesController@generatePDF')->name('generatePDF');


    Route::get('/course/generate-pdf', 'CoursesController@generatePDF')->name('generatePDF');
    Route::get('/course/print-course', 'CoursesController@printCourse')->name('printCourse');

    Route::get('/course/generate-pdf', 'CoursesController@generatePDF')->name('generatePDF');


    //Sections
    Route::match(['get', 'post'], '/section/add', 'SectionController@addSection')->name('addSection');
    Route::get('/section/view', 'SectionController@viewSections')->name('viewSections');
    Route::get('/section/student/view/{id}', 'SectionController@studentView')->name('studentView');
    Route::match(['get', 'post'], '/section/edit/{id}', 'SectionController@editSection')->name('editSection');
    Route::get('delete-section/{id}', 'SectionController@deleteSection');

    Route::get('/section/export-section', 'SectionController@exportSection')->name('exportSection');
    Route::get('/section/print-section', 'SectionController@printSection')->name('printSection');


    // Batch Routes
    Route::match(['get', 'post'], '/batch/add', 'BatchController@addBatch')->name('addBatch');
    Route::get('/batch/view_b/all', 'BatchController@viewBatches')->name('viewBatches');
    Route::get('delete-batch/{id}', 'BatchController@deleteBatch');
    Route::match(['get', 'post'], '/batch/edit/{id}', 'BatchController@editBatch')->name('editBatch');
    Route::get('/batch/print-batch', 'BatchController@printBatch')->name('printBatch');


    // Site Settings
    Route::get('/site/settings', 'SiteSettingController@siteSettings')->name('siteSettings');
    Route::post('/site/settings/update/{id}', 'SiteSettingController@updateSiteSettings')->name('updateSiteSettings');


    //Enquiry Category Management Routes
    Route::prefix('enquiries')->group(function () {
        Route::resource('/category', 'EnquiryCategoryController');
        Route::get('/delete-category/{id}', 'EnquiryCategoryController@deleteCategory');
        Route::resource('/enquiry', 'EnquiryController');
        Route::get('/delete-enquiry/{id}', 'EnquiryController@destroy');
        Route::resource('/source', 'EnquirySourceController');
        Route::get('/delete-source/{id}', 'EnquirySourceController@destroy');
        Route::post('/enquiry/applicant/{id}', 'EnquiryController@addtoclient')->name('clientadd');
    });


    //Student
    Route::prefix('studentmanagement')->group(function () {
        Route::get('student_v/view', 'StudentController@viewAllStudent')->name('viewStudent');
        Route::match(['get', 'post'], '/student/add', 'StudentController@addStudent')->name('addStudent');
        Route::match(['get', 'post'], '/student/edit/{id}', 'StudentController@editStudent')->name('editStudent');

        Route::get('trash-student/{id}', 'StudentController@trashStudent')->name('trashStudent');
        Route::get('student-profile/{id}', 'StudentController@profile')->name('studentprofile');
        Route::get('myprofile/stu', 'StudentController@myprofile')->name('mystudentprofile');
        Route::get('/students/view_trashed', 'StudentController@viewTrashedStudent')->name('viewTrashedStudent');
        Route::get('restore-student/{id}', 'StudentController@restoreStudent')->name('restoreStudent');

        Route::get('delete-student/{id}', 'StudentController@deleteStudent')->name('deleteStudent');
        Route::get('/student/generate-pdf', 'StudentController@generatePDF')->name('generate_studentPDF');
        Route::get('/student/print-student', 'StudentController@printStudent')->name('printStudent');

        //Student Category
        Route::get('/view_category', 'StudentCategoryController@viewStudentCategory')->name('viewStudentCategory');
        Route::match(['get', 'post'], '/add', 'StudentCategoryController@addCategory')->name('addCategory');
        Route::match(['get', 'post'], '/edit/{id}', 'StudentCategoryController@editStudentCategory')->name('editStudentCategory');
        Route::get('delete-studentcategory/{id}', 'StudentCategoryController@deleteStudentCategory')->name('deleteStudentCategory');
    });


    //Accounts Routes
    Route::resource('invoice', 'InvoiceController');
    Route::get('/delete-invoice/{id}', 'InvoiceController@destroy');
    Route::get('/show-invoice/{id}', 'InvoiceController@showinvoice')->name('showinvoice');
    Route::get('/print-invoice', 'InvoiceController@printInvoice')->name('printInvoice');


    //Accounts Routes
    Route::resource('invoice', 'InvoiceController');
    Route::get('/delete-invoice/{id}', 'InvoiceController@destroy');
    Route::get('/invoice/generate-pdf', 'InvoiceController@generatePDF')->name('generate_invoicePDF');


    //Expense Category
    Route::prefix('account')->group(function ()
    {
        Route::prefix('expensemanagement')->group(function (){
            Route::match(['get', 'post'], '/expense-category/add', 'ExpenseCategoryController@addExpenseCategory')->name('addExpenseCategory');
            Route::get('/expense-category-view', 'ExpenseCategoryController@viewExpenseCategory')->name('viewExpenseCategory');
            Route::match(['get', 'post'], '/expense-category/edit/{id}', 'ExpenseCategoryController@editExpenseCategory')->name('editExpenseCategory');
            Route::get('delete-expense-category/{id}', 'ExpenseCategoryController@deleteExpenseCategory');
            Route::get('/expense-category/generate-pdf', 'ExpenseCategoryController@generatePDF')->name('generate_expensecategoryPDF');
            Route::get('/expense-view', 'ExpenseController@viewExpense')->name('viewExpense');
        });
        Route::match(['get', 'post'], '/fee-view', 'FeesController@viewFees')->name('viewFees');
    });



    //Expense
    Route::match(['get', 'post'], '/expense/add', 'ExpenseController@addExpense')->name('addExpense');
    Route::match(['get', 'post'], '/expense/edit/{id}', 'ExpenseController@editExpense')->name('editExpense');
    Route::get('delete-expense/{id}', 'ExpenseController@deleteExpense');

    Route::get('/expense/generate-pdf', 'ExpenseController@generatePDF')->name('generate_expensePDF');

    //Send SMS
    Route::prefix('sms')->group(function ()
    {
        Route::match(['get', 'post'], '/smstemplate/add', 'SmsTemplateController@addSmsTemplate')->name('addSmsTemplate');
        Route::get('/smstemplate/view', 'SmsTemplateController@viewSmsTemplate')->name('viewSmsTemplate');
        Route::match(['get', 'post'], '/smstemplate/edit/{id}', 'SmsTemplateController@editSmsTemplate')->name('editSmsTemplate');
        Route::get('delete-smstemplate/{id}', 'SmsTemplateController@deleteSmsTemplate');

        Route::get('/student-sms-view', 'SmsTemplateController@s_smsview')->name('s_smsview');
        Route::get('/staff-sms-view', 'SmsTemplateController@st_smsview')->name('st_smsview');
        Route::get('/teacher-sms-view', 'SmsTemplateController@t_smsview')->name('t_smsview');
        Route::get('/enquiry-sms-view', 'SmsTemplateController@e_smsview')->name('e_smsview');
        Route::post('/sms/send', 'SmsTemplateController@sendsms')->name('sendsms');
    });


    //Email
    Route::match(['get', 'post'], '/emailtemplate/add', 'EmailController@addEmailTemplate')->name('addEmailTemplate');
    Route::match(['get', 'post'], '/emailtemplate/edit/{id}', 'EmailController@editEmailTemplate')->name('editEmailTemplate');
    Route::get('delete-emailtemplate/{id}', 'EmailController@deleteEmailTemplate');


    //Send EMAIL
    Route::prefix('email')->group(function ()
    {
        Route::get('/emailtemplate/view', 'EmailController@viewEmailTemplate')->name('viewEmailTemplate');
        Route::get('/email-student-view', 'EmailController@s_emailview')->name('s_emailview');
        Route::get('/email-staff-view', 'EmailController@st_emailview')->name('st_emailview');
        Route::get('/email-teacher-view', 'EmailController@t_emailview')->name('t_emailview');
        Route::get('/email-enquiry-view', 'EmailController@e_emailview')->name('e_emailview');
        Route::post('/email/send', 'EmailController@sendemail')->name('sendemail');
    });


    //Fees routes

    Route::match(['get', 'post'], '/fees/add', 'FeesController@addFees')->name('addFees');

    Route::match(['get', 'post'], '/fee/edit/{id}', 'FeesController@editFees')->name('editFees');
    Route::match(['get', 'post'], '/fee/pay', 'FeesController@makepayment')->name('makepayment');


    Route::get('viewpaymentreport/{id}', 'FeesController@viewpaymentreport')->name('viewpaymentreport');


    Route::get('invoice/', 'FeesController@viewinvoice')->name('viewinvoice');

    Route::get('fee/details/{std_id}', 'FeesController@viewfeedetails')->name('viewfeedetails');

    Route::get('delete-payment/{id}', 'FeesController@deletepayment')->name('deletepayment');

    Route::match(['get', 'post'], '/payment/edit/{id}', 'FeesController@editpayment')->name('editpayment');

    Route::get('delete-fee/{id}', 'FeesController@deletefee')->name('deletefee');


    //generatepdf routes

    Route::get('/fee/generate-pdf', 'FeesController@generatePDF')->name('generate_feePDF');
    Route::get('/fee/print-fees', 'FeesController@printFees')->name('printFees');


//Exam Routes

    Route::prefix('exams')->group(function () {
        Route::get('/exam/view', 'ExamController@viewAllExams')->name('viewAllExams');
        Route::match(['get', 'post'], '/exam/add', 'ExamController@addExams')->name('addExams');
        Route::match(['get', 'post'], 'edit-exam/{id}', 'ExamController@editexam')->name('editexam');
        Route::get('delete-exam/{id}', 'ExamController@deleteExam')->name('deleteExam');
    });

//View Students In Exam

    Route::match(['get', 'post'], '/exam/student/view', 'ExamController@viewCourseStudent')->name('viewCourseStudent');
    Route::match(['get', 'post'], '/result/change', 'ResultController@changeresult')->name('changeresult');
    Route::match(['get', 'post'], '/exam/exam_report', 'ResultController@viewResult')->name('viewResult');
    Route::match(['get', 'post'], '/exam_report/edit', 'ResultController@editresult')->name('editresult');


    // Attendance
    Route::prefix('attendances')->group(function ()
    {
        Route::post('/student/attendance/store', 'AttendanceController@storeAttendanceStudent')->name('storeAttendanceStudent');
        Route::match(['get', 'post'], '/attendance_stu', 'AttendanceController@courseStudent')->name('courseStudent');
        Route::match(['get', 'post'], '/attendance_student', 'AttendanceController@studentAttendance')->name('studentAttendance');
        Route::match(['get', 'post'], '/attendance_staff', 'AttendanceController@staffAttendance')->name('staffAttendance');
        Route::match(['get', 'post'], '/attendance_report', 'AttendanceController@viewReport')->name('viewReport');
        Route::match(['get', 'post'], '/attendance_teacher', 'AttendanceController@teacherAttendance')->name('teacherAttendance');
    });


    // Logout

    Route::get('/ims/logout', 'AdminLoginController@imsLogout')->name('imsLogout');


    // Fees Check
    Route::post('/fees/get-student-course', 'FeesController@getStudentCourse');


});


