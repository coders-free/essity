<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Line;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class LineTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            LinkColumn::make("Action")
                ->title(fn() => "Editar")
                ->location(fn($row) => route('admin.lines.edit', $row->id))
                ->attributes(fn() => ['class' => 'btn btn-darkblue']),
        ];
    }

    public function deleteSelected(){

        $error = false;

        $lines = Line::whereIn('id', $this->getSelected())
                    ->with('categories')
                    ->get();

        foreach ($lines as $line) {
            if($line->categories->count() > 0){
                $error = true;
                continue;
            }

            $line->delete();
        }

        if($error){
            $this->emit('sweetalert2Error', 'Uno o más registros no se pudieron eliminar.');
        }else{
            $this->emit('sweetalert2Success', 'Registros eliminados correctamente.');
        }


        $this->clearSelected();

    }

    public function builder(): Builder
    {
        return Line::query();
    }
}
