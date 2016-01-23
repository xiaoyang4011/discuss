<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hyancat\Sendcloud\SendCloudFacade as SendCloud;
use Hyancat\Sendcloud\SendCloudMessage as SendCloudMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = 'www.7csa.com';

        return view('sites.about')->with('name', $name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function sendmailtest(){

        SendCloud::sendTemplate('test_template_active', ['%url%'=> ['www.baidu.com']], function (SendCloudMessage $message) {
            $message->to(['214118699@qq.com'])->subject('你好');
        })->success(function ($response) {
            dd($response);
        })->failure(function ($response, $error) {
            dd($response);
        });


        return view('sites.about');
    }
}
