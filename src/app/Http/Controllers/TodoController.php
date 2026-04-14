<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Deal;
use App\Models\Card;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ToDo一覧を取得
        $todos = Todo::with(['deal', 'card.company'])->orderBy('is_done')->orderBy('due_date')->get();
        return view('todos.index', Compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 商談と名刺の一覧を取得し、ToDo登録画面へ
        $deals = Deal::with('company')->orderBy('name')->get();
        $cards = Card::with('company')->orderBy('last_name')->get();
        return view('todos.create', compact('deals', 'cards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deal_id' => 'nullable|exists:deals,id',
            'card_id' => 'nullable|exists:cards,id',
            'due_date' => 'nullable|date',
        ]);

        Todo::create($validated);

        $redirect = $request->input('redirect');
        if ($redirect) {
            return redirect($redirect)->with('success', 'Todoを追加しました。');
        }

        return redirect()->route('todos.index')->with('success', 'Todoを追加しました。');
    }

    // ToDoの完了/未完了を切り替える
    public function toggle(Todo $todo)
    {
        $todo->update(['is_done' => !$todo->is_done]);
        return back();
    }

    // ToDoを削除する
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return back()->with('success', 'Todoを削除しました。');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        // 商談と名刺の一覧を取得し、ToDo編集画面へ
        $deals = Deal::with('company')->orderBy('name')->get();
        $cards = Card::with('company')->orderBy('last_name')->get();
        return view('todos.edit', compact('todo', 'deals', 'cards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // バリデーション
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deal_id' => 'nullable|exists:deals,id',
            'card_id' => 'nullable|exists:cards,id',
            'due_date' => 'nullable|date',
        ]);

        $todo->update($validated);
        return back()->with('success', 'Todoを更新しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return redirect()->route('todos.index');
    }
}
