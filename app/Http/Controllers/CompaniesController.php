<?php

namespace App\Http\Controllers;

use App\Company;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB; 

class CompaniesController extends Controller
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
      
            // $companies = DB::table('companies')->where('user_id', Auth::user()->id )->get();
            $companies = Company::all();
            return view('companies.index',['companies' => $companies]);
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
            $users = User::all();
            return view('companies.create',['users' => $users]);
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

            $companyStore = Company::create([
                            'company_name'=> $request -> input('company_name'),
                            'company_desc'=> $request -> input('company_desc'),
                            'user_id'=>Auth::user()->id
                        ]);

            if($companyStore){
                return redirect()->route('companies.index')->with('success','Company added successfully');
            }  
        }

        return back()->withInput()->with('errors', 'You could not have access');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
       if(Auth::user()->role_id == 1 ){

         $company = Company::find($company->id);
         $projects = DB::table('projects')
                   ->where( 'company_id', $company->id)
                   ->get();

        return view('companies.show', ['company' => $company, 'projects' => $projects]);
       }else{
           $company = Company::find($company->id);
           $projects = DB::table('projects')->where([
                    ['user_id', Auth::user()->id],
                    ['company_id', $company->id]
                ])->get();

            return view('companies.show', ['company' => $company, 'projects' => $projects]);
        } 

        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        if(Auth::check()){
            $company = Company::find($company->id);
            return view('companies.edit', ['company'=>$company]);
        }

        return view('auth.login');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //

        $companyUpdate = Company::where('id', $company->id)
                         ->update([
                                   'company_name' => $request->input('company_name'),
                                   'company_desc' => $request->input('company_desc')
                                  ]);
        if($companyUpdate){
            return redirect()->route('companies.show', ['company'=> $company->id ])->with('success','Company updated successfully');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
        $delete = Company::find( $company->id);
        if ($delete->delete()) {
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
        }

        return back()->withInput->with('error', 'Company could not be deleted');
    }
}
