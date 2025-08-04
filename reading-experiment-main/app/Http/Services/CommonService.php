<?php

namespace App\Http\Services;

use App\Models\Passage;
use App\Models\passageStyle;
use App\Models\Survey;
use App\Models\UserProgress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CommonService
{

    /**
     * @param Passage $passage
     * @param passageStyle $availableStyles
     * @return Model|Builder
     */

    public function storeUserProgress(Passage $passage, passageStyle $availableStyles): Model|Builder
    {
        return UserProgress::query()->create([
            'user_id' => auth()->id(),
            'passage_id' => $passage->id,
            'passage_style_id' => $availableStyles->id,
            'start_time' => Carbon::now()->timestamp * 1000000 + Carbon::now()->micro,
            'p_start_times' => json_encode([Carbon::now()->timestamp * 1000000 + Carbon::now()->micro])
        ]);

    }

    /**
     * @return Builder
     */
    public function passageProgressQueryForAuthUser(): Builder
    {
        return UserProgress::query()->where('user_id', auth()->id());

    }

    /**
     * @return Collection
     */
    public function getPreviousProgress(): Collection
    {
        return $this->passageProgressQueryForAuthUser()->get()->pluck('passage_id');
    }

    /**
     * @return Model|Builder|null
     */
    public function randomPassage(): Model|Builder|null
    {
        $previous = $this->getPreviousProgress();
        $passageQuery = Passage::with('questions', 'questions.questionOptions');
        if (count($previous) > 0) {
            $passageQuery->whereNotIn('id', $previous);
        }
        return $passageQuery->inRandomOrder()
            ->first();

    }

    /**
     * @return Collection
     */
    public function getPreviousStyles(): Collection
    {
        return $this->passageProgressQueryForAuthUser()->get()->pluck('passage_style_id');

    }

    /**
     * @return Model|Builder|null
     */
    public function randomStyle(): Model|Builder|null
    {
        $previous = $this->getPreviousStyles();
        $styleQuery = PassageStyle::query();
        if (count($previous) > 0) {
            $styleQuery->whereNotIn('id', $previous);
        }
        return $styleQuery->inRandomOrder()->first();

    }

    /**
     * @return Model|Builder|null
     */
    public function survey(): Model|Builder|null
    {
        return Survey::query()->where('user_id', auth()->user()->id)->first();
    }

    /**
     * @param $passageId
     * @return Model|Builder
     */
    public function userProgressByPassageId($passageId): Model|builder
    {
        return UserProgress::query()->with('passage', 'style')->where('user_id', auth()->id())->where('passage_id', base64_decode($passageId))->first();

    }

    /**
     * @param UserProgress $progressInfo
     * @return bool
     */
    public function updateUserProgressBackTimes(UserProgress $progressInfo): bool
    {
        $addedNewBackTime = Carbon::now()->timestamp * 1000000 + Carbon::now()->micro;
        $backTimes = [];
        if (!empty($progressInfo->back_times)) {
            $backTimes = json_decode($progressInfo->back_times, true);

        };
        $backTimes[] = $addedNewBackTime;
        return $progressInfo->update([
            'back_times' => json_encode($backTimes),
        ]);
    }


    /**
     * @param $passageId
     * @return bool
     */
    public function updateUserProgressStartTimes($passageId): bool
    {
        $userProgress = UserProgress::query()
            ->where('user_id', auth()->id())
            ->where('passage_id', $passageId)
            ->first();

        $addedNewStartTime = Carbon::now()->timestamp * 1000000 + Carbon::now()->micro;

        $startTimes = [];
        if (!empty($userProgress->p_start_times)) {
            $startTimes = json_decode($userProgress->p_start_times, true);
        }
        $startTimes[] = $addedNewStartTime;

        return $userProgress->update([
            'p_start_times' => json_encode($startTimes),
        ]);
    }


    public function storedQuestionEndTime($passageId): bool
    {
        $userProgress = UserProgress::query()
            ->where('user_id', auth()->id())
            ->where('passage_id', $passageId)
            ->first();
        return $userProgress->update([
            'questions_end_time' => Carbon::now()->timestamp * 1000000 + Carbon::now()->micro
        ]);
    }

    public function passageEndTime($passageId): bool
    {
        $userProgress = UserProgress::query()
            ->where('user_id', auth()->id())
            ->where('passage_id', $passageId)
            ->first();
        return $userProgress->update([
            'p_end_time' => Carbon::now()->timestamp * 1000000 + Carbon::now()->micro,
            'questions_start_time' => Carbon::now()->timestamp * 1000000 + Carbon::now()->micro
        ]);
    }

    /**
     * @param $passageId
     * @return Model|Builder|null
     */
    public function styleGetByPassageId($passageId): Model|Builder|null
    {
        return UserProgress::query()
            ->with('style')
            ->where('user_id', auth()->id())
            ->where('passage_id', $passageId)
            ->first();
    }
}
