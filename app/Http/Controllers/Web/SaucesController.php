<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sauce;

class SaucesController extends Controller
{
    public function index()
    {
        $sauces = Sauce::latest()->paginate(4);
        return view('web.sauces.index', compact('sauces'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function create()
    {
        return view('web.sauces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'imageUrl' => 'required',
            'heat' => 'required|integer|min:1|max:10',
        ]);

        Sauce::create($request->all());
        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce created successfully.');
    }

    public function show(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('web.sauces.show', compact('sauce'));
    }

    public function edit(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('web.sauces.edit', compact('sauce'));
    }

    public function update(Request $request, string $id)
    {
        $sauce = Sauce::findOrFail($id);
        $request->validate([
            'userId' => 'required',
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'imageUrl' => 'required',
            'heat' => 'required|integer|min:1|max:10',
        ]);

        $sauce->update($request->all());
        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce updated successfully');
    }

    public function destroy(string $id)
    {
        $sauce = Sauce::findOrFail($id);
        $sauce->delete();
        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce deleted successfully');
    }
}
