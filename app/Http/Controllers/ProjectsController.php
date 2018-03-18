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
        if(Auth::check()){
      
            $projects = DB::table('projects')->where('user_id', Auth::user()->id )->get();
            // $projects = Project::where('user_id', Auth::user()->id )->get();
            return view('projects.index',['projects' => $projects]);
        }

        return view('auth.login');
    }

    public function adduser(Request $request){
         //add user to projects 
         //take a project, add a user to it
         $project = Project::find($request->input('project_id'));
        
         if(Auth::user()->id == $project->user_id){
          $user = User::where('email', $request->input('email'))->get(); //single record
         // check if user is already added to the project

         // dd($user);
         $projectUser = ProjectUser::where('user_id',$user->id)
                                    ->where('project_id',$project->id)
                                    ->first();
        dd($projectUser);

            if($projectUser){
                // if user already exists, exit 
        
                return response()->json(['success' ,  $request->input('email').' is already a member of this project']); 
               
            }
            if($user && $project){
                $project->users()->attach($user->id); 
                     return response()->json(['success' ,  $request->input('email').' was added to the project successfully']); 
                        
                    }
                    
         }
         return redirect()->route('projects.show', ['project'=> $project->id])
         ->with('errors' ,  'Error adding user to project');
        
         
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
                            'days'=> $request ->input('days')
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
     
         $query = DB::table('users')
                ->join('comments','users.id','=','comments.user_id')
                ->where('comments.commentable_id','=', $id)
                ->get();

            return view('projects.show', ['project'=>$project,'query'=>$query]);


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
                                   'company_id' => $request->input('company_id')
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
        dd($delete);
        if ($delete->delete()) {
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
        }

        return back()->withInput->with('errors', 'Project could not be deleted');
    } }