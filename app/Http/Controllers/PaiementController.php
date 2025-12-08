<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class PaiementController extends Controller
{
    /**
     * Affiche la page de confirmation avant le paiement.
     */
    public function show(Contenu $contenu)
    {
        // Le prix est fixe à 1$ (100 centimes)
        $prix = 1.00;

        return view('paiement.show', [
            'contenu' => $contenu,
            'prix' => $prix,
        ]);
    }

    /**
     * Crée une session de paiement Stripe et redirige l'utilisateur.
     */
    public function process(Request $request, Contenu $contenu)
    {
        $user = Auth::user();
        Stripe::setApiKey(config('services.stripe.secret'));

        // Le prix est fixe à 1$ (100 centimes)
        $prixEnCentimes = 100;

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Accès au contenu : ' . $contenu->titre,
                        'description' => Str::limit($contenu->texte, 80),
                    ],
                    'unit_amount' => $prixEnCentimes,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/paiement/succes/{CHECKOUT_SESSION_ID}'),
            'cancel_url' => route('paiement.cancel'),
            'customer_email' => $user->email,
            'metadata' => [
                'user_id' => $user->getKey(),
                'contenu_id' => $contenu->getKey(),
            ]
        ]);

        return redirect($checkout_session->url);
    }

    /**
     * Gère le retour après un paiement réussi.
     */
    public function success(string $sessionId)
    {

        echo "<script>alert('Hey this is running')</script>";
       Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::retrieve($sessionId);

            $userId = $session->metadata['user_id'] ?? null;
            $contenuId = $session->metadata['contenu_id'] ?? null;

            // Ensure crucial metadata is present before proceeding
            if (!$userId || !$contenuId) {
                Log::error('Stripe webhook error: Missing user_id or contenu_id in session metadata.', ['session_id' => $sessionId]);
                return redirect()->route('accueil')
                    ->with('error', 'Une erreur est survenue lors de la validation de votre paiement (métadonnées manquantes).');
            }

            // Check if the payment already exists to prevent duplicates
            $existingPaiement = Paiement::where('reference_paiement', $session->id)->first();

            if ($existingPaiement) {
                // Payment already recorded, just inform the user.
                return redirect()->route('accueil')
                    ->with('info', 'Votre paiement a déjà été confirmé.');
            }

            // Use the Eloquent model to create the payment record
            Paiement::create([
                    'user_id' => $userId,
                    'contenu_id' => $contenuId,
                    'montant' => $session->amount_total / 100,
                    'reference_paiement' => $session->id,
                    'statut_paiement' => 'reussi',
            ]);

            // Rediriger vers la page d'accueil avec un message de succès
            return redirect()->route('accueil')
                ->with('success', 'Paiement réussi ! Vous avez maintenant accès au contenu.')
                ->with('show_alert', true); // Add this to trigger the JS alert

        } catch (\Exception $e) {
            Log::error('Paiement success error: ' . $e->getMessage(), ['session_id' => $sessionId]);
            return redirect()->route('accueil') // Redirect to home
                ->with('error', 'Une erreur est survenue lors de la confirmation du paiement.');
        }
    }

    /**
     * Gère l'annulation du paiement.
     */
    public function cancel()
    {
        return redirect()->route('accueil')
            ->with('info', 'Le processus de paiement a été annulé.');
    }
}
