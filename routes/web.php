<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\PreventBackHIstory;
use App\Http\Controllers\MedicalHistoryController;
use App\Models\MedicalHistory;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login-main');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::group(['middleware'=>['auth', PreventBackHistory::class]], function (){

Route::get('/admin/{user}', [AuthController::class, 'index_employees'])->name('admin.employee-list');
Route::get('/admin/{user}/change-passowrd', [AuthController::class, 'show_password'])->name('admin.show-password');
Route::post('/admin/{user}/change-passowrd/your-password', [AuthController::class, 'change_password'])->name('admin.change-password');
Route::get('/admin/{user}/create-employee-new', [AuthController::class, 'show'])->name('admin.show-employee');
Route::post('/admin/{user}/create-employee-new/add', [AuthController::class, 'store'])->name('admin.add-employee');
Route::get('/admin/{user}/edit-employee/{other}/edit', [AuthController::class, 'edit'])->name('admin.edit-employee');
Route::put('/admin/{user}/edit-employee-update/{other}/update', [AuthController::class, 'update'])->name('admin.update-employee');
Route::put('/admin/{user}/edit-employee-update/{other}/reset', [AuthController::class, 'reset'])->name('admin.reset-employee');
Route::get('/admin/{user}/help', [AuthController::class, 'help'])->name('admin.help');
Route::get('/receptionist/{user}', [AuthController::class, 'show_patients'])->name('receptionist.patient-list');
Route::get('/receptionist/{user}/change-passowrd', [AuthController::class, 'show_password_receptionist'])->name('receptionist.show-password');
Route::post('/receptioinst/{user}/change-passowrd/your-password', [AuthController::class, 'change_password_receptionist'])->name('receptionist.change-password');
Route::get('/receptionist/{user}/create-patient-new', [AuthController::class, 'show_patient'])->name('receptionist.show-patient');
Route::post('/receptionist/{user}/create-patient-new/add', [AuthController::class, 'store_patient'])->name('receptionist.add-patient');
Route::get('/receptionist/{user}/edit-patient/{other}/edit', [AuthController::class, 'edit_patient'])->name('receptionist.edit-patient');
Route::put('/receptionist/{user}/edit-receptionist-update/{other}/update', [AuthController::class, 'update_receptionist'])->name('receptionist.update-patient');
Route::get('/receptionist/{user}/help', [AuthController::class, 'help_receptionist'])->name('receptionist.help');
Route::put('/receptionist/{user}/send-to-triage/{other}', [AuthController::class, 'send'])->name('receptionist.send');
Route::get('/doctor/triage/{user}', [AuthController::class, 'show_triage_doctor'])->name('doctor.triage-list');
Route::get('/doctor/{user}/change-passowrd', [AuthController::class, 'show_password_doctor'])->name('doctor.show-password');
Route::post('/doctor/{user}/change-passowrd/your-password', [AuthController::class, 'change_password_doctor'])->name('doctor.change-password');
Route::get('/doctor/{user}/view-triage/{other}', [MedicalHistoryController::class, 'show'])->name('doctor.show-triage');
Route::post('/doctor/{user}/add-triage/{other}', [MedicalHistoryController::class, 'store'])->name('doctor.add-triage');
Route::get('/doctor/patients/{user}', [AuthController::class, 'show_patients_doctor'])->name('doctor.patient-list');
Route::get('/doctor/{user}/view-patient/{other}', [MedicalHistoryController::class, 'show_one_patient'])->name('doctor.show-one-patient');
Route::put('/doctor/{user}/view-patient/{other}/add-history{history}', [MedicalHistoryController::class, 'store_observation'])->name('doctor.add-observation');
Route::put('/doctor/{user}/view-patient/{other}/add-medicine{history}', [MedicalHistoryController::class, 'store_medicine'])->name('doctor.add-medicine');
Route::put('/doctor/{user}/view-patient/{other}/add-refer{history}', [MedicalHistoryController::class, 'store_refer'])->name('doctor.add-refer');
Route::get('/doctor/{user}/view-laboratory/{other}/history/{history}', [MedicalHistoryController::class, 'show_lab'])->name('doctor.show-lab');
Route::post('/doctor/{user}/add-laboratory/{other}/history/{history}', [MedicalHistoryController::class, 'store_lab'])->name('doctor.add-lab');
Route::get('/doctor/{user}/help', [AuthController::class, 'help_doctor'])->name('doctor.help');
Route::get('/lab/patients/{user}', [AuthController::class, 'show_lab_patients'])->name('lab.patient-list');
Route::get('/lab/{user}/change-passowrd', [AuthController::class, 'show_password_lab'])->name('lab.show-password');
Route::post('/lab/{user}/change-passowrd/your-password', [AuthController::class, 'change_password_lab'])->name('lab.change-password');
Route::get('/lab/{user}/help', [AuthController::class, 'help_lab'])->name('lab.help');
Route::get('/lab/patients/{user}/patient/{other}/lab-request', [MedicalHistoryController::class, 'show_lab_request'])->name('lab.patient');
Route::put('/lab/patients/{user}/patient/{labRequest}/lab-result', [MedicalHistoryController::class, 'store_lab_request'])->name('lab.patient.store');
Route::put('/doctor/{user}/view-patient/{other}/finish/{history}', [MedicalHistoryController::class, 'finish'])->name('doctor.finish');

Route::get('/doctor/patient/{user}/{other}/histories', [AuthController::class, 'show_patients_doctor_histories'])->name('doctor.patient-list-history');
Route::get('/doctor/patient/{user}/{other}/histories/{history}', [MedicalHistoryController::class, 'show_patients_history'])->name('doctor.patient-history');
});

















