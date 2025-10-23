<?php

namespace App\Services;

use App\Data\ContactData;
use Exception;
use Mindee\ClientV2;
use Mindee\Input\InferenceParameters;
use Mindee\Input\PathInput;
use Mindee\Parsing\V2\Field\InferenceFields;

final readonly class MindeeBusinessCardService
{
    private ClientV2 $client;

    public function __construct()
    {
        /** @var string|null $apiKey */
        $apiKey = config('services.mindee.api_key');

        if (empty($apiKey)) {
            throw new Exception('Mindee API key is not configured');
        }

        $this->client = new ClientV2($apiKey);
    }

    public function parseBusinessCard(string $filePath): ContactData
    {
        if (! file_exists($filePath)) {
            throw new Exception("File not found: {$filePath}");
        }

        // Проверяем читаемость файла
        if (! is_readable($filePath)) {
            throw new Exception("File is not readable: {$filePath}");
        }

        $inferenceParams = new InferenceParameters(
            '1be14d4f-d2af-434b-819d-56ae374028c3',

            rag: null,
            rawText: null,
            polygon: null,
            confidence: null
        );
        try {
            $inputSource = new PathInput($filePath);

            $response = $this->client->enqueueAndGetInference(
                $inputSource, $inferenceParams
            );

            $prediction = $response->inference->result->fields;

            return $this->extractContactData($prediction);

        } catch (Exception $e) {
            throw new Exception(
                'Failed to parse business card: '.$e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    private function extractContactData(InferenceFields $prediction): ContactData
    {

        return new ContactData(
            id: 0,
            name: $this->getFieldValue($prediction, 'full_name') ?? '',
            email: $this->getEmail($prediction) ?? '',
            phone: $this->getPhoneNumber($prediction) ?? '',
            position: $this->getFieldValue($prediction, 'job_title') ?? '',
            company: $this->getFieldValue($prediction, 'company'),
            address: $this->getFieldValue($prediction, 'address'),
            city: '',
            zip: '',
        );
    }

    private function getFieldValue(InferenceFields $prediction, string $fieldName): ?string
    {
        $field = $prediction->get($fieldName);

        if (isset($field->value)) {
            return ! empty($field->value) ? (string) $field->value : null;
        }

        return null;
    }

    private function getPhoneNumber(InferenceFields $prediction): ?string
    {
        // @phpstan-ignore-next-line
        $firstPhone = $prediction->get('phone_number')->items[0];

        return isset($firstPhone->value) && ! empty($firstPhone->value)
            ? (string) $firstPhone->value
            : null;
    }

    private function getEmail(InferenceFields $prediction): ?string
    {
        // @phpstan-ignore-next-line
        $firstPhone = $prediction->get('email_address')->items[0];

        return isset($firstPhone->value) && ! empty($firstPhone->value)
            ? (string) $firstPhone->value
            : null;
    }

    public function isConfigured(): bool
    {
        return ! empty(config('services.mindee.api_key'));
    }
}
