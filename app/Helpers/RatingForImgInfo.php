<?php

namespace App\Helpers;

use App\Models\Rating;
use JsonSerializable;
use stdClass;
use Thiagoprz\CompositeKey\HasCompositeKey;

// poc hodnoteni pozitivne nedativne, hodnotenie prihlaseneho uzivatela
class RatingForImgInfo implements JsonSerializable
{
    protected $up=0;
    protected $down =0;
    protected $score=0;
    protected $curUserVote=0;

    protected $curUser=null;
    protected $curImage=null;

    public function __construct($imgId, $userID)
    {
        $ratings = Rating::where('image_id', $imgId)->get();
        $this->curUser = $userID;
        $this->curImage = $imgId;

        foreach ($ratings as $rating) {
            $ratingVal = $rating->value;
            if ($rating->getUserId() == $userID) {
                $this->curUserVote = $ratingVal;
            }
            if ($ratingVal>0){
                $this->up++;
            }
            elseif ($ratingVal<0) {
                $this->down++;
            }

            $this->score+=$ratingVal;
        }

    }

    public function chngeUp($delta){
        $this->up += $delta;
    }
    public function chngeDown($delta){
        $this->down += $delta;
    }
    public function chngeScore($delta, $prevUserVote=null){
        $prevUserVote = (!is_null($prevUserVote)) ?: $this->curUserVote;
        $this->score += -$prevUserVote +$delta;
    }

    public function setCurUserVote(int $curUserVote): void
    {
        $this->curUserVote = $curUserVote;
    }

    public function setCurUserRateId(?int $curUserRateId): void
    {
        $this->curUserRateId = $curUserRateId;
    }

    public function deleteRateMem()
    {
        $this->score += -$this->curUserVote;
        $this->curUserVote = 0;
        $this->curUserRateId = null;
    }
    public function getCurUserRate(){

        return Rating::where('user_id', $this->curUser)->where('image_id', $this->curImage)->first();
    }

    public function getUp(): int
    {
        return $this->up;
    }

    public function setUp(int $up): void
    {
        $this->up = $up;
    }

    public function getDown(): int
    {
        return $this->down;
    }

    public function setDown(int $down): void
    {
        $this->down = $down;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getCurUserVote(): int
    {
        return $this->curUserVote;
    }


    public function jsonSerialize() : mixed
    {
        return [
            'up' => $this->up,
            'down' => $this->down,
            'score' => $this->score,
            'curUserVote' => $this->curUserVote,
        ];
    }
}
