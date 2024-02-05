<?php

namespace App\Services;

use App\Repositories\RedirectLogRepository;

class RedirectLogService
{
    protected $redirectLogRepository;

    public function __construct(
        RedirectLogRepository $redirectLogRepository
    ) {
        $this->redirectLogRepository = $redirectLogRepository;
    }

    /**
     * @param string $code
     */
    public function stats(string $code)
    {
        $count = $this->redirectLogRepository->count($code);
        $uniqueCount = $this->redirectLogRepository->uniqueCount($code);

        return [
            'total' => $count,
            'unique' => $uniqueCount
        ];
    }

    /**
     * @param string $code
     */
    public function logs(string $code)
    {
        return $this->redirectLogRepository->logs($code);
    }
}
