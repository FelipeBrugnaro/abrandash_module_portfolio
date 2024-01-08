<?php

namespace Modules\Portfolio\app\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Modules\Portfolio\app\Models\Portfolio;
use Modules\Portfolio\app\Http\Requests\{
    PortfolioUpdateRequest,
    PortfolioStoreRequest
};
use Illuminate\Http\{Request, RedirectResponse};

class PortfolioController
{

    public function index(Request $request, Portfolio $portfolio)
    {

        $search = $request->search;
        $qnt = $request->qnt ?? 10;

        $portfolios = $portfolio->where([
            ['title', 'like','%'.$search.'%'],
        ])->orderBy('id', 'ASC')->paginate($qnt)->withQueryString();
        
        return view('portfolio::index', [
            'portfolios' => $portfolios
        ]);
    }

    public function edit(Portfolio $portfolio)
    {
        if(!Auth::user()->permission('EDIT_PORTFOLIO')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('portfolio::edit', [
            'portfolio' => $portfolio
        ]);
    }

    public function create()
    {
        if(!Auth::user()->permission('CREATE_PORTFOLIO')){
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('action_not_permitted', 'messages')
            ]); 
        }

        return view('portfolio::create');
    }

    // STORE

    public function store(
        PortfolioStoreRequest $request, 
        Portfolio $portfolio
    ) : RedirectResponse 
    {

        $image = $request->file('image');
        
        if($image) {
            $upload = imageUploader($image);
            $portfolio->image = $upload;
        }

        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->body = $request->body;
        $portfolio->status = false;

        if(!$portfolio->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('create_danger', 'portfolio::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('portfolio.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('create_success', 'portfolio::lang.messages')
        ]);
    }

    // UPDATE

    public function update(
        PortfolioUpdateRequest $request, 
        Portfolio $portfolio
    ) : RedirectResponse 
    {

        $image = $request->file('image');

        if($image) {
            $upload = imageUploader($image);
            $portfolio->image = $upload ? $upload : $portfolio->image;
        }

        $portfolio->title = $request->title ?? $portfolio->title;
        $portfolio->description = $request->description ?? $portfolio->description;
        $portfolio->body = $request->body ?? $portfolio->body;
        $portfolio->status = $request->status ?? $portfolio->status;

        if(!$portfolio->save()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('toast', [
                    'level'   => 'warning',
                    'message' => textLang('update_danger', 'portfolio::lang.messages')
            ]);
        }

        return redirect()
            ->route(config('portfolio.routes.index'))
            ->with('toast', [
                'level'   => 'success',
                'message' => textLang('update_success', 'portfolio::lang.messages')
        ]);
    }

    // DELETE
    
    public function destroy(Portfolio $portfolio): RedirectResponse 
    {
        
        if(!$portfolio->delete()) {
            return redirect()
                ->back()
                ->with(['toast' => [
                    'level'   => 'danger',
                    'message' => textLang('delete_danger', 'portfolio::lang.messages')
            ]]);
        }

        return redirect()
            ->back()
            ->with(['toast' => [
                'level'   => 'success',
                'message' => textLang('delete_success', 'portfolio::lang.messages')
        ]]);
    }
}
