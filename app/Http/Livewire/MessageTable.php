<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Message;

class MessageTable extends DataTableComponent
{
    protected $model = Message::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Pharmacy name", "pharmacy_name")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Postal code", "postal_code")
                ->sortable(),
            Column::make("City", "city")
                ->sortable(),
            Column::make("Province", "province")
                ->sortable(),
            Column::make("Phone", "phone")
                ->sortable(),
            Column::make("Nif 1", "nif_1")
                ->sortable(),
            Column::make("Nif 2", "nif_2")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Last name", "last_name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
