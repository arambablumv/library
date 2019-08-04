<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $query=Library::with(['author'=>function($q){
            $q->orderBy('name');
        },'user'=>function($q){
            $q->select('id','name');
        }])->orderBy('title');
        if(!$query->exists()){
            return back()->withErrors( "not found");


        }
        return view('home',['query'=>$query->paginate('5')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=> 'required',

        ]);
        $query=new Library();
        $query->title=$request->get('title');
        $query->description=$request->get('description');
        if($query->save()){
            foreach ($request->get('author') as $value){
                $author=new Author();
                $author->name=$value['name'];
                $author->save();
                DB::table('library_authors')->insert(['library_id'=>$query->id,'author_id'=>$author->id]);
            }
        }
        return redirect('/home')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query=Library::where('id', $id);
        if(!$query->exists()){
            return back()->withErrors( "not found");

        }

        return view('book',['query' => $query->first()]);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);
        $query=Library::where('id',$id);
        if($query->exists()){
            $query= $query->first();
            $query->status=$request->status=$request->get('status');
            if($request->get('status')==1){
                $query->user_id=Auth::user()->id;
            }else{
                $query->user_id=null;
            }
            if(!$query->save()){
                return back()->withErrors( "not found");
            }
            return  redirect( $request->has('path')?$request->get('path'):$request->path());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }


    public function update_book_status(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $query=Library::where('id',$id);
        if($query->exists()){
            $query= $query->first();
            $query->status=$request->status=$request->get('status');
            if($request->get('status')==1){
                $query->user_id=Auth::user()->id;
            }
            if(!$query->save()){
                return response()->json(['messages'=>'error'],400);
            }
            return response()->json(['messages'=>'succfule'],200);

        }
    }
}
