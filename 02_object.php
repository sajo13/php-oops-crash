<?php

// Constructor Property Promotion (CPP) is a feature introduced in PHP 8.0 that allows 
// you to combine property declaration and constructor initialization into a more concise syntax. 
// You can declare and initialize class properties directly within the constructor signature, reducing boilerplate code.

class Playlist
{
    public function __construct(
        public string $name,
        public array $songs
    ) {}

    public function shuffle(): void
    {
        shuffle($this->songs);
    }
}

$playlists = [];

$playlists[] = new Playlist('80s Headbangers', [
    'Back in Black',
    'Are you Ready',
    'Hells Bells',
    'Highway to Hell'
]);

$playlists[0]->shuffle();
die(var_dump($playlists));