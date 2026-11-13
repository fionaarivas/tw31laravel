<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function show(Request $request)
    {
        $validated = $request->validate([
            'lat' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'lon' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
        ]);

        $apiKey = config('services.openweather.key');

        if (!$apiKey) {
            return response()->json([
                'message' => 'OpenWeather API key is missing.',
            ], 500);
        }

        $response = Http::acceptJson()
            ->timeout(10)
            ->get(
                'https://api.openweathermap.org/data/2.5/weather',
                [
                    'lat' => $validated['lat'],
                    'lon' => $validated['lon'],
                    'appid' => $apiKey,
                    'units' => 'metric',
                    'lang' => 'en',
                ]
            );

        if ($response->failed()) {
            return response()->json([
                'message' => 'Unable to retrieve weather information.',
                'status' => $response->status(),
                'openweather_response' => $response->json(),
            ], 502);
        }

        $weather = $response->json();

        return response()->json([
            'location' => $weather['name'] ?? 'Unknown location',
            'temperature' => $weather['main']['temp'] ?? null,
            'feels_like' => $weather['main']['feels_like'] ?? null,
            'description' => $weather['weather'][0]['description'] ?? null,
            'humidity' => $weather['main']['humidity'] ?? null,
            'wind_speed' => $weather['wind']['speed'] ?? null,
            'icon' => $weather['weather'][0]['icon'] ?? null,
        ]);
    }
}