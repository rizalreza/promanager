<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\Comment;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        if(Auth::user()->role_id == 1 ){
            $projects = Project::all();

            return view('projects.index',['projects' => $projects]);
      
            
        } else {
            
            $projects = DB::table('projects')->where('user_id', Auth::user()->id )->get();
            return view('projects.index',['projects' => $projects]);
           // dd($projectAll);
           

        }

        return view('auth.login');
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

            return view('projects.create',['companies'=> $companies]);

             
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
        //
        if(Auth::check()){

            $ProjectStore = Project::create([
                            'project_name'=> $request -> input('project_name'),
                            'project_desc'=> $request -> input('project_desc'),
                            'company_id'=> $request -> input('company_id'),
                            'user_id'=>Auth::user()->id,
                            'project_deadline'=> $request ->input('project_deadline')
                        ]);

            if($ProjectStore){
                return redirect()->route('projects.index')->with('success','Project added successfully');
            }  
        }

        return back()->withInput()->with('errors', 'You could not have access');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       if(Auth::check()){ 

       
         $project = DB::table('companies')
                    ->join('projects','companies.id','=','projects.company_id')
                    ->where('projects.id','=', $id)
                    ->first();

         $tasks = DB::table('tasks')
                    ->where('project_id', $id)
                    ->get();

     
         $query = DB::table('users')
                ->join('comments','users.id','=','comments.user_id')
                ->where('comments.commentable_id','=', $id)
                ->get();

            return view('projects.show', ['tasks'=>$tasks,'project'=>$project,'query'=>$query]);


        }

        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        if(Auth::check()){
            
            $companies = Company::all();
            $project = Project::find($project->id);
            return view('projects.edit', ['project'=>$project, 'companies'=>$companies]);
        }

        return view('auth.login');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //


        $projectUpdate = Project::where('id', $project->id)
                         ->update([
                                   'project_name' => $request->input('project_name'),
                                   'project_desc' => $request->input('project_desc'),
                                   'company_id' => $request->input('company_id'),
                                   'project_deadline' => $request->input('project_deadline')
                                  ]);
                                  
        if($projectUpdate){
            return redirect()->route('projects.show', ['project'=> $project->id ])->with('success','Project updated successfully');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $delete = Project::find( $project->id);
        if ($delete->delete()) {
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
        }

        return back()->withInput->with('errors', 'Project could not be deleted');
    } 

}