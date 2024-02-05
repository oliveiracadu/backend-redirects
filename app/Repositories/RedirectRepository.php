<?php

namespace App\Repositories;

use App\Models\Redirect;
use Hashids\Hashids;

class RedirectRepository
{
    /**
     *
     */
    public function list()
    {
        return Redirect::select('code', 'query_params', 'url', 'status')
            ->get()
            ->toArray();
    }

    /**
     * @param string $code
     */
    public function getByCode(string $code)
    {
        return Redirect::where('code', $code)
            ->whereNull('deleted_at')
            ->first();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $redirect = new Redirect();
        $redirect->url = $data['url'];
        $redirect->query_params = $data['query_params'];
        $redirect->save();

        $redirect->update([
            'code' => (new Hashids())->encode($redirect->id)
        ]);
    }

    /**
     * @param string $code
     * @param array $data
     */
    public function update(string $code, array $data)
    {
        $redirect = $this->getByCode($code);

        $redirect->update($data);
    }

    /**
     * @param string $code
     */
    public function delete(string $code)
    {
        Redirect::where('code', $code)->delete();
    }
}
