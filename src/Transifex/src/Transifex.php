<?php

/*
 * This file is part of the PHP Translation package.
 *
 * (c) PHP Translation team <tobias.nyholm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\PlatformAdapter\Transifex;

use BabDev\Transifex\Transifex as TransifexClient;
use Psr\Http\Message\ResponseInterface;
use Translation\Common\Exception\StorageException;
use Translation\Common\Model\Message;
use Translation\Common\Storage;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Transifex implements Storage
{
    /**
     * @var TransifexClient
     */
    private $client;

    /**
     * @var array
     */
    private $domainToProjectId = [];

    /**
     * @param TransifexClient $client
     * @param array           $domainToProjectId
     */
    public function __construct(TransifexClient $client, array $domainToProjectId)
    {
        $this->client = $client;
        $this->domainToProjectId = $domainToProjectId;
    }

    public function get($locale, $domain, $key)
    {
        $projectKey = $this->getApiKey($domain);

        $translation = (string) $this->client->get('translations')->getTranslation($projectKey, $key, $locale)->getBody();
        $meta = [];

        return new Message($key, $domain, $locale, $translation, $meta);
    }

    public function update(Message $message)
    {
        $projectKey = $this->getApiKey($message->getDomain());

        /** @var ResponseInterface $response */
        $response = $this->client->get('translations')
            ->updateTranslation($projectKey, $message->getKey(), $message->getLocale(), $message->getTranslation());
        // Check it it was any error
        if ($response->getStatusCode() !== 200) {
            // Create asset first
            $this->client->get('translations')->createResource($projectKey, $message->getKey(), $message->getKey(), 'TXT');
            $this->client->get('translations')
                ->updateTranslation($projectKey, $message->getKey(), $message->getLocale(), $message->getTranslation());
        }
    }

    public function delete($locale, $domain, $key)
    {
        // Transifex API does not support deleting resources.
    }

    /**
     * @param string $domain
     *
     * @return string
     */
    protected function getApiKey($domain)
    {
        if (isset($this->domainToProjectId[$domain])) {
            return $this->domainToProjectId[$domain];
        }

        throw new StorageException(sprintf('Api key for domain "%s" has not been configured.', $domain));
    }
}
