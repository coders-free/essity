<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Message;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

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

            Column::make("Name", "name")
                ->sortable(),
            Column::make("Last name", "last_name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),

            BooleanColumn::make("Respondido", "responded"),

            Column::make("Created at", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            LinkColumn::make("Action")
                ->title(fn() => "Responder")
                ->location(fn($row) => route('admin.messages.show', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
            
        ];
    }
}
