<?php


namespace Models;

require "Helper/http.php";
use Helper;

class User
{
    private $id;
    public $user;
    private const CLUBS_URL = "https://bmuk-uat.almamaters.club/clubs";
    private const USER_URL = "https://bmuk-uat.almamaters.club/user/";

    public function __construct($id)
    {
        $this->id = $id;
        $this->user = Helper\http_json(self::USER_URL . $id)["data"];
    }

    public function getClubs(): array
    {
        $resp = Helper\http_json(self::CLUBS_URL);
        $user_club_ids = array_map(function ($club) {
            return $club["id"];
        }, $this->user["clubs"]);
        if ($resp["status"] === 200) {
            $clubs = $resp["data"];
            return array_filter($clubs, function ($club) use ($user_club_ids) {
                return in_array($club["id"], $user_club_ids);
            });
        }
        return [];
    }

}