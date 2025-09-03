<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $baseUrl = 'https://api.fonnte.com/send';

    /**
     * Normalisasi nomor agar bisa 08xxx atau 62xxx
     */
    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone); // hapus karakter non-digit
        if (strpos($phone, '0') === 0) {
            // ubah 08xxx jadi 628xxx
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }

    public function sendMessage(string $target, string $message): array
    {
        $token = config('services.fonnte.token');

        if (!$token) {
            Log::error('❌ Fonnte API Token not set.');
            return ['success' => false, 'error' => 'API token not set'];
        }

        $target = $this->normalizePhone($target);

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asForm()->post($this->baseUrl, [
                'target'  => $target,
                'message' => $message,
            ]);

            if ($response->successful()) {
                $json = $response->json();
                Log::info('✅ Fonnte message sent', ['to' => $target, 'response' => $json]);
                return ['success' => true, 'response' => $json];
            } else {
                Log::error('❌ Fonnte send failed', [
                    'to'       => $target,
                    'status'   => $response->status(),
                    'response' => $response->body(),
                ]);
                return ['success' => false, 'status' => $response->status(), 'response' => $response->body()];
            }
        } catch (\Exception $e) {
            Log::error('❌ Fonnte exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'exception' => $e->getMessage()];
        }
    }
}
