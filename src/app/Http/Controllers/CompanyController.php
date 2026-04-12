<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 会社一覧取得（名刺数、商談件数も同時に取得）
        $companies = Company::withCount(['cards', 'deals'])->orderBy('name')->get();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'memo' => 'nullable|string',
        ]);

        // 会社作成
        $company = Company::create($validated);
        return redirect()->route('companies.show', $company)->with('success', '会社を登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // 会社詳細を取得
        $company->load(['cards', 'deals']);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // 会社情報を取得し、編集画面へ
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'memo' => 'nullable|string',
        ]);

        // 会社情報を更新
        $company->update($validated);
        return redirect()->route('companies.show', $company)->with('success', '会社情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // 会社を削除
        $company->delete();
        return redirect()->route('companies.index')->with('success', '会社を削除しました。');
    }
}
