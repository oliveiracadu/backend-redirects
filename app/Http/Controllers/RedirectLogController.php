<?php

namespace App\Http\Controllers;

use App\Services\RedirectLogService;
use Illuminate\Http\Request;

class RedirectLogController extends Controller
{
    protected $redirectLogService;

    public function __construct(
        RedirectLogService $redirectLogService
    ) {
        $this->redirectLogService = $redirectLogService;
    }

    /**
     * @param string $code
     */
    public function stats(string $code)
    {
        return response()->json([
            'data' => $this->redirectLogService->stats($code)
        ]);
    }

    /**
     * @param string $code
     */
    public function logs(string $code)
    {
        return response()->json([
            'data' => $this->redirectLogService->logs($code)
        ]);
    }
}
