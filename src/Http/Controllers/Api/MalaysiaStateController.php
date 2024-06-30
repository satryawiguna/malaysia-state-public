<?php

namespace FreshCMS\MalaysiaState\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use FreshCMS\MalaysiaState\Models\MalaysiaState;
use Illuminate\Http\Request;

class MalaysiaStateController extends Controller
{
    public function list(Request $request)
    {
        $query = MalaysiaState::query();
        $orderBy = 'id';
        $sort = 'asc';

        if ($request->has('order_by')) {
            $orderBy = $request->order_by;
        }
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $sort = $request->sort;
        }

        $query->orderBy($orderBy, $sort);

        return response()->json($query->get());
    }

    public function search(Request $request)
    {
        $query = MalaysiaState::query();
        $orderBy = 'id';
        $sort = 'asc';

        if ($request->has('search')) {
            $query->whereRaw('(location LIKE ? OR post_office LIKE ? OR postcode LIKE ? OR state LIKE ?)', $this->searchByKeyword($request->search));
        }
        if ($request->has('order_by')) {
            $orderBy = $request->order_by;
        }
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $sort = $request->sort;
        }

        $query->orderBy($orderBy, $sort);

        return response()->json($query->get());
    }

    public function pagination(Request $request)
    {
        $query = MalaysiaState::query();
        $orderBy = 'id';
        $sort = 'asc';
        $page = 1;
        $perPage = 10;

        if ($request->has('search')) {
            $query->whereRaw('(location LIKE ? OR post_office LIKE ? OR postcode LIKE ? OR state LIKE ?)', $this->searchByKeyword($request->search));
        }
        if ($request->has('order_by')) {
            $orderBy = $request->order_by;
        }
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $sort = $request->sort;
        }
        if ($request->has('page')) {
            $page = $request->page;
        }
        if ($request->has('per_page')) {
            $perPage = $request->per_page;
        }

        $query->orderBy($orderBy, $sort);

        return response()->json($query
            ->paginate($perPage, ['*'], 'page', $page));
    }

    public function searchByKeyword(string $search) {
        return [
            'location' => '%' . $search . '%',
            'post_office' => '%' . $search . '%',
            'postcode' => '%' . $search . '%',
            'state' => '%' . $search . '%'
        ];
    }
}
