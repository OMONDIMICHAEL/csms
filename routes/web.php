<?php
use Illuminate\Contracts\Http\Kernel;
app(Kernel::class); // Debugging Kernel recognition
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\CookController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ExamSubmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LearningResourceController;
use App\Http\Controllers\DigitalLibraryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\FoodStockController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FeeController;
use App\Exports\CheckInExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', '\App\Http\Middleware\AdminMiddleware::class'])->group(function () {
    Route::get('/admin/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
  // admin
    Route::get('/admin/admin_dashboard', [AdminController::class, 'index'])->name('admin.admin_dashboard');
    Route::get('/admin/communications', [AdminController::class, 'showCommunications'])->name('admin.communication.list');
    Route::post('/admin/communications', [AdminController::class, 'storeCommunication'])->name('admin.communication.store');
    Route::delete('/admin/communications/{id}', [AdminController::class, 'deleteCommunication'])->name('admin.communication.delete');
    Route::get('/budgets', [BudgetController::class, 'index'])->name('budgets.index');
    Route::get('/budgets/create', [BudgetController::class, 'create'])->name('budgets.create');
    Route::post('/budgets', [BudgetController::class, 'store'])->name('budgets.store');

    Route::get('/procurements', [ProcurementController::class, 'index'])->name('procurements.index');
    Route::get('/procurements/create', [ProcurementController::class, 'create'])->name('procurements.create');
    Route::post('/procurements', [ProcurementController::class, 'store'])->name('procurements.store');
    Route::post('/procurements/{id}/approve', [ProcurementController::class, 'approve'])->name('procurements.approve');
    Route::post('/procurements/{id}/reject', [ProcurementController::class, 'reject'])->name('procurements.reject');

    // teacher
    Route::get('/teacher/teacher_dashboard', [TeacherController::class, 'index'])->name('teacher.teacher_dashboard');
    Route::get('/teacher/communications', [TeacherController::class, 'showCommunications'])->name('teacher.communications');

    // student
    Route::get('/student/student_dashboard', [StudentController::class, 'index'])->name('student.student_dashboard');
    Route::get('/student/communications', [StudentController::class, 'showCommunications'])->name('student.communications');

    // parent
    Route::get('/parent/parent_dashboard', [ParentController::class, 'index'])->name('parent.parent_dashboard');
    Route::get('/parent/communications', [ParentController::class, 'showCommunications'])->name('parent.communications');
    Route::get('/parent/grades', [ParentController::class, 'viewChildGrades'])->name('parent.grades');
    Route::get('/parent/attendance', [ParentController::class, 'viewChildAttendance'])->name('parent.attendance');

    // security
    Route::get('/security/security_dashboard', [SecurityController::class, 'index'])->name('security.security_dashboard');
    Route::post('/security/check-in', [SecurityController::class, 'checkIn'])->name('security.check-in');
    Route::post('/security/check-out', [SecurityController::class, 'checkOut'])->name('security.check-out');
    Route::get('/security/check-in-history', [SecurityController::class, 'viewCheckInHistory'])->name('security.check-in-history');
    Route::get('/security/export-excel', function (Request $request) {
        return Excel::download(new CheckInExport($request->role, $request->name, $request->date), 'check_in_history.xlsx');
    })->name('security.export_excel');
    Route::get('/security/export-pdf', [SecurityController::class, 'exportPDF'])->name('security.export_pdf');
    Route::get('/security/check-in-stats', [SecurityController::class, 'getCheckInStats'])->name('security.check_in_stats');
    Route::get('/security/check-in-by-role', [SecurityController::class, 'getCheckInByRole'])->name('security.check_in_by_role');
    Route::get('/security/visitor-register', [SecurityController::class, 'showVisitorForm'])->name('security.visitor.register');
    Route::post('/security/visitor-checkin', [SecurityController::class, 'checkInVisitor'])->name('security.visitor.checkin');
    Route::post('/security/visitor-checkout', [SecurityController::class, 'checkOutVisitor'])->name('security.visitor.checkout');
    Route::get('/security/visitor-log', [SecurityController::class, 'showVisitorLog'])->name('security.visitor.log');
    Route::get('/security/communications', [SecurityController::class, 'showCommunications'])->name('security.communications');

    // accountant
    Route::get('/accountant/accountant_dashboard', [App\Http\Controllers\AccountantController::class, 'index'])->name('accountant.accountant_dashboard');
    Route::get('/accountant/communications', [AccountantController::class, 'showCommunications'])->name('accountant.communications');
    Route::get('/my/fee', [FeeController::class, 'index'])->name('student.fees_index');
    Route::resource('fees', FeeController::class);
    Route::post('/fees/pay', [PaymentController::class, 'pay'])->name('fees.pay');
    Route::get('/fees/create', [FeeController::class, 'create'])->name('accountant.fees_create'); // Show Fee Structure Form
    Route::post('/fees/store', [FeeController::class, 'store'])->name('fees.store');   // Store Fee Structure
    Route::get('/fees/{id}', [FeeController::class, 'show']);
    // handling mpesa callback
    Route::post('/mpesa/callback', function (Request $request) {
    // Process MPESA response
    $response = json_decode($request->getContent(), true);
    $mpesa_code = $response['Body']['stkCallback']['CheckoutRequestID'] ?? null;
    $amount = $response['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'] ?? null;

        if ($mpesa_code) {
            $fee = Fee::where('student_id', auth()->id())->first();
            $fee->amount_paid += $amount;
            $fee->balance -= $amount;
            $fee->save();

            return response()->json(["message" => "Payment successful."]);
        } else {
            return response()->json(["message" => "Payment failed."], 400);
        }
    });
    Route::get('/fees/receipt/{id}', [FeeController::class, 'receipt'])->name('fees.receipt');

    // librarian
    Route::get('/librarian/librarian_dashboard', [App\Http\Controllers\LibrarianController::class, 'index'])->name('librarian.librarian_dashboard');
    Route::get('/librarian/communications', [LibrarianController::class, 'showCommunications'])->name('librarian.communications');
    Route::get('/librarian', [LibrarianController::class, 'showIndex'])->name('librarian.showIndex');
    Route::post('/librarian/issue/{book}', [LibrarianController::class, 'issueBook'])->name('librarian.issue');
    Route::post('/librarian/return/{transaction}', [LibrarianController::class, 'returnBook'])->name('librarian.return');
    Route::get('/librarian/add', [LibrarianController::class, 'create'])->name('librarian.create');
    Route::post('/librarian/store', [LibrarianController::class, 'store'])->name('librarian.store');
    Route::post('/library/borrow/{book}', [LibrarianController::class, 'borrowBook'])->name('librarian.borrow');
    Route::get('/library/borrowed', [LibrarianController::class, 'borrowedBooks'])->name('librarian.borrowed');
    Route::get('/digital-library', [DigitalLibraryController::class, 'index'])->name('digital.library');
    Route::post('/digital-library/upload', [DigitalLibraryController::class, 'upload'])->name('digital.library.upload');
    Route::get('/digital-library/upload', [DigitalLibraryController::class, 'createIndex'])->name('digital.library.create');
    Route::get('/digital-library/download/{id}', [DigitalLibraryController::class, 'download'])->name('digital.library.download');

    // cook
    Route::get('/cook/cook_dashboard', [App\Http\Controllers\CookController::class, 'index'])->name('cook.cook_dashboard');
    Route::get('/cook/communications', [CookController::class, 'showCommunications'])->name('cook.communications');
    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
    Route::get('student/meals', [MealController::class, 'takeIndex'])->name('meals.takeIndex');
    Route::post('/meals/store', [MealController::class, 'store'])->name('meals.store');
    Route::post('/meals/take/{mealPlanId}', [MealController::class, 'takeMeal'])->name('meals.take');
    Route::get('/food-stock', [FoodStockController::class, 'index'])->name('food.stock.index');
    Route::get('/food-stock/create', [FoodStockController::class, 'create'])->name('food_stock.create');
    Route::post('/food-stock', [FoodStockController::class, 'store'])->name('food_stock.store');
    Route::post('/food-stock/use/{id}', [FoodStockController::class, 'useStock'])->name('food_stock.use');

    // exam assignments
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create'); // Show upload form
    Route::post('/assignments/upload', [AssignmentController::class, 'store'])->name('assignments.upload'); // Store assignment
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index'); // View assignments
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams/upload', [ExamController::class, 'store'])->name('exams.upload');
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    // Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/view', [ExamController::class, 'index'])->name('grades.view');
    Route::post('/assignments/{assignment}/submit', [AssignmentController::class, 'submit'])->name('assignments.submit');
    // Route::get('/grades', [GradeController::class, 'index'])->name('grades.view');
    Route::post('/exams/{exam}/submit', [ExamSubmissionController::class, 'store'])->name('exams.submit');

    // grading
    Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades', [GradeController::class, 'gradeIndex'])->name('grades.gradeIndex');
    Route::get('/grades/create', [GradeController::class, 'create'])
    ->name('grades.create');
    Route::get('/grades/export/pdf', [GradeController::class, 'exportPDF'])->name('grades.export.pdf');

    // attendance
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    // learning_resources
    Route::get('/learning-resources', [LearningResourceController::class, 'index'])->name('learning_resources.index'); // Students view
    Route::get('/learning-resources/create', [LearningResourceController::class, 'create'])->name('learning_resources.create'); // Teachers upload
    Route::post('/learning-resources', [LearningResourceController::class, 'store'])->name('learning_resources.store');
    Route::get('/learning-resources/download/{id}', [LearningResourceController::class, 'download'])->name('learning_resources.download');
    
    // Route::get('/exam/download/{id}', [LearningResourceController::class, 'download_exam'])->name('assignment.download');
});

    // download assignment student
    Route::get('/download/{file}', function ($file) {
        $path = storage_path('app/public/' . $file);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return Response::download($path);
    })->name('download.file');


require __DIR__.'/auth.php';
