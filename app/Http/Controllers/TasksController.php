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


            $tasks = DB::table('tasks')
                    ->join('projects','tasks.project_id','=','projects.id')
                    ->join('companies','tasks.company_id','=','companies.id')
                    ->select('tasks.id','tasks.task_name','projects.project_name','companies.company_name')
                    ->get();
          

            return view('tasks.index',['tasks' => $tasks]);
      
            
        } else {


             $tasks = DB::table('tasks')
                    ->join('projects','tasks.project_id','=','projects.id')
                    ->join('companies','tasks.company_id','=','companies.id')
                    ->select('tasks.id','tasks.task_name','tasks.user_id','projects.project_name','companies.company_name')
                    ->where('tasks.user_id', Auth::user()->id )
                    ->get();
            
     
            return view('tasks.index',['tasks' => $tasks]);

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
    public function create(Project $project)

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
                    'task_desc' => $request -> input('task_desc'),
                    'project_id' => $request -> input('project_id'),
                    'company_id' => $request -> input('company_id'),
                    'task_deadline' => $request -> input('task_deadline'),
                    'user_id' => Auth::user()->id,
                ]);

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
    public function show($id)
    {
        // dd($id);
      if(Auth::check()){

         $task = DB::table('tasks')
                ->join('projects','tasks.project_id','=','projects.id')
                ->join('companies','tasks.company_id','=','companies.id')
                ->where('tasks.id','=', $id)
                ->select('tasks.id','tasks.task_name','tasks.task_deadline','tasks.task_desc','tasks.user_id','projects.project_name','companies.company_name')
                ->first();
            // dd($task);

      }
        return view('tasks.show', ['task' => $task]);
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
        
            $taskUpdate = Task::where('id', $task->id)->update
                    ([
                    'task_name' => $request -> input('task_name'),
                    'task_desc' => $request -> input('task_desc'),
                    'project_id' => $request -> input('project_id'),
                    'company_id' => $request -> input('company_id'),
                    'task_deadline' => $request -> input('task_deadline'),
                    'user_id' => Auth::user()->id
                    ]);

          
            if($taskUpdate){
                return redirect()->route('tasks.show', ['task'=>$task->id ])->with('success','Task updated successfully');
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
        $delete = Task::find( $task->id);
        if ($delete->delete()) {
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully !');
        }

        return back()->withInput->with('errors', 'Project could not be deleted');
     
    }
}
