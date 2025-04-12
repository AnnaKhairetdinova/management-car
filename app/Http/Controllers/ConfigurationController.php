<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuration;
use App\Models\ConfigurationOption;
use App\Models\Option;
use Illuminate\Http\JsonResponse;

class ConfigurationController extends Controller
{
    /**
     * Список конфигураций
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $configuration = Configuration::all();

        return response()->json($configuration);
    }

    /**
     * Создание конфигурации
     *
     * @param ConfigurationRequest $request
     * @return JsonResponse
     */
    public function store(ConfigurationRequest $request): JsonResponse
    {
        $configuration = Configuration::create($request->validated());

        return response()->json(['id' => $configuration->id], 201);
    }

    /**
     * Просмотр конкретной конфигурации
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $configuration = Configuration::find($id);

        if (!$configuration) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json($configuration);
    }

    /**
     * Обновление конфигурации
     *
     * @param ConfigurationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ConfigurationRequest $request, int $id): JsonResponse
    {
        $configuration = Configuration::find($id);

        if (!$configuration) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $configuration->update($request->validated());

        return response()->json(status: 204);
    }

    /**
     * Удаление конфигурации
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $configuration = Configuration::find($id);

        if (!$configuration) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $configuration->delete();

        return response()->json(status: 204);
    }

    public function addOption(int $configurationId, int $optionId): JsonResponse
    {
        $configuration = Configuration::find($configurationId);

        if (!$configuration) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $option = Option::find($optionId);

        if (!$option) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $configuration->options()->attach($optionId);

        return response()->json(status: 204);
    }

    public function removeOption(int $configurationId, int $optionId): JsonResponse
    {
        $configuration = Configuration::find($configurationId);

        if (!$configuration) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $option = Option::find($optionId);

        if (!$option) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $configuration->options()->detach($optionId);

        return response()->json(status: 204);
    }

    /**
     * Список конфигураций-опций
     *
     * @return JsonResponse
     */
    public function configurationOptionsList(): JsonResponse
    {
        $configurationOption = ConfigurationOption::all();

        return response()->json($configurationOption);
    }
}
