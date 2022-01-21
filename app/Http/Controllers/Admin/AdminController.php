<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Quiz;
use App\Models\Question;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        $data["quiz"] = Quiz::orderBy('id','desc')->take(10)->get();
        $data["count"]= Quiz::count();

        return view("admin.dashboard",$data);
    }

    public function showQuizForAdd(Request $req)
    {
        return view('add.addquiz');
    }

    public function addQuiz(Request $req)
    {
        $validate = Validator::make($req->all(),[
        "name"=>"required",
        "image"=>"required",
        "description"=>"required",
        "author"=>"required"
        ],[
            "required"=>":attribute is missing."
        ]);

        if($validate->fails())
        {
            return redirect()->back()->with('error',$validate->errors()->first());
        }

        $quiz = new Quiz;
        $quiz->quiz_name = $req->name;
        $quiz->quiz_description = $req->description;
        $quiz->quiz_author = $req->author;
        $quiz->quiz_accept = 1;
        if($req->image)
        {
            $image = $req->file('image');
            
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = public_path().'/images/';
            $image->move($path,$imageName);
            $quiz->quiz_image = $imageName;
        }

        if($quiz->save())
        {
            return redirect()->back()->with('success',"Quiz Added Successfully");
        }
        else{
            return redirect()->back()->with('error',"Error Occured");
        }
    }


    public function getAllQuizes(Request $req)
    {
        $quiz = Quiz::all();
        $data["quiz"] = $quiz;
        if(count($quiz)>0)
        {
            
            return view('list.quizdetail',$data);
        }else{
            return view('list.quizdetail',$data)->with('error','No data Found');
        }
    }

    public function showEditQuiz(Request $req, $id)
    {
        $data["quiz"] = Quiz::where('id',$id)->first();
        if(!empty($data["quiz"]))
        {
            return view("edit.editquiz" , $data);
            
        }
        else{
            return redirect()->back()->with('error','No Such Quiz Found');
        }
    }

    public function editQuiz(Request $req )
    {
        $quiz = Quiz::where('id',$req->quizid)->first();
        if(!empty($quiz))
        {
            $quiz->quiz_name = $req->name;
            $quiz->quiz_description = $req->description;
            $quiz->quiz_author = $req->author;
            if($quiz->save())
            {
                $quiz = Quiz::all();

                if(count($quiz)>0)
                {
                    $data["quiz"] = $quiz;
                    return view('list.quizdetail',$data)->with('success','Quiz Updated');
                }
                else{return view('list.quizdetail',$data)->with('error','No data found');

                }
            }
            else{
               
                return back()->with('error','Error Occured');
            }
        }
        else{
            return back()->with('error','No Quiz Found for Update');
        }

    }

    public function deleteQuiz(Request $req , $id)
    {
        $quiz = Quiz::where('id',$id)->delete();
        if($quiz == true)
        {
            return redirect()->back()->with('success','Quiz Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Error Occured');
        }
    }

    public function addQuestionView(Request $req)
    {
        $quiz = Quiz::where('quiz_accept','1')->get();
        $data["quiz"] = $quiz;
        return view('add.addquestion' , $data);
    }

    public function addQuestion(Request $req)
    {
        $validate = Validator::make($req->all(),[
            "name"=>"required",
            "image"=>"required",
            "option1"=>"required",
            "option2"=>"required",
            "option3"=>"required",
            "option4"=>"required",
            "position"=>"required",
            "correct"=>"required",
            "question_in_quiz"=>"required",
        ]);

        if($validate->fails())
        {
            return redirect()->back()->with('error',$validate->errors()->first());
        }
       
        $que = new Question;
        $que->q_name = $req->name;
        $que->q_option1 = $req->option1;
        $que->q_option2 = $req->option2;
        $que->q_option3 = $req->option3;
        $que->q_option4 = $req->option4;
        $que->position = $req->position;
        $que->correct = $req->correct;
        $que->quiz_in = $req->question_in_quiz;
        $que->user_id = 1;
        if($req->image)
        {
            $image = $req->file('image');
            
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $path = public_path().'/images/';
            $image->move($path,$imageName);
            $que->q_image = $imageName;
        }
        if($que->save())
        {
            return redirect()->back()->with('success','Question added successfully');
        }
        else{
            return redirect()->back()->with('error','Error Occured');
        }

    }

    public function viewQuestion(Request $req)
    {
        $data["question"] = Question::join('quiz','quiz.id','=','question.quiz_in')->where('quiz.quiz_accept','1')->get();
        return view("list.questions" , $data);
    }


    public function viewQuestionApproval(Request $req)
    {
        $data["quiz"] = Quiz::where('quiz.quiz_accept','0')->get();
        if(count($data["quiz"])>0){
            return view("admin.quizapproval" , $data);
        }
        else{
            return view("admin.quizapproval" , $data)->with('error','No Data Available for approval');
        }
        
    }
    public function quizApproved(Request $req, $id)
    {
        $quiz = Quiz::where('id',$id)->first();
        if(!empty($quiz))
        {
            $quiz->quiz_accept = 1;
            if($quiz->save())
            {
                return redirect()->back()->with('success','Quiz Approved');
            }
        }
    }

    
}
