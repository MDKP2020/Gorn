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
  $old_group_id = $request['group_id'];
  $old_group = DB::table('groups')
    ->where('id', $old_group_id)
    ->first();
  $new_group_id = DB::table('groups')
    ->where('year', $old_group->year+1)
    ->where('direction', $old_group->direction)
    ->first()->id;
  foreach($student_ids as $student_id){
    DB::table('students')
      ->where('id', $student_id)
      ->update(['group_id' => $new_group_id]);
  }
});

Route::post('students/move', function(Request $request) {
  $student_ids = $request['student_ids'];
  $group_id = $request['group_id'];
  foreach($student_ids as $student_id){
    DB::table('students')
      ->where('id', $student_id)
      ->update(['group_id' => $group_id]);
  }
});

Route::post('students/delete', function(Request $request) {
  $student_ids = $request['student_ids'];
  foreach($student_ids as $student_id){
    DB::table('students')->where('id', $student_id)->delete();
  }
});