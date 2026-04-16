<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Company;


class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 名刺一覧取得
        $cards = Card::with('company')->latest()->get();
        return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 名刺登録画面を表示
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name_kana' => 'nullable|string|max:50',
            'first_name_kana' => 'nullable|string|max:50',
            'company_id' => 'required|exists:companies,id',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'memo' => 'nullable|string',
        ]);
        
        // ユーザーIDを追加
        $validated['user_id'] = auth()->id();
        
        $card = Card::create($validated);

        return redirect()->route('cards.show', $card)->with('success', '名刺を登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        // 名刺詳細を取得
        $card->load(['company', 'deals.company', 'todos']);
        return view('cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        // 権限チェック
        if ($card->user_id !== auth()->id()) {
            abort(403, '権限がありません');
        }
        // 会社一覧を取得し、名刺編集画面へ
        $companies = Company::orderBy('name')->get();
        return view('cards.edit', compact('card', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        // 権限チェック
        if ($card->user_id !== auth()->id()) {
            abort(403, '権限がありません');
        }
        
        // バリデーション
        $validated = $request->validate([
            'last_name' => 'required|string|max:50',
            'first_name' => 'required|string|max:50',
            'last_name_kana' => 'nullable|string|max:50',
            'first_name_kana' => 'nullable|string|max:50',
            'company_id' => 'required|exists:companies,id',
            'department' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'memo' => 'nullable|string',
        ]);

        $card->update($validated);
        return redirect()->route('cards.show', $card)->with('success', '名刺を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        // 権限チェック
        if ($card->user_id !== auth()->id()) {
            abort(403, '権限がありません');
        }
        
        $company = $card->company;
        $card->delete();
        return redirect()->route('companies.show', $company)->with('success', '名刺を削除しました。');
    }
}
