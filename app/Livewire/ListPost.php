<?php

namespace App\Livewire;

use App\Models\Categori;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\Component;


#[Lazy()]
#[Computed(persist: true)]
class ListPost extends Component
{

    public $categori;
    #[Url()]
    public $categori_id = '';
    public $search = '';
    public $dataobject = null;
    public ?string $title = null;
    #[Url()]
    public $limit = 3;
    public $menu_id = null;
    public $isActive = false;


    public function placeholder()
    {
        return view('components.placeholder-list');
    }

    public function mount()
    {
        if (isset($this->dataobject[0])) {
            $this->menu_id = $this->dataobject[0]['menu_id'];
            $this->isActive = $this->dataobject[0]['status'];
        }
    }

    public function loadMore()
    {
        $this->limit += 3;

        if ($this->dataobject->count() < $this->limit ) {
            $this->render();
        }
    }

    public function resetForm()
    {
        return $this->reset(['categori_id', 'search']);
    }

    public function render()
    {

        $this->categori = Categori::all();
        $data = Post::query()->where('is_active', true)->where('menu_id',$this->menu_id)->orderBy('created_at','desc');

        $count= $data->count();
        if ($this->categori_id) {
            $data->where('categori_id', $this->categori_id);
        }
        if ($this->search) {
          $data->where('title', 'like', '%' . $this->search . '%');
        }
        if($this->categori_id === '' && $this->search === ''){
            $this->resetForm();
        }

        $this->dataobject = $data->limit($this->limit)->get();
        return view('livewire.list-post',
            [
                'categori' => $this->categori,
                'dataobject' => $this->dataobject,
                'title' => $this->title,
                'count' => $count,
                'limit' => $this->limit,
            ]);
    }
}
