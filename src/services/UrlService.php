<?php

namespace App\services;

use App\Entity\Url;
use Doctrine\ORM\EntityManagerInterface;

class UrlService
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addUrl(string $longurl, ?string $domain = ''): url
    {
        $Url = new url();
        $hash = $this->generateHash();
        $link = $_SERVER['HTTP_ORIGIN']."/$hash";

        $Url->setLongUrl($longurl);
        $Url->setDomain($domain);
        $Url->setHash($hash);
        $Url->setLink($link);
        $Url->setCreateAt(new \DateTime());

        $this->em->persist($Url);
        $this->em->flush();

        return $Url;
    }

    public function parseUrl(string $Url): ?string
    {
        $domain = parse_url($Url, PHP_URL_HOST);

        if (!$domain) {
            return null;
        }

        if (!filter_var(gethostbyname($domain), FILTER_VALIDATE_IP)) {
            return null;
        }

        return $domain;
    }

    public function generateHash(int $offset = 0, int $length = 8): string
    {
        return substr(md5(uniqid(mt_rand(), true)), $offset, $length);
    }
}
