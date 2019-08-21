<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\UserHistoryVideoModel;
use App\Traits\DndbQuery;

class UserHistoryVideoController extends Controller
{
    // Include Trait inside Controller
    use DndbQuery;

    /**
     * @param UserHistoryVideoModel $model
     * @param Request $request
     */
    public function index(UserHistoryVideoModel $model, Request $request)
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
            'user_id'   => 'required',
            'video_id'  => 'required',
        ]);

        $user_id    = $request->input('user_id');
        $video_id   = $request->input('video_id');
        $last_watch = $request->input('last_watch') ?? null;

        $query              = new UserHistoryVideoModel();
        $query->id          = Str::uuid()->toString();
        $query->user_id     = $user_id;
        $query->video_id    = $video_id;
        $query->last_watch  = $last_watch;
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

    public function show(UserHistoryVideoModel $model, string $id)
    {
        return $model->findOrFail($id);
    }

    public function search(UserHistoryVideoModel $model, Request $request)
    {
        $this->validate($request, [
            'query' => 'required',
        ]);

        $query = $request->input('query');

        // Parse Function From Trait DndbQuery
        $query_eloquent = $this->ReqParse($query);

        // Improve Query Builder Search
        $query = null;
        foreach($query_eloquent as $key => $value) {
            $query = $model->where($key, 'contains', $value);
        }

        // Performe Query
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

    public function update(UserHistoryVideoModel $model, Request $request, string $id)
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

    public function delete(UserHistoryVideoModel $model, string $id)
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