<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\SellerStoreRequest;
use App\Http\Resources\v1\SellerResource;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $sellers = Seller::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return SellerResource::collection($sellers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SellerStoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            Seller::query()->create([
                'name' => $request->name,
            ]);
            DB::commit();
            $statusCode = Response::HTTP_CREATED;
            $response = [
                'message' => ['Vendedor cadastrado com sucesso.']
            ];
            return response()->json($response, $statusCode);

        }catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente cadastrar um VEndedor.']
            ];
            return response()->json($response, $statusCode);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seller = Seller::query()->where('id', $id)->first();
        if ($seller) return new SellerResource($seller);

        $statusCode = Response::HTTP_NOT_FOUND;
        $response = [
            'message' => ['Não existe vendedor com esse id']
        ];
        return  response()->json($response, $statusCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SellerStoreRequest $request, string $id)
    {
        $seller = Seller::query()->where('id', $id)->first();

        DB::beginTransaction();
        try {
            if($seller){
                $seller->update([
                    'name' => $request->name,
                ]);
                DB::commit();
                $statusCode = Response::HTTP_CREATED;
                $response = [
                    'message' => ['Vendedor atualizado com sucesso.']
                ];
                return response()->json($response, $statusCode);
            }
            $statusCode = Response::HTTP_NOT_FOUND;
            $response = [
                'message' => ['Vendedor não encontrado']
            ];
            return  response()->json($response, $statusCode);

        }catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente cadastrar um VEndedor.']
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
            $seller = Seller::query()->where('id', $id)->first();
            if($seller){
                DB::transaction(function() use ($seller) {
                    $seller->delete();
                });
                $statusCode = Response::HTTP_NO_CONTENT;
                $response = [
                    'message' => ['Vendendor deletado com sucesso']
                ];
                return  response()->json($response, $statusCode);
            }
            $statusCode = Response::HTTP_NOT_FOUND;
            $response = [
                'message' => ['Não existe vendendor com esse id']
            ];
            return  response()->json($response, $statusCode);

        }catch (\Throwable $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '::' . __FUNCTION__ . '=>' . $e->getMessage());
            $statusCode = Response::HTTP_BAD_REQUEST;
            $response = [
                'message' => ['Erro no servidor. Tente novamente deletar o vendedor.']
            ];
            return response()->json($response, $statusCode);
        }
    }
}
