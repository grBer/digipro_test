<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\SearchHistory;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numQuestions' => 'required|integer|min:1|max:49',
            'difficulty' => 'required|string',
            'type' => 'nullable|string', // Type is optional
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->route('form.show')
                ->withErrors($validator)
                ->withInput();
        }

        //Prepare the API URL
        $amount = $request->numQuestions;
        $difficulty = $request->difficulty;
        $type = $request->type ?? 'multiple'; //if is nt provided i set as default the multiple
        $url = "https://opentdb.com/api.php?amount={$amount}&difficulty={$difficulty}&type={$type}";

        //Make the Api call
        //$resposne = Http::get($url);

        $response = Http::withOptions([
            'verify' => false,
        ])->get($url);
        

        //Check if response is successful
        if ($response->successful()){
            $data = $response->json();

            //Filter and sort the data
            $filteredQuestions = collect($data['results'])->filter(function($question){
                return $question['category'] !== 'Entertainment: Video Games';
            });

            $sortedQuestions = $filteredQuestions->sortBy('category')->values()->all();

            //Store valid search in the database
            SearchHistory::create([
                'full_name' => $request->fullName,
                'email' => $request->email,
                'num_questions' => $request->numQuestions,
                'difficulty' => $request->difficulty,
                'type' => $request->type,
            ]);

            return redirect()->route('questions.show')->with('questions', $sortedQuestions);            
        }else{
            return redirect()->route('form.show')->with('error', 'Failed to fetch data from the API');
        }        
    }

    public function showQuestions(Request $request){
        $questions = session('questions');
        return view('questions', compact('questions'));        
    }

    public function nextQuestion(Request $request){
        $questions = session('questions');
        $currentQuestionIndex = $request->input('questionIndex');
        $userAnswers = session('userAnswer', []);

        //Store  user answer
        $userAnswers[] = $request->input('answer');
        session(['userAnswers' => $userAnswers]);

        //Move to the next question
        $currentQuestionIndex++;
        session(['currentQuestionIndex' => $currentQuestionIndex]);

        //Redirect to the questions view
        return redirect()->route('question.show');
    }
}
