<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\BudgetStoreRequest;
use App\Http\Resources\v1\BudgetResource;
use App\Models\Budget;
use App\Models\Seller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $budgets = Budget::query()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return BudgetResource::collection($budgets);
    }

    /**
     * Store a newly created resource in storage.
     * @param BudgetStoreRequest $request
     * @return JsonResponse
     */
    public function store(BudgetStoreRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                Budget::query()->create([
                    'client' => $request->client,
                    'description' => $request->description,
                    'price' => $request->price,
                    'seller_id' => $request->seller_id
                ]);
            });
            $statusCode = Response::HTTP_CREATED;
            $response = [
                'message' => ['Orçamento criado com sucesso']
            ];
            return response()->json($response, $statusCode);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente cadastrar um Orçamento.']
            ];
            return response()->json($response, $statusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $budget = Budget::query()->where('id', $id)->first();
        if ($budget) return new BudgetResource($budget);

        $statusCode = Response::HTTP_NOT_FOUND;
        $response = [
            'message' => ['Não existe orçamento com esse id']
        ];
        return response()->json($response, $statusCode);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(BudgetStoreRequest $request, string $id): JsonResponse
    {
        try {
            $budget = Budget::query()->where('id', $id)->first();
            if ($budget) {
                DB::transaction(function () use ($request, $budget) {
                    $budget->update([
                        'client' => $request->client,
                        'description' => $request->description,
                        'price' => $request->price,
                        'seller_id' => $request->seller_id
                    ]);
                });
                $statusCode = Response::HTTP_OK;
                $response = [
                    'message' => ['Orçamento atualizado com sucesso']
                ];
                return response()->json($response, $statusCode);
            }
            $statusCode = Response::HTTP_NOT_FOUND;
            $response = [
                'message' => ['Não orçamento com esse id']
            ];
            return response()->json($response, $statusCode);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente atualizar o Orçamento.']
            ];
            return response()->json($response, $statusCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $budget = Budget::query()->where('id', $id)->first();
            if ($budget) {
                DB::transaction(function () use ($budget) {
                    $budget->delete();
                });
                $statusCode = Response::HTTP_NO_CONTENT;
                $response = [
                    'message' => ['Orçamento deletado com sucesso']
                ];
                return response()->json($response, $statusCode);
            }
            $statusCode = Response::HTTP_NOT_FOUND;
            $response = [
                'message' => ['Não existe orçamento com esse id']
            ];
            return response()->json($response, $statusCode);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente deletar o Orçamento.']
            ];
            return response()->json($response, $statusCode);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('budget');
        $seller = Seller::query()->where('name', 'LIKE', '%' . $search . '%')->get();

        try {
//            $budget = Budget::query()
//                ->where('client', 'LIKE', '%'.$search. '%')
//                ->get();
//            if ($seller->count() > 0) {
//                $budgets = Budget::query();
                    //                ->with('seller')->where('name', 'LIKE', '%'.$search.'%')
//                    ->where('client', 'LIKE', '%' . $search . '%')
//                    ->orWhereBetween('created_at', ['2023-04-01', '2023-04-13'])
//                    ->orderBy('created_at', 'DESC')
//                    ->orWhere('seller_id', 'LIKE', '%' . $seller[0]->id . '%')
//                    ->orderBy('created_at', 'DECS')

                    //                ->whereHas('seller', function ($query) use ($search) {
                    //                    $query->where('name', 'LIKE', '%'.$search.'%');
                    //                })
//                    ->get();
//                return BudgetResource::collection($budgets);
//            }
            $query = Budget::query();
//                ->orWhere('client', 'LIKE', '%' . $search . '%')
//                ->orderBy('created_at', 'DESC')
//                ->get();
            $query->when($request->filled('budget'), function ($q) use ($request) {
                $q->where('client', 'LIKE', '%' . $request->input('budget') . '%');
            });
            if ($seller->count() > 0) {
                $query->when($request->filled('budget'), function ($q) use ($seller) {
                    $q->orWhere('seller_id', 'LIKE',  $seller[0]->id );
                });
            }
            $query->when($request->filled('start_date') &&  $request->filled('end_date'), function ($q) use ($request) {
                $q->whereBetween('created_at', [
                    Carbon::parse($request->input('start_date'))->format('Y-m-d'),
                    Carbon::parse($request->input('end_date'))->format('Y-m-d')
                ]);
//                dd($q->get());
            });

            $budgets = $query->orderBy('created_at', 'DESC')->paginate(2);

            return BudgetResource::collection($budgets);

        } catch (\Throwable $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente pesquisar mais tarde.']
            ];
            return response()->json($response, $statusCode);
        }
    }

    public function searchDate(Request $request)
    {
        try {
            $startDate = Carbon::parse($request->input('start_date'))->format('Y-m-d');
            $endDate = Carbon::parse($request->input('end_date'))->format('Y-m-d');
            $budgets = Budget::query()
                ->orWhereBetween('created_at', [$startDate, $endDate])
                ->get();
            return BudgetResource::collection($budgets);
        } catch (\Throwable $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente pesquisar mais tarde.']
            ];
            return response()->json($response, $statusCode);
        }
    }
}
