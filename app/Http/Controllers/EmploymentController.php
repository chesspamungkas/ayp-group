<?php

namespace App\Http\Controllers;

use App\Models\Employment;

use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function add(request $request) { 
        // Validation
        $this->validate($request, [
            'workerEmail' => 'required|email',
            'companyName' => 'required',
            'jobTitle' => 'required',
            'startDate' => 'required|date_format:Y-m-d'
        ]); 
        
        $employment = new Employment();
        $employment->workerEmail = $request->input('workerEmail');
        $employment->companyName = $request->input('companyName');
        $employment->jobTitle = $request->input('jobTitle');
        $employment->startDate = $request->input('startDate');

        $active = Employment::whereNull('endDate')
                    ->where('workerEmail', '=', $employment->workerEmail)
                    ->get();
        $activeCount = $active->count();

        try {
            if ($activeCount==0) {
                $employment->save();
                return response()->json([ 
                    'data' => [
                        'id' => $employment->id
                    ]
                ], 200);
            } else {
                return response()->json([
                    'error' => [ 
                        'code' => 403.1, 
                        'name' => 'Forbidden', 
                        'message' => 'The worker has active employment'
                    ]
                ], 201); 
            }
        } 
        catch (\Throwable $th) {
            return response()->json([
                'error' => [ 
                    'code' => 403, 
                    'name' => 'Forbidden', 
                    'message' => 'Forbidden'
                ]
            ], 201); 
        }
    }

    public function update(request $request) {
        // Validation
        $this->validate($request, [
            'workerEmploymentId' => 'required|integer',
            'endDate' => 'required|date_format:Y-m-d|after_or_equal:startDate'
        ]); 

        $employment = new Employment();
        $employment->id = $request->input('workerEmploymentId');
        $employment->endDate = $request->input('endDate');
       
        $active = Employment::join('worker', 'employment.workerEmail', '=', 'worker.email')->select('worker.id as workerEmploymentId, employment.endDate')
                    ->whereNull('employment.endDate')
                    ->where('worker.id', $employment->id);
        $activeCount = $active->count();

        try {
            if ($activeCount==1) {
                $active->update(['endDate'=>$employment->endDate]);
                return response()->json([ 
                    'data' => [
                        'id' => $employment->id
                    ]
                ], 200);
            } else {
                return response()->json([
                    'error' => [ 
                        'code' => 403.1, 
                        'name' => 'Forbidden', 
                        'message' => 'The worker not found or not active in any employment'
                    ]
                ], 201); 
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [ 
                    'code' => 403, 
                    'name' => 'Forbidden', 
                    'message' => 'Forbidden'
                ]
            ], 201); 
        }
    }
}
