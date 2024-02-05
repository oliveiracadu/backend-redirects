<?php

namespace App\Services;

use App\Repositories\RedirectLogRepository;
use App\Repositories\RedirectRepository;
use Exception;

class RedirectService
{
    protected $redirectRepository;
    protected $redirectLogRepository;

    public function __construct(
        RedirectRepository $redirectRepository,
        RedirectLogRepository $redirectLogRepository
    ) {
        $this->redirectRepository = $redirectRepository;
        $this->redirectLogRepository = $redirectLogRepository;
    }

    /**
     * @param void
     */
    public function list()
    {
        $newList = [];
        $list = $this->redirectRepository->list();
        foreach ($list as $register) {
            $log = $this->redirectLogRepository->getByCode($register['code']);

            $newList[] = [
                'code'        => $register['code'],
                'status'      => $register['status'] ? 'Active' : 'Inactive',
                'url'         => $register['url'],
                'queryParams' => $register['query_params'],
                'lastAccess'  => $log['created_at'] ?? '',
                'createdAt'   => $register['created_at'],
                'updatedAt'   => $register['updated_at']
            ];
        }

        return $newList;
    }

    /**
     * @param string $url
     * @param array $params
     */
    public function create(array $url)
    {
        $array = explode('?', $url);
        $data = [
            'url'          => $array[0],
            'query_params' => $array[1]
        ];

        try {
            $this->redirectRepository->create($data);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param string $code
     * @param string $url
     */
    public function update(string $code, string $url)
    {
        $array = explode('?', $url);
        $data = [
            'url'          => $array[0],
            'query_params' => $array[1]
        ];

        try {
            $this->redirectRepository->update($code, $data);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param string $code
     */
    public function activateInactivate(string $code)
    {
        $redirect = $this->redirectRepository->getByCode($code);
        $data['status'] = !$redirect['status'];

        $this->redirectRepository->update($code, $data);
    }

    /**
     * @param string $code
     */
    public function delete(string $code)
    {
        $this->redirectRepository->delete($code);
    }

    /**
     * @param string $code
     * @param array $params
     */
    public function redirect(
        string $code,
        array $params,
        string $userAgent,
        string $ip,
        array $header
    ) {
        $redirect = $this->redirectRepository->getByCode($code);

        $queryParams = $this->verifyParams($params) . $redirect['query_params'];

        $this->redirectLogRepository->create(
            $redirect['code'],
            $userAgent,
            $ip,
            $header
        );

        return $redirect['url'] . '?' . $queryParams;
    }

    /**
     * @param array $params
     */
    private function verifyParams(array $params)
    {
        $newParams = [];
        foreach ($params as $key => $value) {
            if (empty($query)) {
                continue;
            }

            $newParams[$key] = $value;
        }

        return http_build_query($newParams);
    }
}
