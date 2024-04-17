<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;

use App\Services\CommentService;

class CommentController extends Controller
{

    public function __construct(
        protected CommentService $commentService
    ) {
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'comment' => 'required',
            'product_id' => 'required',
        ]);

        $data['user_id'] = auth()->id();


        $comment = $this->commentService->create($data);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->commentService->delete($id); 

        return redirect()->back();
    }
}
