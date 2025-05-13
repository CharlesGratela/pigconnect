<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function getRecommendations($userId, $preferences, $interactions)
    {
        $prompt = $this->generatePrompt($userId, $preferences, $interactions);

        $response = $this->client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $prompt,
                'max_tokens' => 150,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to get recommendations from OpenAI');
        }

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['choices'][0]['text'];
    }

    private function generatePrompt($userId, $preferences, $interactions)
    {
        // Fetch pigs from the database based on preferences and interactions
        $pigs = $this->fetchPigs($preferences, $interactions);

        // Generate a prompt based on user preferences and interactions
        $prompt = "Generate pig recommendations for user ID: $userId based on the following preferences and interactions:\n";
        $prompt .= "Preferences: " . json_encode($preferences) . "\n";
        $prompt .= "Interactions: " . json_encode($interactions) . "\n";
        $prompt .= "Pigs: " . json_encode($pigs) . "\n";
        return $prompt;
    }

    private function fetchPigs($preferences, $interactions)
    {
        // Example query to fetch pigs based on preferences and interactions
        $query = DB::table('pigs')
            ->where('status', 'healthy');

        if (!empty($preferences['price_range'])) {
            $priceRange = explode('-', $preferences['price_range']);
            if (count($priceRange) == 2) {
                $query->whereBetween('price_per_kilo', [$priceRange[0], $priceRange[1]]);
            } else {
                Log::error('Invalid price range format', ['price_range' => $preferences['price_range']]);
            }
        }

        if (!empty($preferences['age_of_pigs'])) {
            $ageRange = explode('-', $preferences['age_of_pigs']);
            if (count($ageRange) == 2) {
                $query->whereBetween(DB::raw('TIMESTAMPDIFF(MONTH, date_of_birth, CURDATE())'), [$ageRange[0], $ageRange[1]]);
            } else {
                Log::error('Invalid age range format', ['age_of_pigs' => $preferences['age_of_pigs']]);
            }
        }

        if (!empty($preferences['preferred_weight'])) {
            $query->where('weight', $preferences['preferred_weight']);
        }

        // Add more filters based on interactions if needed

        $pigs = $query->get();
        Log::info('Pigs fetched based on preferences and interactions', ['pigs' => $pigs]);

        return $pigs;
    }
}