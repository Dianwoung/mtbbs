<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Link;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, Link $link, User $user)
    {
        $order = $request->order;
        $sticky = $topic->where([
            ['category_id' , '=', $category->id ],
            ['sticky'      ,'=' , '1'],
            ['is_publish', '=' , '1'],
        ])->get();
        $topics = $topic->withOrder($request->order)
            ->where([['category_id' , '=', $category->id ],['sticky', '=', '0'], ['is_publish' , '=' , '1']])
                    ->paginate(20);
        $links = $link->getAllCached();
        $active_users = $user->getActiveUsers();
        return view('topics.index',compact('topics','category','links', 'active_users','sticky', 'order'));
    }
}
