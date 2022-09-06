<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BalanceOperationIndexRequest;
use App\Http\Requests\Admin\BalanceOperationMinusRequest;
use App\Http\Requests\Admin\BalanceOperationPlusRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\BalanceOperation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class BalanceOperationController extends Controller
{

    public function index(BalanceOperationIndexRequest $request)
    {
        $balanceOperations = BalanceOperation::query()
            ->join('users','users.id','balance_operations.user_id')
            ->when($request->has('role_id'),function ($q){
                return $q->where('user_id',\request('user_id'));
            })
            ->when($request->has('search'),function ($q){
                return $q->where('users.name',"%".\request('search').'%');
            })
            ->with('user')
            ->latest('balance_operations.id')
            ->get();

        return response()->json($balanceOperations);
    }
    function plus(BalanceOperationPlusRequest $request)
    {

    }
    function minus(BalanceOperationMinusRequest $request)
    {

    }

}
