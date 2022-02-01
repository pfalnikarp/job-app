<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class GroupController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$groupmaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id', '=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('count(group_user.user_id) as totuser'), DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->get();

		//dd($groupmaster);

		return view('groups.index', compact('groupmaster'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$groupmaster = DB::table('group_master')->leftjoin('group_user', 'group_user.group_id', '=', 'group_master.id')->leftjoin('users', 'users.id', '=', 'group_user.user_id')->select('group_master.id as groupid', 'group_master.name as groupname', DB::raw('count(group_user.user_id) as totuser'), DB::raw('group_concat(users.id) as userids'), DB::raw('group_concat(users.name) as names'))->groupBy('group_master.id', 'group_master.name')->where('group_master.id', '=', $id)->get();

		//dd($groupmaster);

		return view('groups.edit', compact('groupmaster'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
