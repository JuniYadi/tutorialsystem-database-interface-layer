<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\UserFollowerModel;
use App\Traits\DndbQuery;

class UserFollowerController extends Controller
{
    // Include Trait inside Controller
    use DndbQuery;

    /**
     * @param UserFollowerModel $model
     * @param Request $request
     */
    public function index(UserFollowerModel $model, Request $request)
    {
        $count = $model->count();

        if($count == 0) {
            $message    = ', no data found with this query';
            $result     = [];
        } else {
            $message    = ', data has been found';
            $result     = $model->all();
        }

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'index list query has been performed'. $message,
                'total'     => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'           => 'required',
            'follower_user_id'  => 'required',
        ]);

        $user_id            = $request->input('user_id');
        $follower_user_id   = $request->input('follower_user_id');

        $query                      = new UserFollowerModel();
        $query->id                  = Str::uuid()->toString();
        $query->user_id             = $user_id;
        $query->follower_user_id    = $follower_user_id;
        $query->save();

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been saved',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function show(UserFollowerModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function search(UserFollowerModel $model, Request $request)
    {
        $this->validate($request, [
            'query' => 'required',
        ]);

        $query = $request->input('query');

        // Parse Function From Trait DndbQuery
        $query_eloquent = $this->ReqParse($query);

        // Performe Query
        $query = $model->where($query_eloquent);
        $count = $query->count();

        if($count == 0) {
            $message    = ', no data found with this query';
            $result     = [];
        } else {
            $message    = ', data has been found';
            $result     = $query->get();
        }

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'search query has been performed'. $message,
                'total'     => $count,
            ],
            'result' => $result,
        ], 200);
    }

    public function update(UserFollowerModel $model, Request $request, string $id)
    {
        $query = $model->findOrFail($id);
        $query->update($request->all());

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been updated',
            ],
            'result' => [
                'id' => $query->id,
            ],
        ], 200);
    }

    public function delete(UserFollowerModel $model, string $id)
    {
        $query = $model->findOrFail($id);
        $query->delete();

        return response()->json([
            'status' => [
                'code'      => '200',
                'message'   => 'data has been deleted',
            ],
        ], 200);
    }
}