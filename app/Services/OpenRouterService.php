<?php

namespace App\Services;

use App\Models\Conversation;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenRouterService
{
    public function generateReply(Conversation $conversation): string
    {
        $apiKey = config('services.openrouter.api_key');
        $model = config('services.openrouter.model');
        $baseUrl = config('services.openrouter.base_url');

        if (empty($apiKey) || empty($model)) {
            throw new RuntimeException(
                'Konfigurasi OpenRouter belum lengkap.'
            );
        }

        // Ambil riwayat percakapan
        $history = $conversation->messages()
            ->orderBy('created_at', 'asc')
            ->get();

        $messages = [
            [
                'role' => 'system',
                'content' => 'Kamu adalah AI Companion dalam platform PeerCounsel, sebuah platform konseling sebaya. Bersikaplah ramah, empatik, tidak menghakimi, dan gunakan bahasa Indonesia yang natural. Dengarkan cerita pengguna, berikan dukungan emosional dasar, dan ajukan pertanyaan yang membantu pengguna bercerita. Jangan mengaku sebagai psikolog atau tenaga profesional. Jangan memberikan diagnosis. Jika pengguna berada dalam bahaya atau berisiko menyakiti diri sendiri maupun orang lain, arahkan untuk segera mencari bantuan orang tepercaya atau tenaga profesional.'
            ],
        ];

        foreach ($history as $item) {
            if ($item->sender_type === 'konseli') {
                $messages[] = [
                    'role' => 'user',
                    'content' => $item->message,
                ];
            } elseif ($item->sender_type === 'ai') {
                $messages[] = [
                    'role' => 'assistant',
                    'content' => $item->message,
                ];
            } elseif ($item->sender_type === 'konselor') {
                $messages[] = [
                    'role' => 'user',
                    'content' => '[Pesan dari konselor manusia sebelumnya]: '
                        . $item->message,
                ];
            }
        }

        $response = Http::timeout(90)
            ->withToken($apiKey)
            ->acceptJson()
            ->post(
                rtrim($baseUrl, '/') . '/chat/completions',
                [
                    'model' => $model,
                    'messages' => $messages,
                    'temperature' => 0.7,
                    'max_tokens' => 500,
                ]
            );

        if (!$response->successful()) {
            throw new RuntimeException(
                'OpenRouter gagal: HTTP ' . $response->status()
            );
        }

        $reply = $response->json('choices.0.message.content');

        if (!is_string($reply) || trim($reply) === '') {
            throw new RuntimeException(
                'OpenRouter tidak memberikan balasan yang valid.'
            );
        }

        return trim($reply);
    }
}
