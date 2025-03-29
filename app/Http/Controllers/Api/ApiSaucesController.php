<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sauce;

class ApiSaucesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère toutes les sauces de la base de données
        $sauces = Sauce::all()->where('userId', auth()->user()->id);

        // Retourne la réponse JSON avec la liste des sauces et le code de statut 200
        return response()->json([
            'sauces' => $sauces,
        ], Response::HTTP_OK);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'heat' => 'required|integer|min:1|max:10',
            'imageUrl' => 'required|string'
        ]);

        $sauce = Sauce::create([
            'name' => $request->name,
            'manufacturer' => $request->manufacturer,
            'description' => $request->description,
            'mainPepper' => $request->mainPepper,
            'imageUrl' => $request->imageUrl,
            'heat' => $request->heat,
            'likes' => 0,
            'dislikes' => 0,
            'userId' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Sauce créée avec succès',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sauce = Sauce::findOrFail($id);

        return response()->json(['sauce' => $sauce]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sauce = Sauce::findOrFail($id);

        if ($sauce->userId != auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], Response::HTTP_FORBIDDEN);
        }

        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'heat' => 'required|integer|min:1|max:10',
            'imageUrl' => 'required|string'
        ]);

        $sauce->update($request->all());

        return response()->json([
            'message' => 'Sauce mise à jour avec succès'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sauce = Sauce::findOrFail($id);

        if ($sauce->userId != auth()->user()->id) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        }
               
        $success = $sauce->delete();

        return response()->json([
            'message' => 
            $success ? 'Sauce supprimée avec succès' : 'Echec de la suppression de la sauce',
        ]);
    }
}
