<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Webinar;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class WebinarTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable(),
            Column::make("Video", "video_url")
                ->sortable(),
            Column::make("Fecha creación", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y H:i:s')),
            LinkColumn::make("Action")
                ->title(fn() => "Editar")
                ->location(fn($row) => route('admin.webinars.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }

    public function builder(): Builder
    {
        return Webinar::query();
    }
}
