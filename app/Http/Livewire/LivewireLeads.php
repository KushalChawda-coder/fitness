<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\admin\{ Leads, LeadsNote, LeadWebsite, LeadsActivity, LeadsWebsiteExploreImage };
use Livewire\WithPagination;

class LivewireLeads extends Component
{
    use WithPagination;

    public $search;
    public $pageItem = 10; 
 
    protected $queryString = ['search'];
 
    public function paginationView()
    {
        return 'layouts.admin.pagination';
    }

    public function updatePageItem($value)
    {
        $this->pageItem = $value;
        $this->resetPage();
    }
    
    public function render()
    {  
        $query = Leads::query();

        if ($this->search) {
            $this->resetPage();
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('company_name', 'like', '%' . $this->search . '%');
        }

        $data = $query->latest()->paginate($this->pageItem);
       
        return view('livewire.livewire-leads',['data'=>$data,'page_item' => $this->pageItem]);
    }
}
