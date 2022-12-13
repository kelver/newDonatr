<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BioLinks extends Component
{
    use LivewireAlert;

    public array $links = [];

    protected $listeners = [
        'removeLinkConfirmed' => 'removeLinkConfirmed'
    ];

    public function getLinks ()
    {

    }

    public function generateLink()
    {
        $this->links[] = [
            'url' => '',
            'title' => '',
            'status' => false,
        ];
    }

    public function removeLinkConfirmed ($response)
    {
        $index = $response['data']['inputAttributes']['value'];
        unset($this->links[$index]);
        $this->alert('success', 'Link excluído com sucesso!');
    }

    public function removeLink ($index)
    {
        $this->confirm('Deseja realmente excluir esse link?', [
            'toast' => false,
            'position' => 'center',
            'confirmButtonText' => "Excluir",
            'cancelButtonText' => "Cancelar",
            'showConfirmButton' => true,
            'onConfirmed' => 'removeLinkConfirmed',
            'inputAttributes' => [
                'value' => $index
            ],
            'onCancelled' => 'cancelled'
        ]);
    }

    public function mount()
    {
        $this->getLinks();
    }

    public function render()
    {
        return view('livewire.bioLinks');
    }
}
