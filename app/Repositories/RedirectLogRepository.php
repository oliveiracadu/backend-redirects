<?php

namespace App\Repositories;

use App\Models\RedirectLogs;

class RedirectLogRepository
{
    /**
     * @param string $code
     * @param string $userAgent
     * @param string $ip
     * @param array $header
     */
    public function create(
        string $code,
        string $userAgent,
        string $ip,
        array $header
    ) {
        $log = new RedirectLogs();
        $log->code = $code;
        $log->user_agent = $userAgent;
        $log->ip = $ip;
        $log->header = json_encode($header);
        $log->save();
    }

    /**
     * @param string $code
     */
    public function getByCode(string $code)
    {
        return RedirectLogs::where('code', $code)
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    /**
     * @param string $code
     */
    public function count(string $code)
    {
        return RedirectLogs::where('code', $code)
            ->count();
    }

    /**
     * @param string $code
     */
    public function uniqueCount(string $code)
    {
        return RedirectLogs::where('code', $code)
            ->groupBy('ip')
            ->count();
    }

    /**
     * @param string $code
     */
    public function logs(string $code)
    {
        return RedirectLogs::where('code', $code)
            ->get()
            ->toArray();
    }
}
