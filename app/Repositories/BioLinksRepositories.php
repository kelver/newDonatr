<?php
namespace App\Repositories;

use App\Models\BioLinks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BioLinksRepositories
{
    protected $model;

    public function __construct(BioLinks $links)
    {
        $this->model = $links;
    }

    public function getlinkByUuid(string $identify): Builder|Model
    {
        $link = $this->model->where('uuid', $identify)->first();

        if(!$link) {
            abort(404, 'Link não encontrado.');
        }

        return $link;
    }

    public function createLink (array $data)
    {
        $data['user_id'] = auth()->user()->id;
        return $this->model->create($data);
    }

    public function updateLink(array $data, $identify) :bool
    {
        $link = $this->getlinkByUuid($identify);

        $link->fill($data);

        return $link->push();
    }

    public function allLinks()
    {
        return $this->model->where('user_id', auth()->id())->get();
    }
}
