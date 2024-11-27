<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function __construct(
        protected Manager $manager
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
            
            $manager = $this->manager->query()
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
                'data' => $manager
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to show employee!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager, $id)
    {
        //
        try{
            $manager = $this->manager->query()
            ->findOrFail($id);

            return response()->json([
                'message' => 'Success show detail manager',
                'data' => $manager
            ], 201);
        }  catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to show detail manager!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        DB::beginTransaction();
        try{
            
            $manager = $this->manager->find($id);
            $manager->fullname = $request->fullname;
            $manager->address = $request->address;
            $manager->save();
            DB::commit(); 
   
            return response()->json([
                'message' => 'Manager updated successfully!',
                'data' => $manager
            ], 201);

        }  catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to updated manager!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
        DB::beginTransaction();
        try{
            $manager = $this->manager->findOrFail($id);
            $manager->delete();
            DB::commit();
            return response()->json([
                'message' => 'Manager successfully deleted!',
                'data' => $manager
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to deleted manager!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
