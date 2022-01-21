<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $data["quiz"] = Quiz::where('quiz_accept','1')->orderBy('created_at','desc')->get();

        return view('user.dashboard',$data);
    }

    public function quizDetail(Request $req , $id)
    {
        $data["quiz"]= Quiz::where('id',$id)->first();
        $data["question"] = Question::where('quiz_in',$id)->get();

        return view('user.quizdetail',$data);
    }

    public function startQuiz(Request $req , $id)
    {
        $data["quiz"]= Quiz::where('id',$id)->first();
        $data["question"] = Question::where('quiz_in',$id)->get();

        return view('user.startquiz',$data);
    }

    public function submitQuiz(Request $req)
    {
        $question = Question::where('quiz_in',$req->quizid)->get();
        $ans = $req->answer;
        $counter = 0;
        $wrong = 0;
        for($i = 0 ;$i<count($question);$i++)
        {
            if($question[$i]->correct == $ans[$i])
            {
                $counter++;
            }
            else{
                $wrong++;
            }
        }

        return redirect()->back()->with(['error'=>$wrong.' Wrong Answers' , 'success'=>$counter.' Correct Answers']);
    }

    public function signIn(Request $req)
    {
        return view('user.signin');
    }
    public function signInAuth(Request $req)
    {
       $auth = Auth::attempt(['email'=>$req->email, 'password'=>$req->password]);
       if($auth)
       {
         return redirect('/home');
       }
       else{
        return redirect()->back();
    }
    }

    public function signUp(Request $req)
    {
        return view('user.signup');
    }

    public function signupUser(Request $req)
    {
        $validate = Validator::make($req->all(),[
            "email"=>"required",
            "password"=>"required"
        ]);
        if($validate->fails())
        {
            return redirect()->back()->with('error','Account not created. Error Occured');
        }
        $user = new User;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        if($user->save())
        {
            return redirect('/home');
        }
        else{
            return redirect()->back();
        }
        
    }

    public function logout(Request $req){
        return redirect('/');
    }

    public function addQuiz(Request $req)
    {
        try {

            $data["quiz"] = Quiz::where('user_id' , auth()->user()->id)->where('quiz_Accept')->get();
            return view('user.addquiz');
          
          } catch (\Exception $e) {
          
              return redirect('/')->with('error',$e->getMessage());
          }
        
    }

    public function userAddQuiz(Request $req)
    {
        try{

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
                $quiz->quiz_accept = 0;
                $quiz->user_id = auth()->user()->id;
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
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function addQuestion(Request $req)
    {
        try{
            $data["quiz"] = Quiz::where('quiz_accept','1')->where('user_id',auth()->user()->id)->get();
            return view('user.addquestion' ,$data);
        }catch(\Exception $e)
        {
            return redirect('/')->with('error',$e->getMessage());
        }
        
    }
    public function userAddQuestion(Request $req)
    {
        try{

            $validate = Validator::make($req->all(),[
                "name"=>"required",
                "option1"=>"required",
                "option2"=>"required",
                "option3"=>"required",
                "option4"=>"required",
                "position"=>"required",
                "correct"=>"required",
                "image"=>"required",
                "question_in_quiz"=>"required",
            ]);
    
            if($validate->fails())
            {
                return redirect()->back()->with('error',$validate->errors()->first());
            }

            if($req->question_in_quiz == 0 )
            {
                return redirect()->back()->with('error','You have no quiz listed to add question.');
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
            $que->user_id = auth()->user()->id;
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
    


        }catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
