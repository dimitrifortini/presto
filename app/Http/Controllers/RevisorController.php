<?php

namespace App\Http\Controllers;

use App\Http\Middleware\IsRevisor;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::where("is_accepted", null)->orderBy("created_at", "asc")->first();
        return view("revisor.index", compact("article_to_check"));
    }

    public function accept(Article $article)
    {
        $article->setAccepted(true);
        $article->revisor_id = auth()->id();
        $article->save();
        session()->put("revisor_can_undo",true);
        return redirect()->back()->with("message", "Hai accettato l'articolo $article->title");
    }

    public function reject(Article $article)
    {
        $article->setAccepted(false);
        $article->revisor_id = auth()->id();
        $article->save();
        session()->put("revisor_can_undo",true);

        return redirect()->back()->with("error_message", "Hai rifiutato l'articolo $article->title");
    }
    public function undo()
    {

        $article = Article::where("revisor_id", auth()->id())->whereNotNull("is_accepted")->latest("updated_at")->first();
        if ($article) {
            $article->setAccepted(null);
            $article->revisor_id = null;
            $article->save();
            session()->forget("revisor_can_undo");


            return redirect()->back()->with("message", "La revisione è stata annullata");
        }
    }

    public function becomeRevisor()
    {
        Mail::to("admin@presto.it")->send(new BecomeRevisor(Auth::user()));
        return redirect()->route("home")->with("message", "Complimenti,Hai richiesto di diventare revisore")->withFragment("revisorMessage");
    }

    public function makeRevisor(User $user)
    {
        Artisan::call("app:make-user-revisor", ["email" => $user->email]);
        return redirect()->back();
    }
}
