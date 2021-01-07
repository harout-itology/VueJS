<?php

namespace App\Http\Controllers;

use App\TemplateLog;
use Illuminate\Http\Request;
use App\Http\Resources\DatatableResource;
use Carbon\Carbon;


class TemplateLogController extends Controller
{

    public function index()
    {
        $query = TemplateLog::orderBy(request('column'), request('dir'));    

        if(request('username'))
            $query->where('username', 'like', '%'.request('username').'%');
        if(request('recipientNumber'))
            $query->where('recipient_number', 'like', '%'.request('recipientNumber').'%');
        if($dateRange = json_decode(request('dateRange'), true))
            $query->whereBetween('created_at', 
                [Carbon::parse($dateRange['startDate'])->startOfDay()->format(dateFormat()), 
                Carbon::parse($dateRange['endDate'])->endOfDay()->format(dateFormat())]
            );

        return new DatatableResource($query->paginate(request('length')));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
