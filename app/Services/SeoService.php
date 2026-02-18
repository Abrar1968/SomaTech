<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\URL;

class SeoService
{
    /**
     * Generate SEO meta tags.
     *
     * SRS Reference: NFR-009, NFR-010, NFR-011
     *
     * @return array{title: string, description: string, canonical: string, og: array, twitter: array}
     */
    public function generateMeta(array $data): array
    {
        $defaults = [
            'title' => config('app.name').' - Premium Web & App Development',
            'description' => 'Somaticx specializes in Website Development, App Development, and Website Maintenance. Transforming ideas into digital excellence.',
            'image' => URL::to('/images/og-default.jpg'),
            'url' => URL::current(),
            'type' => 'website',
        ];

        $meta = array_merge($defaults, array_filter($data));

        return [
            'title' => $meta['title'],
            'description' => $meta['description'],
            'canonical' => $meta['url'],
            'og' => [
                'title' => $meta['title'],
                'description' => $meta['description'],
                'image' => $meta['image'],
                'url' => $meta['url'],
                'type' => $meta['type'],
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $meta['title'],
                'description' => $meta['description'],
                'image' => $meta['image'],
            ],
        ];
    }

    /**
     * Generate JSON-LD schema.
     *
     * SRS Reference: NFR-012
     */
    public function generateSchema(string $type, array $data = []): string
    {
        $schema = match ($type) {
            'Organization' => $this->organizationSchema(),
            'WebSite' => $this->websiteSchema(),
            'Service' => $this->serviceSchema($data),
            'CreativeWork' => $this->creativeWorkSchema($data),
            default => null,
        };

        return $schema ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : '';
    }

    /**
     * Generate Organization schema.
     *
     * @return array<string, mixed>
     */
    private function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Somaticx',
            'url' => URL::to('/'),
            'logo' => URL::to('/images/logo.png'),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+1-555-SOMATICX',
                'contactType' => 'Customer Service',
            ],
            'sameAs' => [
                'https://github.com/somaticx',
                'https://linkedin.com/company/somaticx',
            ],
        ];
    }

    /**
     * Generate WebSite schema.
     *
     * @return array<string, mixed>
     */
    private function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Somaticx',
            'url' => URL::to('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => URL::to('/portfolio?search={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    /**
     * Generate Service schema.
     *
     * @return array<string, mixed>
     */
    private function serviceSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Somaticx',
            ],
        ];
    }

    /**
     * Generate CreativeWork schema.
     *
     * @return array<string, mixed>
     */
    private function creativeWorkSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'image' => $data['image'] ?? '',
            'author' => [
                '@type' => 'Organization',
                'name' => 'Somaticx',
            ],
        ];
    }
}
