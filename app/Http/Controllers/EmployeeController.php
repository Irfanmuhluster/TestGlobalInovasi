<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function __construct(
        protected Employee $employee,
        protected User $user
    )
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
            $employee = $this->employee->query()
            ->search()
            ->when($request->has("sort"), function ($query) use ($request) {
                $sort_type = "desc";
                if ($request->has("type")) {
                    $sort_type = $request->direction == "desc" ? "asc" : "desc";
                }

                if ($request->sort == 'created_at') {
                    return $query->orderBy("created_at",$sort_type);
                }
            })
            ->paginate($request->limit > 0 ? $request->limit : 15);
            return response()->json([
                'message' => 'Success ',
                'data' => $employee
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to show employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
        DB::beginTransaction();
        try{
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password)
            ]);
            
            $employee = $user->employee()->create([
                'fullname' => $request->fullname, 
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'manager_id' => $user->id
            ]);
            $user->assignRole('employee');

            DB::commit(); 
   
            return response()->json([
                'message' => 'Employee created successfully!',
                'data' => $employee
            ], 201);

        }  catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to store employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, $id)
    {
        //
        try{
            $employee = $this->employee->query()
            ->findOrFail($id);

            return response()->json([
                'message' => 'Success show detail employee',
                'data' => $employee
            ], 201);
        }  catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to show detail employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        DB::beginTransaction();
        try{
            
            $employee = $this->employee->find($request->id);
            $employee->fullname = $request->fullname;
            $employee->phone_number = $request->phone_number;
            $employee->address = $request->address;
            $employee->manager_id = $request->manager_id;
            $employee->save();
            DB::commit(); 
   
            return response()->json([
                'message' => 'Employee updated successfully!',
                'data' => $employee
            ], 201);

        }  catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to updated employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try{
            $employee = $this->employee->findOrFail($id);
            $employee->delete();
            DB::commit();
            return response()->json([
                'message' => 'Employee successfully deleted!',
                'data' => $employee
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to deleted employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
