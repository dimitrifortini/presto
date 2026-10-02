<?php

namespace App\Http\Controllers;


use App\Models\Article;

use Illuminate\Support\Facades\Auth;
use App\Mail\BecomeRevisor;
use App\Mail\RejectReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class RevisorController extends Controller
{
    public function index()
    {
        $article_to_check = Article::where("is_accepted", null)->orderBy("created_at", "asc")->first();
        $reviews = $article_to_check ? $article_to_check->reviews : collect();
        return view("revisor.index", compact("article_to_check","reviews"));
    }

    public function accept(Article $article)
    {
        $article->setAccepted(true);
        $article->revisor_id = auth()->id();
        $article->save();
        session()->put("revisor_can_undo",true);
        return redirect()->back()->with("message", __("ui.article_accept").$article->title);
    }

    public function reject(Article $article,Request $request)
    {
        $reason=$request->reason;
        $article->setAccepted(false);
        $article->revisor_id = auth()->id();
        $article->save();
        Mail::to($article->user->email)->send(new RejectReason($article,$reason ));
        session()->put("revisor_can_undo",true);

        return redirect()->back()->with("error_message", __("ui.article_reject").$article->title);
    }
    public function undo()
    {

        $article = Article::where("revisor_id", auth()->id())->whereNotNull("is_accepted")->latest("updated_at")->first();
        if ($article) {
            $article->setAccepted(null);
            $article->revisor_id = null;
            $article->save();
            session()->forget("revisor_can_undo");


            return redirect()->back()->with("message", __("ui.revision_undo") );
        }
    }

    public function becomeRevisor()
    {
        Mail::to("admin@presto.it")->send(new BecomeRevisor(Auth::user()));
        return redirect()->route("home")->with("message",__("ui.reviewer_request") )->withFragment("revisorMessage");
    }

    public function makeRevisor(User $user)
    {
        Artisan::call("app:make-user-revisor", ["email" => $user->email]);
        return redirect()->back();
    }
}
