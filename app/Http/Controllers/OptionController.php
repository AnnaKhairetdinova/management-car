<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Illuminate\Http\JsonResponse;

class OptionController extends Controller
{
    /**
     * Список опций
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $options = Option::all();

        return response()->json($options);
    }

    /**
     * Создание опции
     *
     * @param OptionRequest $request
     * @return JsonResponse
     */
    public function store(OptionRequest $request): JsonResponse
    {
        $option = Option::create($request->validated());

        return response()->json(['id' => $option->id], 201);
    }

    /**
     * Просмотр конкретной опции
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($option);
    }

    /**
     * Обновление опции
     *
     * @param OptionRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(OptionRequest $request, int $id): JsonResponse
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $option->update($request->validated());

        return response()->json(status: 204);
    }

    /**
     * Удаление опции
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $option = Option::find($id);

        if (!$option) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $option->delete();

        return response()->json(status: 204);
    }
}
