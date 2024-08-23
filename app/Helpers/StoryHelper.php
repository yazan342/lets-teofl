<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Helper function to send a text to the Python API.
 *
 * @return array The response from the Python API, including the story, questions, and answers.
 */
function sendTextToPythonApi($text)
{
    $client = new Client();

    try {
        $response = $client->post('http://127.0.0.1:5000/generate_questions', [
            'json' => [
                'text' => $text,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    } catch (RequestException $e) {
        throw new \Exception('API request failed: ' . $e->getMessage());
    }
}
