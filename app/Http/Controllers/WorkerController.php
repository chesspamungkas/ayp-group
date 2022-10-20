<?php

namespace App\Http\Controllers;

use App\Models\Worker;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index() 
    {
        $worker = Worker::with('employment')->get();
        return response()->json([ 
            'data' => [
                    'workers' => $worker
                ]
            ], 200);
    }

    public function add(request $request) {
        // Validation
        $this->validate($request, [
            'firstName' => 'required', 
            'lastName' => 'required',
            'email' => 'required|email'
        ]); 
        
        $worker = new Worker(); 
        $worker->firstName = $request->input('firstName');
        $worker->lastName = $request->input('lastName'); 
        $worker->email = $request->input('email');

        try {
            $worker->save();

            return response()->json([ 
                'data' => [
                    'id' => $worker->id
                ]
            ], 200);
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
