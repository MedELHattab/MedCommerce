<?php

namespace App\Repositories;


use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function all()
    {
        return Comment::all();
    }

    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function update(array $data, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
    }

    public function find($id)
    {
        return Comment::findOrFail($id);
    }
}