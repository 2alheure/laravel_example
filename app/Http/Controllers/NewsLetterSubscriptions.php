<?php

namespace App\Http\Controllers;

use App\Models\NewsLetterSubscriptions as ModelsNewsLetterSubscriptions;
use Illuminate\Http\Request;

class NewsLetterSubscriptions extends Controller {
    function subscribe(Request $request) {
        // On vérifie les infos saisies par l'utilisateur
        // Si erreur, automatiquement renvoyé vers page précédente (formulaire)
        $validated = $this->validate($request, [
            'email' => 'email|required|max:255|unique:App\Models\NewsLetterSubscriptions,email',
            'firstname' => 'max:255',
            'lastname' => 'max:255',
        ]);

        $validated['token'] = hash('sha256', random_bytes(32)); // On crée un token aléatoire

        // On crée notre souscription
        ModelsNewsLetterSubscriptions::create($validated);

        // On notifie
        $request->session()->flash('success', 'You subscribed to my awesome newsletter !');
        // On redirige
        return redirect()->back();
    }

    function unsubscribe(string $token, Request $request) {
        // On crée notre souscription
        ModelsNewsLetterSubscriptions::where('token', $token)->delete();
        // On notifie
        $request->session()->flash('success', 'You\'re now unsubscribed.');
        // On redirige
        return redirect()->route('home');
    }
}
