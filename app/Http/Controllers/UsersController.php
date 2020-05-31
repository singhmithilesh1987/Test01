<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subject;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $response = array();
        $response['isSuccess'] = false;
        $response['status'] = 'failure';
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|unique:users|max:255',
            'phone'=> 'required|numeric|digits:10',
            //'subject'=> 'required',
        ]);
        $user = new User;
        $user->name  = request('name');
        $user->email = request('email');
        $user->phone = request('phone');
        if($user->save()){
            $subjects = request('subject');
            foreach($subjects as $k=> $val){
                Subject::create([
                    'user_id'=> $user->id,
                    'subject'=> $subjects[$k]]
                    );
            }
        $response['isSuccess'] = true;
        $response['status'] = 'success';
        }
        return $response;
    }

    public function checkEmail(Request $req){
        $response = array();
        $result = User::where('email', $req->email)->count();
        if($result == true){
            $response['isSuccess'] = true;
            $response['status'] = 'success';
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
