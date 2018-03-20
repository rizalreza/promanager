<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Auth::user()->role_id == 1 ){
            $tasks = Task::all();

            return view('tasks.index',['tasks' => $tasks]);
      
            
        } else {
            
            $tasks = DB::table('tasks')->where('user_id', Auth::user()->id )->get();
            return view('tasks.index',['tasks' => $tasks]);
           // dd($projectAll);
           

        }

        return view('auth.login');
    }

    public function findProject(Request $request)
    {

         $data = Project::select('project_name','id')->where('company_id',$request->id)->take(100)->get();
         // $prjct = $projects->toJson();       
         return response()->json($data);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Auth::check()){
            $companies = Company::all();
            $projects = Project::all();

        return view('tasks.create',['companies'=> $companies, 'projects'=>$projects]);

             
        }

        return view('auth.login')->with('errors', 'You could not have access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){

            $taskStore = Task::create([
                    'task_name' => $request -> input('task_name'),
                    'project_id' => $request -> input('project_id'),
                    'company_id' => $request -> input('company_id'),
                    'days' => $request -> input('days'),
                    'hours' => $request -> input('hours'),
                    'user_id' => Auth::user()->id,
                ]);

            dd($taskStore);
            if($taskStore){
                return redirect()->route('tasks.index')->with('success','Task added successfully');
            }
        }

         return back()->withInput()->with('errors', 'You could not have access');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if(Auth::check()){
            $companies = Company::all();
            $projects = Project::all();
            $task = Task::find($task->id);

            return view('tasks.edit', ['companies' => $companies, 'projects' => $projects, 'task' => $task]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if(Auth::check()){

            $taskUpdate = Task::where('id', $task->id)->update
                    ([
                    'task_name' => $request -> input('task_name'),
                    'project_id' => $request -> input('project_id'),
                    'company_id' => $request -> input('company_id'),
                    'days' => $request -> input('days'),
                    'hours' => $request -> input('hours'),
                    'user_id' => Auth::user()->id,
                    ]);
          

            // dd($taskUpdate);
            if($taskUpdate){
                return redirect()->route('tasks.show')->with('success','Task updated successfully');
            }
        }

         return back()->withInput()->with('errors', 'You could not have access');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
