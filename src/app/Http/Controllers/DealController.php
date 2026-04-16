<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deal;
use App\Models\Company;
use App\Models\Card;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 商談一覧を取得
        $deals = Deal::with(['company', 'card'])->orderBy('status')->orderBy('close_date')->get();
        $grouped = $deals->groupBy('status');

        $statuses = [
            'lead' => 'リード',
            'proposal' => '提案中',
            'negotiation' => '商談中',
            'won' => '受注済み',
            'lost' => '失注',
        ];
        // ステータスごとの商談数と金額を計算
        $totalAmount = $deals->whereIn('status', ['lead', 'proposal', 'negotiation'])->sum('amount');
        return view('deals.index', compact('grouped', 'statuses', 'totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 会社と名刺の一覧取得し、商談登録画面へ
        $companies = Company::orderBy('name')->get();
        $cards = Card::with('company')->orderBy('last_name')->get();
        return view('deals.create', compact('companies', 'cards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'card_id' => 'nullable|exists:cards,id',
            'status' => 'required|in:lead,proposal,negotiation,won,lost',
            'amount' => 'nullable|integer|min:0',
            'progress' => 'nullable|integer|min:0|max:100',
            'close_date' => 'nullable|date',
            'memo' => 'nullable|string',
        ]);

        // ユーザーIDを追加
        $validated['user_id'] = auth()->id();
        
        // 商談を登録
        $deals = Deal::create($validated);
        return redirect()->route('deals.show', $deals)->with('success', '案件を登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        // 商談詳細を取得
        $deal->load(['company', 'card', 'todos']);
        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        // 会社と名刺の一覧を取得し、商談編集画面へ
        $companies = Company::orderBy('name')->get();
        $cards = Card::with('company')->orderBy('last_name')->get();
        return view('deals.edit', compact('deal', 'companies', 'cards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        // バリデーション
        $validated = $request->validate([
                        'name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'card_id' => 'nullable|exists:cards,id',
            'status' => 'required|in:lead,proposal,negotiation,won,lost',
            'amount' => 'nullable|integer|min:0',
            'progress' => 'nullable|integer|min:0|max:100',
            'close_date' => 'nullable|date',
            'memo' => 'nullable|string',
        ]);

        $deal->update($validated);
        return redirect()->route('deals.show', $deal)->with('success', '案件を更新しました。');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        // 商談を削除
        $deal->delete();
        return redirect()->route('deals.index')->with('success', '案件を削除しました。');
    }
}
