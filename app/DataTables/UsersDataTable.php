<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    protected $actions = ['Edit','Delete'];

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'usersdatatable.action')
            ->editColumn('created_at', function($request){
                return $request->created_at->toDayDateTimeString();
            })
            ->editColumn('updated_at', function($request){
                return $request->updated_at->toDayDateTimeString();
            })
            ->editColumn('action', function ($item) {
                return '<a href="'.route('edit', $item->id).'
                " class="edit btn btn-primary btn-sm"> Edit </a>';
            });
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('usersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'searching' => false,
                        'paging' => true,
                        'ordering' => false,
                        'buttons' => ['Edit','Delete'],
                        ])
                    ->orderBy(1);
    }

    public function Edit(){
        return "Edit Button";
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'email',
            'created_at',
            'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
