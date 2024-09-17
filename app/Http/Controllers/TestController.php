<?php

namespace App\Http\Controllers;

use App\Services\Test\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $TestService;

    public function __construct(TestService $TestService)
    {
        $this->TestService = $TestService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->TestService->getAll());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string',
            'username' => 'required|string',
            'email' => 'required|string|email:dns',
            'password' => 'required|string'
        ]);

        return response()->json($this->TestService->create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->TestService->findById($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'string',
            'username' => 'required|string',
            'email' => 'required|string|email:dns',
            'password' => 'required|string'
        ]);

        return response()->json($this->TestService->updateById($id, $validated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json($this->TestService->deleteById($id));
    }
}
