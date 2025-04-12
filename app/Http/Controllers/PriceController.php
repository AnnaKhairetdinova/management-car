<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\JsonResponse;

class PriceController extends Controller
{
    /**
     * Список цен
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $prices = Price::all();

        return response()->json($prices);
    }

    /**
     * Создание цены
     *
     * @param PriceRequest $request
     * @return JsonResponse
     */
    public function store(PriceRequest $request): JsonResponse
    {
        $price = Price::create($request->validated());

        return response()->json(['id' => $price->id], 201);
    }

    /**
     * Просмотр конкретной цены комплектации
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $price = Price::find($id);

        if (!$price) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($price);
    }

    /**
     * Обновление цены
     *
     * @param PriceRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(PriceRequest $request, $id): JsonResponse
    {
        $price = Price::find($id);

        if (!$price) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $price->update($request->validated());

        return response()->json(status: 204);
    }

    /**
     * Удаление цены
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $price = Price::find($id);

        if (!$price) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $price->delete();

        return response()->json(status: 204);
    }
}
