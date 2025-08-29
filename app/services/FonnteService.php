<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // ✅ tambahkan ini

class FonnteService
{
    protected $baseUrl = 'https://api.fonnte.com/send';

    public function sendMessage(string $target, string $message): bool
    {
        $token = config('services.fonnte.token');

        if (!$token) {
            Log::error('Fonnte API Token not set.');
            return false;
        }

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asForm()->post($this->baseUrl, [
            'target' => $target, // nomor tujuan (628xxx)
            'message' => $message,
        ]);

        if ($response->successful()) {
            Log::info('Fonnte message sent', ['to' => $target, 'message' => $message]);
            return true;
        } else {
            Log::error('Fonnte send failed', ['response' => $response->body()]);
            return false;
        }
    }
}
