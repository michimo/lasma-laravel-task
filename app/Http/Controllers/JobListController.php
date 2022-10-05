<?php

namespace App\Http\Controllers;

use App\Models\job_list;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_list = job_list::all()->where('done', false)->where('end_date', '>', now());
        $done_job_list_count = job_list::all()->where('done', true)->count();

        return view('list.main', compact('job_list', 'done_job_list_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
             'title' => ['required', 'string', 'min:15'],
             'end_date' => ['required', 'date'],
             'comment' => ['nullable', 'string']
        ]);

        $end_date_timestamp = strtotime($data['end_date']);
        $end_date = date("Y-m-d", $end_date_timestamp);
        $data['end_date'] = $end_date;

        job_list::create($data);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\job_list  $job_list
     * @return \Illuminate\Http\Response
     */
    public function edit(job_list $job_list, $id)
    {
        $job = job_list::find($id);
        return view('list.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\job_list  $job_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, job_list $job_list, $id)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:15'],
            'end_date' => ['required', 'date'],
            'comment' => ['nullable', 'string']
        ]);

        $end_date_timestamp = strtotime($data['end_date']);
        $end_date = date("Y-m-d", $end_date_timestamp);
        $data['end_date'] = $end_date;

        $existing_list_item = job_list::find($id);
        $existing_list_item->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\job_list  $job_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(job_list $job_list)
    {
        $job_list->delete();
        return back();
    }

    /**
     * Finish job.
     *
     * @param  \App\Models\job_list  $job_list
     * @return \Illuminate\Http\Response
     */
    public function done(job_list $job_list)
    {
        $job_list['done'] = true;
        $job_list->save();

        return back();
    }
}
