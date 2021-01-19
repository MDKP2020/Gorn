<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Group;
use App\Models\Student;

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
  return view('index');
});

Route::get('groups/get', function() {
  return Group::all();
});

Route::get('students/get/{id}', function($id) {
  return Student::where('group_id', $id)->get();
});

Route::post('students/upgrade', function(Request $request) {
  $student_ids = $request['student_ids'];
  foreach($student_ids as $student_id){
    $tmp_student = DB::table('students')->where('id', $student_id)->first();
    // if (substr($tmp_student['group_id'], 0, strspn($tmp_student['group_id'], "0123456789")) != 4) {
    DB::table('students')
      ->where('id', $student_id)
      ->update(['group_id' => $tmp_student['group_id']+3]);
    // }
  }
});

Route::post('students/delete', function(Request $request) {
  $student_ids = $request['student_ids'];
  foreach($student_ids as $student_id){
    DB::table('students')->where('id', $student_id)->delete();
  }
});