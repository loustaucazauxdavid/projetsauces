<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sauce;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SaucesController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion avec un message d'erreur.
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        $sauces = Sauce::latest()->where('userId', auth()->user()->id)->paginate(4);
        
        return view('web.sauces.index', compact('sauces'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function index_all()
    {
        $sauces = Sauce::latest()->paginate(4);
        
        return view('web.sauces.index_all', compact('sauces'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    public function create()
    {
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        return view('web.sauces.create');
    }

    public function store(Request $request)
    {
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'heat' => 'required|integer|min:1|max:10',
        ]);

        // Créer une nouvelle sauce avec les données du formulaire (hors image)
        $nouvelleSauce = Sauce::create($request->all() + ['userId' => auth()->user()->id]);

        // Si une image a été passée, la stocker et mettre à jour l'URL de l'image de la sauce
        if ($request->hasFile('image')) {    
            $this->handleSauceImage($request, $nouvelleSauce);
        }

        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce créée avec succès.');
    }

    public function show(string $id)
    {
        $sauce = Sauce::findOrFail($id);

        return view('web.sauces.show', compact('sauce'));
    }

    public function edit(string $id)
    {
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        $sauce = Sauce::findOrFail($id);

        // Vérifier si l'utilisateur connecté est le propriétaire de la sauce
        if ($sauce->userId != auth()->user()->id) {
            return redirect()->route('web.sauces.index')->withErrors(['error' => 'Vous n\'êtes pas autorisé à modifier cette sauce.']);
        }

        return view('web.sauces.edit', compact('sauce'));
    }

    public function update(Request $request, string $id)
    {
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        $sauce = Sauce::findOrFail($id);

        // Vérifier si l'utilisateur connecté est le propriétaire de la sauce
        if ($sauce->userId != auth()->user()->id) {
            return redirect()->route('web.sauces.index')->withErrors(['error' => 'Vous n\'êtes pas autorisé à modifier cette sauce.']);
        }

        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'mainPepper' => 'required',
            'heat' => 'required|integer|min:1|max:10',
        ]);

        // Mettre à jour la sauce avec les données du formulaire (hors image)
        $sauce->update($request->all() + ['userId' => auth()->user()->id]);

        // Si une image a été passée, la stocker et mettre à jour l'URL de l'image de la sauce
        if ($request->hasFile('image')) {    
            $this->handleSauceImage($request, $sauce);
        }

        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce mise à jour avec succès');
    }

    public function destroy(string $id)
    {
        if(!Auth::check()){ return redirect()->route('login')->withErrors(['error' => 'Vous devez être connecté pour effectuer cette action.']);}

        $sauce = Sauce::findOrFail($id);

        // Vérifier si l'utilisateur connecté est le propriétaire de la sauce
        if ($sauce->userId != auth()->user()->id) {
            return redirect()->route('web.sauces.index')->withErrors(['error' => 'Vous n\'êtes pas autorisé à supprimer cette sauce.']);
        }

        $sauce->delete();
        return redirect()->route('web.sauces.index')
                        ->with('success', 'Sauce supprimée avec succès');
    }

    private function handleSauceImage(Request $request, Sauce $sauce) {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $allowedExtensions = ['jpg', 'png'];

            if (in_array($extension, $allowedExtensions)) {
                $path = 'uploads/' . $sauce->id . '.' . $extension;

                Storage::disk('public')->put($path,  File::get($file));
                $sauce->update(['imageUrl' => $path]);
            }    
            else {
                return redirect()->back()->withErrors(['image' => 'Type de fichier non autorisé. Fichiers autorisés : jpg, png.']);  
            }
        }
    }

}