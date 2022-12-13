<?php
namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProfileRepositories
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserByUUid(string $identify): Builder|Model
    {
        $user = $this->model->with('profile')->where('uuid', $identify)->first();

        if(!$user){
            abort(404, 'Usuário não encontrado.');
        }

        return $user;
    }

    public function updateMe(array $data) :bool
    {
        $user = $this->model
            ->with('profile')
            ->where('id', auth()->id())
            ->first();

        if(!$user){
            return abort(404, 'Usuário não encontrado.');
        }

        $user->fill($data);
        $user->profile->fill($data);

        return $user->push();
    }

    public function allIndications(): User|collection|null
    {
        if(!auth()->user()->indicator){
            return abort(404, 'Usuário sem indicador.');
        }

        return $this->model->where('indicator', auth()->user()->indicator)->paginate(10);
    }

    public function highlightUser()
    {
        $time = Carbon::now()->subHours(24)->format('Y-m-d H:i:s');

        $users = User::
            withCount([
                'topics' => function($query) use ($time){
                    return $query->where('created_at', '>', $time);
                },
                'comments' => function($query) use ($time){
                    return $query->where('created_at', '>', $time);
                }
            ])
            ->where('email_verified_at', '!=', null)
            ->orderBy('topics_count', 'desc')
            ->orderBy('comments_count', 'desc')
            ->orderBy('name', 'desc')
            ->paginate(10);

        return $users;
    }
}
