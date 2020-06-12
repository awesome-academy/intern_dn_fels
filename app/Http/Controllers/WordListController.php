<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordListController extends Controller
{
    /** @var \App\Repositories\WordRepository */
    protected $repository;

    public function __construct(\App\Repositories\WordRepository $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

    /**
     * Get all words in user's word list
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // get sorting criteria and order
        $sort = $request->input('sort');
        $order = $request->session()->get('sortOrder', 'desc');

        $filters = [
            'word' => $request->input('word-filter'),
            'category' => $request->input('category-filter'),
            'status' => $request->input('status-filter'),
        ];

        $wordHistories = $this->repository->getHistory($user, $sort, $order, $filters);

        return view('application.wordlist', [
            'histories' => $wordHistories
        ]);
    }
}
