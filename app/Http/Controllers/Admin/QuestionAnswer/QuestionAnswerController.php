<?php

namespace App\Http\Controllers\Admin\QuestionAnswer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionAnswerController extends Controller
{
    public function index(){
        return view('admin.question-answer.index');
    }
}
