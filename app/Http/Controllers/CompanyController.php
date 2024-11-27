<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();

        try {
                $postCompany = Company::create([
                    'company_name' => $request->company_name, 
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'created_by' => Auth::id()
                ]);

               $faker = Faker::create();

               $user = User::create([
                   'name' => $faker->name,
                   'email' => $faker->unique()->safeEmail,
                   'password' => bcrypt('password123'), // Default password
               ]);
   
               // Hubungkan user dengan manager
               $user->manager()->create([
                   'fullname' => $faker->name, 
                   'address' => $faker->address, 
                   'company_id' => $postCompany->id,
               ]);
   
               // Assign role manager ke user
               $user->assignRole('manager');
   
               DB::commit(); 
   
               return response()->json([
                   'message' => 'Company and Manager created successfully!',
                   'company' => $postCompany,
                   'manager' => $user,
               ], 201);

        } catch (\Exception $e) {
            DB::rollback(); // Rollback jika terjadi error

            return response()->json([
                'message' => 'Failed to create company or manager!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try{
            $company = Company::findOrFail($id);
            $company->delete();
            DB::commit();
            return response()->json([
                'message' => 'Company successfully deleted!',
                'data' => $company
            ], 201);
        } catch (\Exception $e) {
            DB::rollback(); 

            return response()->json([
                'message' => 'Failed to deleted company!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
