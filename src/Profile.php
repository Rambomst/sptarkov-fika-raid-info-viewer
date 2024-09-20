<?php

namespace Tarkov;

use Tarkov\Service\Server;

class Profile {
    public function __construct(
        public string $id,
        public int $aid,
        public string $nickname,
        public string $side,
        public int $experience,
        public int $member_category,
        public bool $banned_state,
        public int $banned_until,
        public int $registration_date
    ) {
    }

    /**
     * Create a Profile object from an array.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['aid'],
            $data['info']['nickname'],
            $data['info']['side'],
            $data['info']['experience'],
            $data['info']['memberCategory'],
            $data['info']['bannedState'],
            $data['info']['bannedUntil'],
            $data['info']['registrationDate']
        );
    }

    /**
     * Fetch a players data from the server and return a Profile object.
     * 
     * @return Profile
     */
    public static function fetchPlayer($id): self
    {
        $response = Server::getData('client/profile/view', ['sessionId' => $id], $id);
        return self::fromArray($response);
    }
}