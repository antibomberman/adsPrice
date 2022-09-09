<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BalanceOperationIndexRequest;
use App\Http\Requests\Admin\BalanceOperationMinusRequest;
use App\Http\Requests\Admin\BalanceOperationPlusRequest;
use App\Models\BalanceOperation;
use App\Models\User;

class BalanceOperationController extends Controller
{
    public function index(BalanceOperationIndexRequest $request)
    {
        $balanceOperations = BalanceOperation::query()
            ->when($request->has('user_id'), function ($q) {
                return $q->where('user_id', \request('user_id'));
            })
            ->with('user')
            ->latest('balance_operations.id')
            ->get();

        return response()->json($balanceOperations);
    }

    public function plus(BalanceOperationPlusRequest $request)
    {
        $user = User::findOrFail($request->get('user_id'));
        $user->balance += $request->get('value');
        $user->save();

        $balanceOperation = BalanceOperation::create([
            'user_id' => $user->id,
            'operation' => 'plus',
            'balance' => $user->balance,
            'value' => $request->get('value'),
        ]);

        return response()->json($balanceOperation);
    }

    public function minus(BalanceOperationMinusRequest $request)
    {
        $user = User::findOrFail($request->get('user_id'));
        $user->balance -= $request->get('value');
        $user->save();

        $balanceOperation = BalanceOperation::create([
            'user_id' => $user->id,
            'operation' => 'minus',
            'balance' => $user->balance,
            'value' => $request->get('value'),
        ]);

        return response()->json($balanceOperation);
    }
}
