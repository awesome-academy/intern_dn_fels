<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserWord;
use App\Models\Word;
use Illuminate\Support\Facades\DB;

class WordRepository
{
    /**
     * Get all word associated with given users
     */
    public function getHistory($user, $sort = '', $order = 'asc', $filters = null)
    {
        $order = ($order == 'desc') ? 'desc' : 'asc';

        $query = UserWord::with('word')
            ->where('user_id', $user->id)
            ->join('words', 'user_word.word_id', '=', 'words.id')
            ->join('categories', 'words.category_id', '=', 'categories.id');

        // sorting
        if ($sort == 'category') {
            $query = $query->orderBy('categories.name', $order);
        } else if ($sort == 'status') {
            $query = $query->orderBy('status', $order);
        } else {
            $query = $query->orderBy('words.value', $order);
        }

        // filtering
        if (!empty($filters)) {
            if (!empty($filters['word'])) {
                $keyword = $this->buildFilterString($filters['word']);
                $query = $query->where('words.value', 'like', $keyword);
            }
            if (!empty($filters['category'])) {
                $keyword = $this->buildFilterString($filters['category']);
                $query = $query->where('categories.name', 'like', $keyword);
            }
            if (!empty($filters['status'])) {
                $query = $query->whereIn('status', $filters['status']);
            }
        }

        return $query->paginate(10);
    }

    private function buildFilterString($keyword)
    {
        return '%' . $keyword . '%';
    }

    /**
     * Get all words that given user has memorised
     */
    public function getLearnedWord(User $user)
    {
        $words = $user->words()
            ->wherePivot('status', 'learned')
            ->get();

        return $words;
    }
}
