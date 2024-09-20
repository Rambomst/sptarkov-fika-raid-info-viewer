<?php

namespace Tarkov;

use Tarkov\Service\Server;
use Tarkov\Service\Config;

class Raid {
    public bool $dedicated = false;

    public function __construct(
        public string $server_id,
        public string $host_username,
        public int $player_count,
        public string $status,
        public string $location,
        public string $side,
        public string $time,
        public array $players
    ) {
        // If a dedicated client id appears in the players list then amend the player count, remove it from the players list
        $dedicated_clients = (new Config())->tarkov['dedicated_clients'];
        foreach ($dedicated_clients as $dedicated_client_id) {
            if (array_key_exists($dedicated_client_id, $this->players)) {
                // Reduce the player_count by 1
                $this->player_count--;

                // Remove the dedicated client from the players list
                unset($this->players[$dedicated_client_id]);

                $this->dedicated = true;
                break;
            }
        }

        $this->players = array_keys($this->players);
    }

    /**
     * Create a Raid object from an array.
     */
    public static function fromArray(array $data): Raid
    {
        return new self(
            $data['serverId'],
            $data['hostUsername'],
            $data['playerCount'],
            $data['status'],
            $data['location'],
            $data['side'],
            $data['time'],
            $data['players']
        );
    }

    /**
     * Fetch raid data from the server and return a list of Raid objects.
     * 
     * @return Raid[]
     */
    public static function fetchRaids(): array
    {
        $response = Server::getData('fika/location/raids');
        return array_map(fn($raid) => self::fromArray($raid), $response);
    }

    /**
     * Translate location into an map image filename.
     * 
     * @return string Map image filename based on location
     */
    public function getMapImage(): string
    {
        $image_map = [
            'rezervbase'        => 'reserve.jpg',
            'bigmap'            => 'customs.jpg',
            'woods'             => 'woods.jpg',
            'interchange'       => 'interchange.jpg',
            'shoreline'         => 'shoreline.jpg',
            'factory4_day'      => 'factory.jpg',
            'factory4_night'    => 'factory.jpg',
            'laboratory'        => 'labs.jpg',
            'tarkovstreets'     => 'streets.jpg',
            'lighthouse'        => 'lighthouse.jpg',
            'sandbox'           => 'ground-zero.jpg',
        ];

        return $image_map[strtolower($this->location)] ?? 'unknown.png';
    }

    /**
     * Translate location into an map name.
     * 
     * @return string Map name based on location
     */
    public function getReadableMapName() {
        $name_map = [
            'rezervbase'        => 'Reserve',
            'bigmap'            => 'Customs',
            'woods'             => 'Woods',
            'interchange'       => 'Interchange',
            'shoreline'         => 'Shoreline',
            'factory4_day'      => 'Factory',
            'factory4_night'    => 'Factory',
            'laboratory'        => 'Labs',
            'tarkovstreets'     => 'Streets of Tarkov',
            'lighthouse'        => 'Lighthouse',
            'sandbox'           => 'Ground Zero',
        ];

        return $name_map[strtolower($this->location)] ?? 'Unknown';
    }
}