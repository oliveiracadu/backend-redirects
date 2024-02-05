<?php

namespace App\Http\Controllers;

use App\Http\Requests\RedirectRequest;
use App\Services\RedirectService;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    protected $redirectService;

    public function __construct(
        RedirectService $redirectService
    ) {
        $this->redirectService = $redirectService;
    }

    /**
     * @param void
     */
    public function list()
    {
        return response()->json([
            'data' => $this->redirectService->list()
        ]);
    }

    /**
     * @param RedirectRequest $redirectRequest
     */
    public function create(RedirectRequest $redirectRequest)
    {
        $status = $this->redirectService->create($redirectRequest->get('url'));

        return response()->json([
            'status' => $status
        ]);
    }

    /**
     * @param string $code
     * @param RedirectRequest $redirectRequest
     */
    public function update(string $code, RedirectRequest $redirectRequest)
    {
        $this->redirectService->update($code, $redirectRequest->get('url'));
    }

    /**
     * @param string $code
     */
    public function delete(string $code)
    {
        $this->redirectService->delete($code);
    }

    /**
     * @param string $code
     */
    public function activateInactivate(string $code)
    {
        $this->redirectService->activateInactivate($code);
    }

    /**
     * @param $code
     * @param Request $request
     */
    public function redirect(string $code, Request $request)
    {
        return redirect(
            $this->redirectService->redirect(
                $code,
                $request->query(),
                $request->userAgent(),
                $request->ip(),
                $request->header()
            )
        );
    }
}
