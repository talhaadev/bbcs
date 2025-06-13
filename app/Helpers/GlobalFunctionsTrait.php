<?php

namespace App\Helpers;
use App\Models\GlobalConfig;
trait GlobalFunctionsTrait
{
    public function storeGlobalConfig($configKey, $configValue)
    {
        return GlobalConfig::updateOrCreate(
            [
                'config_key' => $configKey,
            ],
            [
                'config_value' => $configValue,
            ],
        );
    }

    public function getConfigValue($configKey)
    {
        $config = GlobalConfig::where('config_key', $configKey)->first();

        return $config ? $config->config_value : null;
    }

    public function apiResponse($status, $message, $data = [])
    {
        $response = [
            'message' => $message,
            'status' => $status,
            'data' => $data,
        ];

        return response()->json($response);
    }

}
